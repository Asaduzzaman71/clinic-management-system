<?php
namespace App\Services;
use App\Models\Department;
use Illuminate\Support\Facades\Storage;
class DepartmentService{


    public function departmentList(){
        return Department::latest()->get();
    }
    public function createOrUpdate($data)
    {
        //dd($data);
          $user_id = auth()->user()->id;
          if(!empty($data["id"])){
            //exceptional part for updating data
                $department = Department::whereId($data["id"])->first();
                $department->updated_by = $user_id;
                //delete existing image 
                if (isset($data['icon'])){
                    if (file_exists($department->icon)) 
                    { 
                        $oldFile=$department->icon;
                        Storage::delete($oldFile);
                    }
                    
                }
          }
          else{
                //create
                $department = new Department();
                $department->created_by = $user_id;
              }

          return $department->fill($data)->save() ? $department : null;
      }

    public function getById($id)
    {
        return Department::find($id);
    }
    public function delete($id)
    {
        $department = Department::findOrFail($id);
        if ($department) {
            if (file_exists($department->icon)) 
                    { 
                        Storage::delete($department->icon);
                    }
        }
        $department->delete();
        return $department;

    }

    public function getDropdownList()
    {
        return Department::pluck('name', 'id');
    }
    public function getDepartment()
    {
        return Department::all();
    }
//     public function getIdByName($name)
//     {
//          $department = Department::where('name',$name)->select('id')->first();
// ​
//          return isset($department) ? $department->id : null;
//     }
//     public function delete($department)
//     {
//         $department = $department->delete();
//         return $department;
//     }
    

}