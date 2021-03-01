<?php
namespace App\Services;
use App\Models\Setting;
class SettingService{


    public function SettingData(){
        return Setting::first();
    }
    public function createOrUpdate($data)
    {
        
          $user_id = auth()->user()->id;
          if(!empty($data["id"])){
            //exceptional part for updating data
                $Setting = Setting::whereId($data["id"])->first();
                $Setting->updated_by = $user_id;
          }
          else{
                //create
                $Setting = new Setting();
                $Setting->created_by = $user_id;
              }

          return $Setting->fill($data)->save() ? $Setting : null;
      }

    public function getById($id)
    {
        return Setting::find($id);
    }
    public function delete($id)
    {
        $Setting = Setting::findOrFail($id);
        $Setting->delete();
        return $Setting;

    }


}