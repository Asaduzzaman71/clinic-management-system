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

    public function updateUser($data)
    {   
        $user = User::find($data->id);
        $user->name=$data->name;
        $user->password=$data->password;
        $user->email=$data->email;
        $user->role_id=$data->role_id;

       return $user->save() ? $user : null;
    }
}