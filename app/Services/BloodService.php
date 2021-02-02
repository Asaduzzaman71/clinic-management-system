<?php
namespace App\Services;
use App\Models\Blood;
use Illuminate\Support\Facades\Storage;
class BloodService{


    public function bloodList(){
        return Blood::latest()->paginate(3);
    }
    public function createOrUpdate($data)
    {
        //dd($data);
          $user_id = auth()->user()->id;
          $data['blood_group']=strtoupper( $data['blood_group']);
          if(!empty($data["id"])){
            //exceptional part for updating data
                $blood = Blood::whereId($data["id"])->first();
                $blood->updated_by = $user_id;
          }
          else{
                //create
                $blood = new Blood();
                $blood->created_by = $user_id;
              }

          return $blood->fill($data)->save() ? $blood : null;
      }

    public function getById($id)
    {
        return Blood::find($id);
    }
    public function delete($id)
    {
        $blood = Blood::findOrFail($id);
        $blood->delete();
        return $blood;

    }

    public function getDropdownList()
    {
        return Blood::pluck('blood_group', 'id');
    }
    

}