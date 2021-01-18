<?php

namespace App\Http\ViewComposers;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;
use App\Models\Admin;

class UserComposer
{
   
    public function __construct()
    {
        
    }

    
    public function compose(View $view)
    {  
            $user=Auth::user();
            $userEmail=$user->email;
            $admin = Admin::where('email',$userEmail)->first();
            $view->with(['admin'=> $admin]);
      
    }
}