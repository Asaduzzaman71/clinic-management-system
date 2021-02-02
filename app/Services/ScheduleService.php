<?php
namespace App\Services;
use App\Models\Schedule;
class ScheduleService{


    public function scheduleList(){
        return Schedule::latest()->paginate(2);
    }
    public function createOrUpdate($data)
    {
        
          $user_id = auth()->user()->id;
          if(!empty($data["id"])){
            //exceptional part for updating data
                $schedule = Schedule::whereId($data["id"])->first();
                $schedule->updated_by = $user_id;
          }
          else{
                //create
                $schedule = new schedule();
                $schedule->created_by = $user_id;
              }

          return $schedule->fill($data)->save() ? $schedule : null;
      }

    public function getById($id)
    {
        return schedule::find($id);
    }
    public function delete($id)
    {
        $schedule = schedule::findOrFail($id);
        $schedule->delete();
        return $schedule;

    }


}