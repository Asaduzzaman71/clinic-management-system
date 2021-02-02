<?php
namespace App\Services;
use App\Models\Appointment;
use App\Models\Day;
use Carbon\Carbon;
use App\Models\Schedule;
use Illuminate\Support\Facades\Session;
class AppointmentService{


    public function appointmentList(){
        return Appointment::latest()->paginate(10);
    }
    public function create($data){
            $appointment = new Appointment();
            if(Auth()->user()){

                $appointment->created_by = Auth()->user()->id;
            }
            else{
                $appointment->created_by =NULL;
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

        public function getRequestedAppointmentsByDoctorId($id){

           return   Appointment::where('doctor_id', '=', $id)
                                ->where('status','=',0)
                                ->get();
        }

        public function getPatientPendingAppointmentsByPatientId($patientId){
            return   Appointment::where('patient_id', '=', $patientId)
            ->where('status','=',0)
            ->get();

        }

        public function getPatientApprovedAppointmentsByPatientId($patientId){
            return   Appointment::where('patient_id', '=', $patientId)
            ->where('status','=',1)
            ->get();
        }

        public function approveRequestedAppointment($id){
            return   Appointment::where('id', '=', $id)->update(['status'=>1]);
            

        }

        public function getAppointmentById($appointment){
            return   Appointment::findOrFail($appointment);

        }
        public function getDoctorId($appointment){
             
            
        }

        public function getApprovedAppointmentsByDoctorId($id){
            return   Appointment::where('doctor_id', '=', $id)
                                ->where('status','=',1)
                                ->get();

        }
        public function getAppointedPatientDropdownByDoctorId($doctorId){
    
            return Appointment::where('doctor_id',$doctorId)->pluck('name', 'patient_id');

        }


}