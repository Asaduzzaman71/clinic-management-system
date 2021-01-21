<?php

namespace App\Services;
use App\Models\Admin;
use Illuminate\Support\Facades\Storage;


class AdminService
{
   
    public function createOrUpdate($data,$id)
    {   
        $user_role=auth()->user()->role_id;
        $data['password']=bcrypt($data['password']);
        $data['role_id']=$user_role;
        if (!empty($id)) {
            $admin = Admin::findOrFail($id);
            if (isset($data['image'])) {
                if (file_exists($admin->image)) 
                { 
                     $oldFile=$admin->image;
                     Storage::delete($oldFile);
                }
                $admin->image = $data['image'];
            }   
        } 
        else 
        {
          $admin = new admin();
        }
        return $admin->fill($data)->save() ? $admin : null;
    }

    public function getAdminByAdminId($id)
    {
     return Admin::find($id);
    }
}