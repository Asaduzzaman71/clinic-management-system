<?php

namespace App\Http\Controllers;
use App\Services\AppointmentService;
use App\Services\PatientService;
use App\Services\DoctorService;
use App\Services\DepartmentService;
use App\Http\Requests\AppointmentRequest;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Day;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\Events\NewAppointmentApprovedEvent;



class AppointmentController extends Controller
{
    protected $appointmentService;
    protected $patientService;
    protected $doctorService;
    protected $departmentService;

    public function __construct()
    {
      
        $this->appointmentService = new AppointmentService();
        $this->patientService = new PatientService();
        $this->doctorService = new DoctorService();
        $this->departmentService = new DepartmentService();
        
    }
    
    public function index()
    {
        //
    }

    
    public function create()
    {
        $departments = $this->departmentService->getDropdownList();
        return view('appointment.patient.create',compact('departments'));
    }

   
    public function store(AppointmentRequest $request)
    {
       
        $validatedData = $request->validated();
        if($validatedData['patient_id']!=NULL){
            $patient = $this->patientService->getById($validatedData['patient_id']);
            $validatedData['name']=$patient->name;
            $validatedData['email']=$patient->email;
            $validatedData['mobile']=$patient->mobile;
        }
        $doctor_id=$request->doctor_id;

        //change date format
        $date=Carbon::parse($request->date)->format('d/m/Y');
       
        //fetch day name from the date
        $day=Carbon::createFromFormat('d/m/Y', $date)->format('l');

        //fetch day from day table  to get the day id
        $day=$this->appointmentService->getDayIdByName($day);

       //to check whether the selected day is exist as appointment of the selected doctor 
        $appointment=$this->appointmentService->checkSchedule($doctor_id,$day->id);
        if($appointment!=NULL){
            //number of appointment on that day
            $appointmentsOnThatDay=$this->appointmentService->getAppointmentsOnThatDay($doctor_id,$request->date);

            //check booking appointments are less than allocated appointments 
            //If true then create appointment 
            if($appointmentsOnThatDay<$appointment->total_patient){
                $response=$this->appointmentService->create($validatedData);
                if(is_null($response)===false){
                   // $message = "Appointment request has been taken successfully...";
                    // $notification = array(
                    //     'message' => 'Appointment request has been taken successfully!',
                    //     'alert-type' => 'success'
                    // );
                    session()->flash("success", "Appointment request has been taken successfully...");
                    return redirect()->back();
                    //return redirect()->back()->with($notification);
                }

            }
            else{
                Session::flash('error',"Sorry !We can't take no more appointment for today  ");
                return redirect()->back();
                // $notification = array(
                //     'message' => "Sorry !We can't take no more appointment for today ",
                //     'alert-type' => 'info'
                // );
                //return redirect()->back()->with($notification);
                //
            }

        }
        else{
            Session::flash('error','Sorry!!!Doctor has no appointment on that day');
            return redirect()->back();
            // $notification = array(
            //     'message' => "Sorry!!!Doctor has no appointment on that day",
            //     'alert-type' => 'success'
            // );
            //return redirect()->back()->with($notification);
        }
       
       
    }

    
    public function appointmentDetails(Request $request)
    {  
        $this->authorize('view',$request->id); 
        $appointment=$this->appointmentService->getAppointmentById($request->id);
        $doctor = $this->doctorService->getById($appointment->doctor_id);
        return response()->json([
            'data' => $appointment,
            'doctor'=>$doctor
          ]);
    }

   
    

   
    public function destroy($appointmentid)
    {

        $appointment=$this->appointmentService->getAppointmentById($appointmentid);
        $this->authorize('delete', $appointment); 
     
        $response = $this->appointmentService->delete($appointmentid);
      
       
        if ($response !=NULL && $appointment->status==1) {
            Session::flash('message','Information deleted successfully!!!!');
            return redirect()->route('appointments.approved',$appointment->doctor_id);
            }
        else if($appointment !=NULL && $appointment->status==0){
            Session::flash('message','Information deleted successfully!!!!');
            return redirect()->route('appointments.requested',$appointment->doctor_id);
        }

    }

    public function getRequestedAppointments($doctor){
        $this->authorize('viewAny', Appointment::class); 
        $appointments=$this->appointmentService->getRequestedAppointmentsByDoctorId($doctor);
        return view('appointment.requests',compact('appointments'));
    }

    public function getPatientPendingAppointments($patient){
        $this->authorize('viewAny', Appointment::class); 
        $appointments=$this->appointmentService->getPatientPendingAppointmentsByPatientId($patient);
        return view('appointment.patient.pending',compact('appointments'));
    }
    public function getPatientAcceptedAppointments($patient){
        $this->authorize('viewAny', Appointment::class); 
        $appointments=$this->appointmentService->getPatientApprovedAppointmentsByPatientId($patient);
        return view('appointment.patient.approved',compact('appointments'));

    }

    public function approveAppointments($appointmentId){
        $this->authorize('viewAny', Appointment::class); 
        $this->appointmentService->approveRequestedAppointment($appointmentId);
        $appointment=$this->appointmentService->getAppointmentById($appointmentId);
        //dd($appointment);
        event(new NewAppointmentApprovedEvent($appointment));
        
      
        if(is_null($appointment)===false){
            $message = "Appointment request has been approved successfully...";
            session()->flash("message", $message);
            return redirect()->route('appointments.requested',$appointment->doctor_id);
        }
    }

    public function getApprovedAppointments($doctor){
        $this->authorize('viewAny', Appointment::class); 
        $appointments=$this->appointmentService->getApprovedAppointmentsByDoctorId($doctor);
        return view('appointment.approved',compact('appointments'));

    }

    





    // public function checkAvailability(Request $request)
    // {     
    
    //     $doctor_id=$request->doctor_id;
    //     $date=Carbon::parse($request->date)->format('d/m/Y');
    //     $day=Carbon::createFromFormat('m/d/Y', $date)->format('l');
    //     $day_id=Day::where('day_name','=',$day)
    //               ->get();
    //     $data=appointment::Where('doctor_id','=',$doctor_id)
    //                     ->Where('day_id','=',$day_id)
    //                     ->get();
    //     return $data;
        
    // }
}
  