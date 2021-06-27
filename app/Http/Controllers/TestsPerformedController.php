<?php

namespace App\Http\Controllers;

use App\Models\TestReport;
use Carbon\Carbon;
use Carbon\Exceptions\Exception;
use DB;
use App\Models\AvailableTest;
use App\Models\Patient;
use App\Models\TestPerformed;
use App\Models\Status;
use Session;
use App\Models\Category;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TestsPerformedController extends Controller
{
    public function index()
    {
        $testPerformeds = TestPerformed::join('patients', 'test_performeds.patient_id', '=', 'patients.id')
            ->join('statuses', 'test_performeds.Sname_id', '=', 'statuses.id')
            ->join('available_tests', 'test_performeds.available_test_id', '=', 'available_tests.id')
            ->join('categories', '.available_tests.category_id', '=', 'categories.id')
            ->select('test_performeds.*', 'patients.Pname', 'patients.dob', 'available_tests.name','available_tests.timehour',
             'available_tests.testFee', 'categories.Cname', 'statuses.Sname','test_performeds.created_at')
            ->orderBy('patient_id', 'DESC')
            ->get();
        return view('admin.TestPerformed.index', compact('testPerformeds'));
    }

    public function create()
    {
        $patientNames = Patient::all()->pluck('Pname', 'id')->prepend(trans('global.pleaseSelect'), '');
        $availableTests = AvailableTest::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $stat = Status::all()->pluck('Sname', 'id')->prepend(trans('global.pleaseSelect'), '');
        $allAvailableTests = AvailableTest::all();
        return view('admin.TestPerformed.create', compact('patientNames', 'availableTests', 'stat', "allAvailableTests"));
    }

    public function store(Request $request)
    {
        $patient = Patient::findorfail($request->patient_id);
        if (!$patient)
            return abort(503, "Invalid request");

        //        dd($request->all());
        foreach ($request->available_test_id as $key => $available_test_id) {
            if (isset(${"test" . $available_test_id})) {
                ${"test" . $available_test_id}++;
            } else {
                ${"test" . $available_test_id} = 0;
            }
            //            dd(isset(${"test".$available_test_id}),${"test".$available_test_id});


            $available_test = AvailableTest::findorfail($available_test_id);
            if (!$available_test)
                return abort(503, "Invalid request");

            //inventory
            foreach ($available_test->available_test_inventories as $test_inventory) {
                $test_inventory->inventory->update([
                    "remainingItem" => $test_inventory->inventory->remainingItem - $test_inventory->itemUsed
                ]);
            }

            //fee
            if (isset($request->fee_final[$key]) && $request->fee_final[$key])
                $fee = $request->fee_final[$key];
            else {
                $fee = $request->type[$key] == "urgent" ? $available_test->urgentFee : $available_test->testFee;
                if ($patient->category && $patient->category->discount)
                    $fee = $fee - ($fee * $patient->category->discount / 100);
            }

            //store
            $test_performed = new TestPerformed();
            $test_performed->available_test_id = $available_test_id;
            $test_performed->patient_id = $request->patient_id;
            $test_performed->Sname_id = $request->Sname_id[$key];
            $test_performed->type = $request->type[$key];
            $test_performed->specimen = "S-".Carbon::now()->format("y")."-".TestPerformed::next_id();
            $test_performed->fee = $fee;

            if (!empty($request->comments[$key])) {
                $test_performed->comments = $request->comments[$key];
            } else {
                $test_performed->comments = 0;
            }

            $test_performed->save();
            //dd($test_performed);
            //test_report store
            foreach ($available_test->TestReportItems->where("status", "active")->pluck("id") as $value) {
                $field_name = "testResult" . $value;
                if (!$request->$field_name[${"test" . $available_test_id}])
                    dd($field_name, $request->$field_name[${"test" . $available_test_id}], $request->all());

                TestReport::create([
                    'test_performed_id' => $test_performed->id,
                    'test_report_item_id' => $value,
                    'value' => $request->$field_name[${"test" . $available_test_id}],
                ]);
            }

        }

        return redirect()->route('tests-performed');
    }

    public function edit($id)
    {
        $performed = TestPerformed::findOrFail($id);
        $getNameFromAvailbles = AvailableTest::all()->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        $patientNames = Patient::all()->pluck('Pname', 'id')->prepend(trans('global.pleaseSelect'), '');
        $books = Status::pluck('Sname', 'id')->prepend(trans('global.pleaseSelect'), '');
        $allAvailableTests = AvailableTest::all();

        return view('admin.TestPerformed.edit', compact("allAvailableTests", 'performed', 'getNameFromAvailbles', 'patientNames', 'books'));
    }

    public function update($id, Request $request)
    {

        $test_performed = TestPerformed::findOrFail($id);
        $available_test = AvailableTest::findorfail($request->available_test_id);
        $patient = Patient::findorfail($request->patient_id);
        if (!$patient || !$available_test || !$test_performed)
            return abort(503, "Invalid request");

        //        inventory
        //        foreach ($available_test->available_test_inventories as $test_inventory) {
        //            $test_inventory->inventory->update([
        //                "remainingItem" => $test_inventory->inventory->remainingItem - $test_inventory->itemUsed
        //            ]);
        //        }

        //fee
        $fee = $request->type == "urgent" ? $available_test->urgentFee : $available_test->testFee;
        if ($patient->category && $patient->category->discount)
            $fee = $fee - ($fee * $patient->category->discount / 100);
        //        store
        $test_performed->update([
            'available_test_id' => $request->available_test_id,
            'patient_id' => $request->patient_id,
            'Sname_id' => $request->Sname_id,
            'type' => $request->type,
            "fee" => $fee
        ]);

        //test_report store
        $test_performed->testReport->each(function ($item, $key) {
            $item->delete();
        });
        foreach ($available_test->TestReportItems->pluck("id") as $value) {
            $field_name = "testResult" . $value;
            if (!isset($request->$field_name))
                continue;
            TestReport::create([
                'test_performed_id' => $test_performed->id,
                'test_report_item_id' => $value,
                'value' => $request->$field_name,
            ]);
        }

        return redirect()->route('tests-performed');

    }

    public function show($id)
    {
        $testPerformedsId = TestPerformed::findOrFail($id);
        $getpatient = $testPerformedsId->patient;
        return view('admin.TestPerformed.show', compact('testPerformedsId', 'getpatient'));
    }

    public function destroy($id)
    {
        $task = TestPerformed::findOrFail($id);
        $task->delete();
        Session::flash('flash_message', 'Task successfully deleted!');
        return redirect()->route('tests-performed');
    }
}
