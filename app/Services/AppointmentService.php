<?php
namespace App\Services;
use App\Models\Appointment;
use App\Models\Day;
use Carbon\Carbon;
use App\Models\Schedule;
class AppointmentService{


    public function appointmentList(){
        return Appointment::latest()->get();
    }
    public function create($data)
    {
              
                $appointment = new Appointment();
                if(Auth()->user()->id){

                    $appointment->created_by = Auth()->user()->id;
                }
                $doctor_id=$data['doctor_id'];
                $date=Carbon::parse($data['date'])->format('d/m/Y');
               
                $day=Carbon::createFromFormat('d/m/Y', $date)->format('l');
               
                //to check whether the selected day is exist as schedule of the selected doctor
                $day=Day::where('day_name','=',$day)
                          ->first();
                //selet the doctor schedule details of that day              
                $data=Schedule::Where([
                    'doctor_id' => $doctor_id,
                    'day_id' => $day->id
                   ])->first();
                
               

                return $appointment->fill($data)->save() ? $appointment : null;
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