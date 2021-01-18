<?php

namespace App\Services;
use App\Models\User;



class UserService
{
   
    public function createUser($data)
    {   
        $user=new User();
        $user->name=$data['name'];
        $user->email=$data['email'];
        $user->password=bcrypt($data['password']);
        $user->role_id=$data['role_id'];


        return $user->save() ? $user : null;
    }

    public function updateUser($doctor)
    {   
        $user = User::find($doctor->user_id);
        $user->name=$doctor->name;
        $user->password=$doctor->password;
        $user->email=$doctor->email;
        $user->role_id=$doctor->role_id;

       return $user->save() ? $user : null;
    }
}