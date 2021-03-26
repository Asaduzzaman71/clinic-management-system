<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PatientService;
use App\Services\DoctorService;
use App\Services\AppointmentService;
use App\Http\Requests\PrescriptionRequest;
use App\Services\PrescriptionService;
use Illuminate\Support\Facades\Session;

class PrescriptionController extends Controller
{
    protected $patientService;
    protected $prescriptionService;
    protected $doctorService;
    protected $appointmentService;
    public function __construct()
    {
        $this->middleware('auth');
        $this->patientService = new PatientService();
        $this->prescriptionService = new PrescriptionService();
        $this->doctorService = new DoctorService();
        $this->appointmentService = new AppointmentService();

    }

    public function getPrescriptionCreatedByDoctor($id)
    {
       
        $prescriptions = $this->prescriptionService->getPrescriptionListByDoctorId($id);
        $this->authorize('viewAny', Prescription::class); 
        return view('prescription.index',compact('prescriptions'));
    }

    public function getPrescriptionByPatientId($id)
    {
       
        $prescriptions = $this->prescriptionService->getPrescriptionListByPatientId($id);
        $this->authorize('viewAny', Prescription::class); 
        return view('prescription.index',compact('prescriptions'));
    }

    
    public function create()
    {
        $this->authorize('create', Prescription::class); 
        $doctor= $this->doctorService->getDoctorByUserId(Auth()->user()->id);
        $appointments = $this->appointmentService->getAppointedPatientDropdownByDoctorId($doctor->id);
        return view('prescription.create',compact('appointments','doctor'));
    }

    public function store(PrescriptionRequest $request)
    {
        $this->authorize('create', Prescription::class); 
        $validatedData = $request->validated();   
        $this->prescriptionService->createOrUpdate($validatedData);
        Session::flash('message','Information Added successfully!!!!');
        return redirect()->route('prescription.doctor',$validatedData['doctor_id']);
    }
    
    public function edit($id)
    {
        $prescription = $this->prescriptionService->getById($id);
        $this->authorize('update',$prescription); 
        $doctor= $this->doctorService->getDoctorByUserId(Auth()->user()->id);
        $appointments = $this->appointmentService->getAppointedPatientDropdownByDoctorId($doctor->id);          
        return view('prescription.edit', compact('prescription','doctor','appointments'));
    }
    
    public function update(PrescriptionRequest $request, $id)
    {
        $prescription = $this->prescriptionService->getById($id);
        $this->authorize('update',$prescription);
        $validatedData = $request->validated();
        $validatedData['id']=$id;//precsription id
        
        $this->prescriptionService->createOrUpdate($validatedData); 
     
        Session::flash('message','Information updated successfully!!!!');
        return redirect()->route('prescription.doctor',$validatedData['doctor_id']);
    }

    public function show($id){

        $prescription = $this->prescriptionService->getById($id);
        $this->authorize('view',$prescription);
        return view('prescription.show',compact('prescription'));
    }


    public function destroy($id)
    {

        $prescription = $this->prescriptionService->getById($id);
        $this->authorize('delete',$prescription);
        $doctor= $this->doctorService->getDoctorByUserId(Auth()->user()->id);
        $prescription = $this->prescriptionService->delete($id);
       
        if ($prescription) {
            Session::flash('message','Information deleted successfully!!!!');
            }
        return redirect()->route('prescription.doctor',$doctor->id);
    }
}
