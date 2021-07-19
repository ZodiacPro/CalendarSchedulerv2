<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\TaskModel;
use DataTables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = TaskModel::get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
   
                          
   
                           $btn = ' <a href="'.route('deleteTask',$row->id).'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }

        $number_of_days = cal_days_in_month(CAL_GREGORIAN, date('m'), date('Y'));
        $timestamp = strtotime(date('Y-m-01'));
        $firstday = date('l', $timestamp);

        if($firstday == 'Sunday') $skip = 0;
        elseif($firstday == 'Monday') $skip = 1;
        elseif($firstday == 'Tuesday') $skip = 2;
        elseif($firstday == 'Wednesday') $skip = 3;
        elseif($firstday == 'Thursday') $skip = 4;
        elseif($firstday == 'Friday') $skip = 5;
        elseif($firstday == 'Saturday') $skip = 6;

        $taskCount = TaskModel::count();
        $taskdata = TaskModel::where('start_date' ,'>=', date('Y-m-01'))
                                ->where('start_date' ,'<=', date('Y-m-'.$number_of_days))
                                ->orwhere('end_date' ,'>=', date('Y-m-01'))
                                ->where('end_date' ,'<=', date('Y-m-'.$number_of_days))
                                ->get();
      
       

        return view('dashboard', compact('number_of_days','skip','taskCount','taskdata'));
    }

    public function getCalendar(Request $request){

        $number_of_days = cal_days_in_month(CAL_GREGORIAN, $request->month, $request->year);
        $timestamp = strtotime(date($request->year.'-'.$request->month.'-01'));
        $firstday = date('l', $timestamp);

        if($firstday == 'Sunday') $skip = 0;
        elseif($firstday == 'Monday') $skip = 1;
        elseif($firstday == 'Tuesday') $skip = 2;
        elseif($firstday == 'Wednesday') $skip = 3;
        elseif($firstday == 'Thursday') $skip = 4;
        elseif($firstday == 'Friday') $skip = 5;
        elseif($firstday == 'Saturday') $skip = 6;

        $taskdata = TaskModel::where('start_date' ,'>=', date('Y-m-01'))
                                ->where('start_date' ,'<=', date('Y-m-'.$number_of_days))
                                ->orwhere('end_date' ,'>=', date('Y-m-01'))
                                ->where('end_date' ,'<=', date('Y-m-'.$number_of_days))
                                ->get();

        $calData = [
            'number_of_days' => $number_of_days,
            'skip'          => $skip,
            'taskdata'      =>$taskdata,
            'yearmonth'     =>$request->year.'-'.$request->month.'-',
        ];


        return $calData;
    }


    public function addTask(Request $request){
    
        if( $request->name == '' ||
            $request->desc == '' ||
            $request->from == '' ||
            $request->to == '' ||
            $request->creator_id == ''
        ){
            return 'error';
        }


        $formData = [
            'name' => $request->name,
            'description' => $request->desc,
            'start_date' => $request->from,
            'end_date' => $request->to,
            'creator_id' => $request->creator_id,
            'color' => $rand_color = "#".substr(md5(rand()), 0, 6)
        ];
       
        TaskModel::insert($formData);

        return 'success';

    }

    public function delete($id){
        TaskModel::where('id', $id)->delete();
        return redirect('home');
    }
}
