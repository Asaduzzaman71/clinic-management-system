<?php
namespace App\Services;
use App\Models\Appointment;
use App\Models\Day;
use Carbon\Carbon;
use App\Models\Schedule;
use Illuminate\Support\Facades\Session;
class AppointmentService{


    public function appointmentList(){
        return Appointment::latest()->get();
    }
    public function create($data){
            $appointment = new Appointment();
            if(Auth()->user()->id){

                $appointment->created_by = Auth()->user()->id;
            }
            return $appointment->fill($data)->save() ? $appointment : null;
               
      }

      public function getDayIdByName($day){          
        return Day::where('day_name','=',$day)->first();
      }

        public function checkSchedule($doctor_id,$dayId){
                
            return Schedule::Where(['doctor_id' => $doctor_id, 'day_id' => $dayId])->first();

        }


        public function getAppointmentsOnThatDay($doctor_id,$date){
            $appointmentlist = Appointment::where('doctor_id', '=', $doctor_id)
            ->where('date','=',$date)
            ->get();
            return $appointmentlist->count();

        }

        public function getById($id)
        {
            return appointment::find($id);
        }
        public function delete($id)
        {
            $appointment = appointment::findOrFail($id);
            $appointment->delete();
            return $appointment;

        }


}