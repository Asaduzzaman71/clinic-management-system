<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use App\Models\Doctor;
use App\Services\ScheduleService;
use App\Services\DepartmentService;
use App\Services\DayService;
use Illuminate\Http\Request;
use App\Http\Requests\ScheduleRequest;
use Illuminate\Support\Facades\Session;

class ScheduleController extends Controller
{


    protected $departmentService;
    protected $dayService;
    protected $scheduleService;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
        $this->departmentService = new DepartmentService();
        $this->dayService = new DayService();
        $this->scheduleService = new ScheduleService();
        
   
    }
    public function index()
    {
        $schedules = $this->scheduleService->scheduleList();
        
        return view('schedule.index',compact('schedules'));
    }

    public function create()
    {
        $departments = $this->departmentService->getDropdownList();
        $days = $this->dayService->getDropdownList();
        return view('schedule.create',compact('departments','days'));
    }

 
    public function store(ScheduleRequest $request)
    {
        $validatedData = $request->validated();
        $this->scheduleService->createOrUpdate($validatedData);
        Session::flash('message','Information Added successfully!!!!');
        return redirect()->route('schedules.index');
    }

  
    public function show(Schedule $schedule)
    {
        //
    }

  
    public function edit($id)
    {
        $schedule = $this->scheduleService->getById($id);
        $departments = $this->departmentService->getDropdownList();
        $days = $this->dayService->getDropdownList();           
        return view('schedule.edit', compact('schedule','days','departments'));
    }

   

    public function update(ScheduleRequest $request, $id)
    {
        $validatedData = $request->validated();
        $validatedData['id']=$id;//schedule id
        
        $this->scheduleService->createOrUpdate($validatedData); 
     
        Session::flash('message','Information updated successfully!!!!');
        return redirect()->route('schedules.index');
    }

   
    public function destroy($id)
    {
        $schedule = $this->scheduleService->delete($id);
       
        if ($schedule) {
            Session::flash('message','Information deleted successfully!!!!');
            }
        return redirect()->route('schedules.index');
    }
                                                                                                                                               
    public function getDoctor(Request $request){

	    
        $data=Doctor::select('name','id')->where('department_id',$request->id)->take(100)->get();
        return response()->json($data);//then sent this data to ajax success
	

    }
}
