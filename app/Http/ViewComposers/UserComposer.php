<?php

namespace App\Http\ViewComposers;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Admin;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Laboratorist;
use App\Models\Accountant;

class UserComposer
{
   
    public function __construct()
    {
        
    }

    
    public function compose(View $view)
    {  
            $user=Auth::user();
            $userRole=$user->role_id;
            $userId=$user->id;
            if($userRole==1){

                $admin = Admin::where('user_id',$userId)->first();
                $view->with(['admin'=> $admin]);
            }
            else if($userRole==2){

                $doctor = Doctor::where('user_id',$userId)->first();
                $view->with(['doctor'=> $doctor]);
            }
            else if($userRole==3){

                $patient = Patient::where('user_id',$userId)->first();
                $view->with(['patient'=> $patient]);
            }
            elseif($userRole==4){
                $accountant = Accountant::where('user_id',$userId)->first();
                $view->with(['accountant'=> $accountant]);
            }
            else{
                $laboratorist = Laboratorist::where('user_id',$userId)->first();
                $view->with(['laboratorist'=> $laboratorist]);
            }
           
      
    }
}