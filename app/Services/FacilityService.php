<?php
namespace App\Services;
use App\Models\Facility;
use Illuminate\Support\Facades\Storage;
class FacilityService{


    public function facilityList(){
        return Facility::latest()->paginate(2);
    }
    public function createOrUpdate($data)
    {
        //dd($data);
          $user_id = auth()->user()->id;
          if(!empty($data["id"])){
            //exceptional part for updating data
                $facility = Facility::whereId($data["id"])->first();
                $facility->updated_by = $user_id;
          }
          else{
                //create
                $facility = new Facility();
                $facility->created_by = $user_id;
              }

          return $facility->fill($data)->save() ? $facility : null;
      }

    public function getById($id)
    {
        return Facility::find($id);
    }
    public function delete($id)
    {
        $facility = Facility::findOrFail($id);
        if ($facility) {
            if (file_exists($facility->icon)) 
                    { 
                        Storage::delete($facility->icon);
                    }
        }
        $facility->delete();
        return $facility;

    }
//     public function getIdByName($name)
//     {
//          $facility = facility::where('name',$name)->select('id')->first();
// ​
//          return isset($facility) ? $facility->id : null;
//     }
//     public function delete($facility)
//     {
//         $facility = $facility->delete();
//         return $facility;
//     }
//      public function getDropdownList()
//     {
//         return facility::pluck('name', 'id');
//     }

}