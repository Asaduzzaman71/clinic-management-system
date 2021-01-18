<?php

namespace App\Services;
use App\Models\Admin;
use Illuminate\Support\Facades\Storage;


class AdminService
{
   
    public function createOrUpdate($data,$id)
    {   
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