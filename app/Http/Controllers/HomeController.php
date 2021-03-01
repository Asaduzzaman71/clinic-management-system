<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\Schedule;
use App\Models\Setting;

class HomeController extends Controller
{
   
  

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $doctors=Doctor::all();
        $setting=Setting::first();
       
        
        return view('home',compact('doctors','setting'));
    }
    public function doctorDetails($doctorId)
    {
        $doctor=Doctor::find($doctorId);
        $schedules = Schedule::where('doctor_id',$doctorId)->get();
        return view('appointment',compact('doctor','schedules'));
    }

    public function getDoctor(Request $request){

	    
        $data=Doctor::select('name','id')->where('department_id',$request->id)->take(100)->get();
        return response()->json($data);//then sent this data to ajax success
	

    }
}
