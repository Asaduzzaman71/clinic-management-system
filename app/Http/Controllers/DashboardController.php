<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Models\User;
use App\Models\Admin;

class DashboardController extends Controller
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

    public function index(){
        return view('login');
    }
   

    public function logout(){   
       Auth::logout();
    	return Redirect::to('/login');

    }

    public function dashboard(){
        $user=Auth::user();
        $userEmail=$user->email;
        $admin = Admin::where('email',$userEmail)->first();
        return view('dashboard',compact('admin'));
    }
}
