<?php

namespace App\Http\Controllers;
use App\Services\AppointmentService;
use App\Http\Requests\AppointmentRequest;
use App\Models\Appointment;
use Illuminate\Http\Request;


class AppointmentController extends Controller
{
    protected $appointmentService;

    public function __construct()
    {
        $this->middleware('auth');
        $this->appointmentService = new AppointmentService();
        
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
        $this->appointmentService->create($validatedData);
       
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
    public function checkAvailability(Request $request)
    {     
    
        $doctor_id=$request->doctor_id;
        $date=Carbon::parse($request->date)->format('d/m/Y');
        $day=Carbon::createFromFormat('m/d/Y', $date)->format('l');
        $day_id=Day::where('day_name','=',$day)
                  ->get();
        $data=Schedule::Where('doctor_id','=',$doctor_id)
                        ->Where('day_id','=',$day_id)
                        ->get();
        return $data;
        
    }
}
