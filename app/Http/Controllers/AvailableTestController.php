<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Models\AvailableTest;
use App\Models\TestPerformed;
use App\Models\Inventory;
use App\Models\AvailableTestInventory;
use App\Models\TestReportItem;
use Carbon\Carbon;
use Session;
use App\Models\Category;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response; 
class AvailableTestController extends Controller
{
    public function index()
    {
        $availableTests = AvailableTest::all();
        return view('admin.availableTests.index', compact('availableTests'));
    }
    public function create()
    {
        $inventoryes = Inventory::all()->pluck('inventoryName', 'id')->prepend(trans('global.pleaseSelect'), '');
        $categoryNames = Category::all()->pluck('Cname', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('admin.availableTests.create', compact('categoryNames', 'inventoryes'));
    }
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|unique:available_tests|min:5',
        ]);
        $availableTestId = AvailableTest::create([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'testFee' => $request->testFee,
            'urgentFee' => $request->urgentFee,
            'timehour' => $request->timehour,
        ]);
        //available_test_inventories
        $data = []; 
        foreach ($request->inventory_ids as $key => $value) {
            $data[] = new AvailableTestInventory([  
                "inventory_id" => $value,
                "itemUsed" => $request->inventory_quantity[$key]
            ]);
        }
        $availableTestId->available_test_inventories()->saveMany($data);
        //TestReportItem
        $data = [];
        foreach ($request->title as $key => $value) {
            $data[] = new TestReportItem([
                "title" => $value,
                'normalRange' => $request->normalRange[$key],
                // 'finalNormalValue' => $request->finalNormalValue[$key],
                'firstCriticalValue' => $request->firstCriticalValue[$key],
                'finalCriticalValue' => $request->finalCriticalValue[$key],
                'unit' => $request->units[$key],
            ]);
        }
        $availableTestId->TestReportItems()->saveMany($data);
        return redirect()->route('available-tests');
    }
    public function edit($id)
    {
        $availableTest = AvailableTest::findOrFail($id);
        $catagorys = Category::all()->pluck('Cname', 'id')->prepend(trans('global.pleaseSelect'), '');
        $inventoryes = Inventory::all()->pluck('inventoryName', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('admin.availableTests.edit', compact('availableTest', 'catagorys', "inventoryes"));
    }
    public function update($id, Request $request)
    {
        $task = AvailableTest::findOrFail($id);
        $input = $request->all();
        $task->fill([
            'category_id' => $request->category_id,
            'name' => $request->name,
            'testFee' => $request->testFee,
            'urgentFee' => $request->urgentFee,
        ])->save();
        $task->available_test_inventories()->whereNotIn("inventory_id", $request->inventory_ids)->delete();
        $data = [];
        foreach ($request->inventory_ids as $key => $value) {
            if (in_array($value, $task->available_test_inventories()->pluck("inventory_id")->all())) {
                $task->available_test_inventories()->where("inventory_id", $value)->first()->update([
                    "itemUsed" => $request->inventory_quantity[$key]
                ]);
                continue;
            }
            $data[] = new AvailableTestInventory([
                "inventory_id" => $value,
                "itemUsed" => $request->inventory_quantity[$key]
            ]);
        }
        $task->available_test_inventories()->saveMany($data);
        //TestReportItems
        $task->TestReportItems()->whereNotIn("status", ["inactive","deleted"])->update([
            "status"=>"inactive"
        ]);
        $data = [];
        foreach ($request->title as $key => $value) {
            $data[] = new TestReportItem([
                "title" => $value,
                'normalRange' => $request->normalRange[$key],
                // 'finalNormalValue' => $request->finalNormalValue[$key],
                'firstCriticalValue' => $request->firstCriticalValue[$key],
                'finalCriticalValue' => $request->finalCriticalValue[$key],
                'unit' => $request->units[$key],
            ]);
        }
        $task->TestReportItems()->saveMany($data);
        return redirect()->route('available-tests');
    }
    public function show($id)
    {
        $availableTestId = AvailableTest::findOrFail($id);
        return view('admin.availableTests.show', compact('availableTestId'));
    }
    public function destroy($id)
    {
        $task = AvailableTest::findOrFail($id);
        $task->delete();
        return redirect()->route('available-tests');
    }
}
