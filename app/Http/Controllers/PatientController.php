<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Patient;
use App\Http\Requests\PatientRequest;
use App\Services\PatientService;
use App\Services\BloodService;
use App\Services\UserService;
use App\Traits\FileUpload;
use Illuminate\Support\Facades\Session;

class PatientController extends Controller
{


    use FileUpload;
    protected $bloodService;
    protected $patientService;
    protected $userService;
    public function __construct()
    {
        $this->middleware('auth');
        $this->patientService = new patientService();
        $this->bloodService = new bloodService();
        $this->userService = new UserService();
   
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny',Patient::class);
        $patients = $this->patientService->patientList();
        return view('patient.index',compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',Patient::class);
        $bloods = $this->bloodService->getDropdownList();
        return view('patient.create',compact('bloods'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientRequest $request)
    {
        $this->authorize('create',Patient::class);
        $validatedData = $request->validated();
        $validatedData['role_id']=$request->role_id;
        if ($request->hasFile('image')) {
            $validatedData['image'] = $this->ImageUpload($request, 'image', 'patient/', 'patient_');
        }

        $patient=$this->patientService->createOrUpdate($validatedData);
        if($patient){
            $user=$this->userService->createUser($validatedData);
            $patient=$this->patientService->userIdUpdate($patient->id,$user->id);
            
        }
        Session::flash('message','Information Added successfully!!!!');
        return redirect()->route('patients.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $patient = $this->patientService->getById($id);
        $this->authorize('view',$patient); 
        return view('patient.show', compact('patient'));    
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $patient = $this->patientService->getById($id);
        $this->authorize('update',$patient);
        $bloods = $this->bloodService->getDropdownList();           
        return view('patient.edit', compact('patient','bloods'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function update(PatientRequest $request, $id)
    {
        $patient = $this->patientService->getById($id);
        $this->authorize('update',$patient);
        $validatedData = $request->validated();
        $validatedData['role_id']=$request->role_id;//patient role id
        $validatedData['user_id']=$request->user_id;//patient user id 
        $validatedData['id']=$id;//patient id


        
        if ($request->hasFile('image')) {
            $validatedData['image'] = $this->ImageUpload($request, 'image', 'patient/', 'patient_');
        }
        
        $patient=$this->patientService->createOrUpdate($validatedData); 
        if($patient){
            $user=$this->userService->updateUser($patient);      
        }
        Session::flash('message','Information updated successfully!!!!');
        return redirect()->route('patients.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Patient  $patient
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $patient = $this->patientService->getById($id);
        $this->authorize('delete',$patient);
        $patient = $this->patientService->delete($id);
       
        if ($patient) {
            Session::flash('message','Information deleted successfully!!!!');
            }
        return redirect()->route('patients.index');
    }

    public function liveSearchPatient(Request $request)
    {
       
        if($request->ajax()) {
            $data =Patient::Where('name','LIKE','%'.$request->name.'%')
                ->get();
            $output = '';
            if (count($data)>0) {
              
                $output = '<ul class="list-group" style="display: block; position: relative; z-index: 1">';
                foreach ($data as $row){   
                    $output .= '<li class="list-group-item">'.$row->name.'</li>';
                }
                $output .= '</ul>';
            }
            else {
                $output .= '<li class="list-group-item">'.'No results'.'</li>';
            }
            return $output;
        }
    }

    public function searchPatient(Request $request){
        
            $data =Patient::Where('name',$request->name)
                ->first(); 
            return response()->json($data);
    }

    function liveSearchPatientInformation(Request $request)
    {
       
      $query = $request->get('query');
      
      
      if($query != '')
      {
        
        $patients =Patient::
            where('name', 'like', '%'.$query.'%')
            ->orWhere('mobile', 'like', '%'.$query.'%')
            ->orWhere('email', 'like', '%'.$query.'%')
            ->orderBy('id', 'desc')
            ->paginate(10);
      
         
      }
      else
      {
        $patients =Patient::paginate(10);
      }
  
      return view('patient.index',compact('patients'));
     }
    
}