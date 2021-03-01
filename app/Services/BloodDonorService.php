<?php
namespace App\Services;
use App\Models\BloodDonor;
use Illuminate\Support\Facades\Storage;
class BloodDonorService{


    public function bloodDonorList(){
        return BloodDonor::latest()->paginate(5);
    }
    public function createOrUpdate($data)
    {
        //dd($data);
          $user_id = auth()->user()->id;
          if(!empty($data["id"])){
            //exceptional part for updating data
                $BloodDonor = BloodDonor::whereId($data["id"])->first();
                $BloodDonor->updated_by = $user_id;
          }
          else{
                //create
                $BloodDonor = new BloodDonor();
                $BloodDonor->created_by = $user_id;
              }

          return $BloodDonor->fill($data)->save() ? $BloodDonor : null;
      }

    public function getById($id)
    {
        return BloodDonor::find($id);
    }
    public function delete($id)
    {
        $BloodDonor = BloodDonor::findOrFail($id);
        $BloodDonor->delete();
        return $BloodDonor;

    }

    public function getDropdownList()
    {
        return BloodDonor::pluck('BloodDonor_group', 'id');
    }
    

}