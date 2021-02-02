<?php
namespace App\Services;
use App\Models\Prescription;
class PrescriptionService{


  public function getPrescriptionListByDoctorId($id){
        return Prescription::where('doctor_id', '=', $id)
                            ->where('status','=',1)
                            ->paginate(10);
    }

    public function getPrescriptionListByPatientId($id){
        return Prescription::where('patient_id', '=', $id)
        ->where('status','=',1)
        ->paginate(10);
    }

    public function createOrUpdate($data)
    {
        
          $user_id = auth()->user()->id;
          if(!empty($data["id"])){
            //exceptional part for updating data
                $prescription = prescription::whereId($data["id"])->first();
                $prescription->updated_by = $user_id;
          }
          else{
                //create
                $prescription = new prescription();
                $prescription->created_by = $user_id;
              }

          return $prescription->fill($data)->save() ? $prescription : null;
      }

    public function getById($id)
      {
          return Prescription::find($id);
      }

    public function delete($id)
    {
        $prescription = Prescription::findOrFail($id);
        $prescription->delete();
        return $prescription;

    }

}
