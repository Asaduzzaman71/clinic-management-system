<?php
namespace App\Services;
use App\Models\Doctor;
use Illuminate\Support\Facades\Storage;
class doctorService{


    public function doctorList(){
        return Doctor::latest()->get();
    }
    public function createOrUpdate($data)
    {
          $user_id = auth()->user()->id;
          $user_role=auth()->user()->role_id;
          $data['password']=bcrypt($data['password']);
          $data['role_id']=$user_role;

          //doctor data will be updated if we get doctor id from the form request
          if(!empty($data["id"])){
            //exceptional part for updating data
                $doctor = Doctor::whereId($data["id"])->first();
                $doctor->updated_by = $user_id;
                //delete existing image 
                if (isset($data['image'])){
                    if (file_exists($doctor->image)) 
                    { 
                        $oldFile=$doctor->image;
                        Storage::delete($oldFile);
                    }
                    
                }
          }
          else{
                //create
                $doctor = new Doctor();
                $doctor->created_by = $user_id;
              }

          return $doctor->fill($data)->save() ? $doctor : null;
      }

    public function getById($id)
    {
        return Doctor::find($id);
    }

    public function getDoctorByUserId($userId){
        return  Doctor::where('user_id','=',$userId)->first();
    }


    public function delete($id)
    {
        $doctor = Doctor::findOrFail($id);
        if ($doctor) {
            if (file_exists($doctor->image)) 
                    { 
                        Storage::delete($doctor->image);
                    }
        }
        $doctor->delete();
        return $doctor;

    }

    public function getDropdownList()
    {
        return doctor::pluck('name', 'id');
    }

    public function userIdUpdate($id,$userId)
    {

       return  Doctor::where('id',$id)->update(['user_id'=>$userId]);
    }
//     public function getIdByName($name)
//     {
//          $doctor = doctor::where('name',$name)->select('id')->first();
// ​
//          return isset($doctor) ? $doctor->id : null;
//     }
//     public function delete($doctor)
//     {
//         $doctor = $doctor->delete();
//         return $doctor;
//     }
    

}