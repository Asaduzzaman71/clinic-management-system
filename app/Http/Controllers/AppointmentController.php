<?php

namespace App\Http\Controllers;
use App\Services\AppointmentService;
use App\Services\PatientService;
use App\Http\Requests\AppointmentRequest;
use App\Models\Appointment;
use Illuminate\Http\Request;
use App\Models\Day;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;


class AppointmentController extends Controller
{
    protected $appointmentService;
    protected $patientService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->appointmentService = new AppointmentService();
        $this->patientService = new PatientService();
        
    }
    
    public function index()
    {
        //
    }

    
    public function create()
    {
        //
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
        $date=Carbon::parse($request->date)->format('d/m/Y');;
       
        //fetch day name from the date
        $day=Carbon::createFromFormat('d/m/Y', $date)->format('l');

        //fetch day from day table  to get the day id
        $day=$this->appointmentService->getDayIdByName($day);

       //to check whether the selected day is exist as schedule of the selected doctor 
        $schedule=$this->appointmentService->checkSchedule($doctor_id,$day->id);
        if($schedule!=NULL){
            //number of appointment on that day
            $appointmentsOnThatDay=$this->appointmentService->getAppointmentsOnThatDay($doctor_id,$request->date);

            //check booking appointments are less than allocated appointments 
            //If true then create appointment 
            if($appointmentsOnThatDay<$schedule->total_patient){
                $response=$this->appointmentService->create($validatedData);
                if(is_null($response)===false){
                    $message = "Appointment request has been taken successfully...";
                    session()->flash("message", $message);
                    return redirect()->back();
                }

            }
            else{
                Session::flash('message',"Sorry !We can't take no more appointment for today  ");
                return redirect()->back();
            }

        }
        else{
            Session::flash('message','Sorry!!!Doctor has no schedule on that day');
            return redirect()->back();
        }
       
       
    }

    
    public function show(Appointment $appointment)
    {
        //
    }

   
    public function edit(Appointment $appointment)
    {
        //
    }

   
    public function update(Request $request, Appointment $appointment)
    {
        //
    }

   
    public function destroy(Appointment $appointment)
    {
        //
    }





    // public function checkAvailability(Request $request)
    // {     
    
    //     $doctor_id=$request->doctor_id;
    //     $date=Carbon::parse($request->date)->format('d/m/Y');
    //     $day=Carbon::createFromFormat('m/d/Y', $date)->format('l');
    //     $day_id=Day::where('day_name','=',$day)
    //               ->get();
    //     $data=Schedule::Where('doctor_id','=',$doctor_id)
    //                     ->Where('day_id','=',$day_id)
    //                     ->get();
    //     return $data;
        
    // }
}
  