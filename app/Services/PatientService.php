<?php
namespace App\Services;
use App\Models\Patient;
use Illuminate\Support\Facades\Storage;
class PatientService{

    public function patientList(){
        return Patient::latest()->paginate(10);
    }
    public function createOrUpdate($data)
    {
          $user_id = auth()->user()->id;
          $user_role=auth()->user()->role_id;
          $data['password']=bcrypt($data['password']);
          $data['role_id']=$user_role;

          //patient data will be updated if we get patient id from the form request
          if(!empty($data["id"])){
            //exceptional part for updating data
                $patient = Patient::whereId($data["id"])->first();
                $patient->updated_by = $user_id;
                //delete existing image 
                if (isset($data['image'])){
                    if (file_exists($patient->image)) 
                    { 
                        $filePath = public_path($patient->image);
                        unlink($filePath);
                    }
                    
                }
          }
          else{
                //create
                $patient = new Patient();
                $patient->created_by = $user_id;
              }

          return $patient->fill($data)->save() ? $patient : null;
      }

    public function getById($id)
    {
        return Patient::find($id);
    }
    public function delete($id)
    {
        $patient = Patient::findOrFail($id);
        if ($patient) {
            if (file_exists($patient->image)) 
                    { 
                        Storage::delete($patient->image);
                    }
        }
        $patient->forceDelete();
        return $patient;

    }

    public function getDropdownList()
    {
        return Patient::pluck('name', 'id');
    }

    public function userIdUpdate($id,$userId)
    {

       return  Patient::where('id',$id)->update(['user_id'=>$userId]);
    }
    
}