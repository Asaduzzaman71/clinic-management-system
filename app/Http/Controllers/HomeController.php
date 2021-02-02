<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;

class HomeController extends Controller
{
   
  

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function getDoctor(Request $request){

	    
        $data=Doctor::select('name','id')->where('department_id',$request->id)->take(100)->get();
        return response()->json($data);//then sent this data to ajax success
	

    }
}
