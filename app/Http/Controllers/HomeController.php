<?php
namespace App\Http\Controllers;
use App\Models\AvailableTest;
use App\Models\TestPerformed;
use App\Models\Category;
use App\Models\TestReport;
use Illuminate\Http\Request;
use Carbon\Carbon;
use DB;
class HomeController extends Controller
{
    public function index()
    {
        $todayDate = Carbon::today();
        // dd($todayDate);
     
        $data = DB::table('test_performeds')->where('Sname_id', '=', '2')->get();
        $today =$data->where('created_at', '>=',$todayDate)->count();
        // dd($today);
        $thisWeekPatient=$data->where('created_at', '>=', Carbon::now()->subDays(7))->count();
        $thisMongthPatient=$data->where('created_at', '>=', Carbon::now()->subDays(30))->count();
          
        $allPerformedToday = TestReport::join('test_report_items', 'test_reports.test_report_item_id', '=', 'test_report_items.id')
        ->join('test_performeds', 'test_reports.test_performed_id', '=', 'test_performeds.id')
        ->join('available_tests', 'test_performeds.available_test_id', '=', 'available_tests.id')
        ->join('patients', 'test_performeds.patient_id', '=', 'patients.id')
        ->get();

        
          $criticalTestToday=array();
          foreach ($allPerformedToday as $performed) {
                if($performed->value <= $performed->firstCriticalValue || $performed->value >= $performed->finalCriticalValue)
                {
                array_push($criticalTestToday,$performed);
                }
            }
        $todayDelayeds = TestPerformed::where('created_at','>=',$todayDate)->latest()->get();
  // $a = $todayDelayeds->availableTest->timehour + $todayDelayeds->created_at->timestamp;
        // dd($a);        $testPerformed = TestPerformed::get();
        $testPerformeds = TestPerformed::join('patients', 'test_performeds.patient_id', '=', 'patients.id')
            ->join('statuses', 'test_performeds.Sname_id', '=', 'statuses.id')
            ->join('available_tests', 'test_performeds.available_test_id', '=', 'available_tests.id')
            ->join('categories', '.available_tests.category_id', '=', 'categories.id')
            ->select('categories.Cname','available_tests.name','available_tests.timehour','patients.Pname','statuses.Sname','test_performeds.created_at')
            ->orderBy('patient_id', 'DESC')
            ->get();

        $availableTestNameAndCountTests = AvailableTest::withCount(['testPerformed'])
            ->orderBy('test_performed_count', 'desc')
            ->get();
  

        $test = DB::table('test_performeds')
            ->get('id'); 
        $distincrCatagory2 = $test->count();   


        $distincrCatagory = Category::distinct()->get();
        $test = DB::table('test_performeds')
            ->get('id'); 
        $distincrCatagory2 = $test->count();    
    
        return view('home', compact('today','thisWeekPatient','thisMongthPatient',
        'distincrCatagory2','todayDelayeds','criticalTestToday','testPerformeds','availableTestNameAndCountTests'));
        
    }
   
}