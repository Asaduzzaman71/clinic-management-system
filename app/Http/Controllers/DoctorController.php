<?php

namespace App\Http\Controllers;

use App\Models\Doctor;
use App\Models\Department;
use App\Http\Requests\DoctorRequest;
use App\Services\DepartmentService;
use App\Services\DoctorService;
use App\Services\UserService;
use Illuminate\Http\Request;
use App\Traits\FileUpload;
use Illuminate\Support\Facades\Session;

class DoctorController extends Controller
{
    use FileUpload;
    protected $departmentService;
    protected $doctorService;
    protected $userService;
    public function __construct()
    {
        $this->middleware('auth');
        $this->doctorService = new DoctorService();
        $this->departmentService = new DepartmentService();
        $this->userService = new UserService();
   
    }
   
    public function index()
    {
        $this->authorize('viewAny',Doctor::class);
        $doctors = $this->doctorService->doctorList();
        return view('doctor.index',compact('doctors'));
    }

  
    public function create()
    {
        $this->authorize('create',Doctor::class);
        $departments = $this->departmentService->getDropdownList();
        return view('doctor.create',compact('departments'));
    }

 
    public function store(DoctorRequest $request)
    {
        $this->authorize('create',Doctor::class);
        $validatedData = $request->validated();
        $validatedData['role_id']=$request->role_id;
        if ($request->hasFile('image')) {
            $validatedData['image'] = $this->ImageUpload($request, 'image', 'doctor/', 'doctor_');
            
        }
  
        $doctor=$this->doctorService->createOrUpdate($validatedData);
        if($doctor){
            $user=$this->userService->createUser($validatedData);
            $doctor=$this->doctorService->userIdUpdate($doctor->id,$user->id);
            
        }
        Session::flash('message','Information Added successfully!!!!');
        return redirect()->route('doctors.index');
    }


    public function show($id)
    {
        $doctor = $this->doctorService->getById($id); 
        $this->authorize('view',$doctor);
     
        return view('doctor.show', compact('doctor'));   
    }




    public function edit($id)
    {
        
        $doctor = $this->doctorService->getById($id);
        $this->authorize('update',$doctor);
        $departments = $this->departmentService->getDropdownList();            
        return view('doctor.edit', compact('doctor','departments'));
    }

    public function update(DoctorRequest $request,$id)
    {
        $doctor = $this->doctorService->getById($id);
        $this->authorize('update',$doctor);
        $validatedData = $request->validated();
        $validatedData['role_id']=$request->role_id;//doctor role id
        $validatedData['user_id']=$request->user_id;//doctor user id 
        $validatedData['id']=$id;//doctor id

        if ($request->hasFile('image')) {
            $validatedData['image'] = $this->ImageUpload($request, 'image', 'doctor/', 'doctor_');
            
        } 
        
        $doctor=$this->doctorService->createOrUpdate($validatedData); 
        if($doctor){
            $user=$this->userService->updateUser($doctor);      
        }
        Session::flash('message','Information updated successfully!!!!');
        return redirect()->route('doctors.index');
    }

 
    public function destroy($id)
    {
        
        $doctor = $this->doctorService->getById($id);
        $this->authorize('delete',$doctor);
        $doctor = $this->doctorService->delete($id);
       
        if ($doctor) {
            return response()->json([
                'success' => 'Record has been deleted successfully!'
            ]);
            }
       
    }

    function liveSearchDoctor(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      
      if($query != '')
      {
        
        $data =Doctor::
            where('name', 'like', '%'.$query.'%')
            ->orWhere('mobile', 'like', '%'.$query.'%')
            ->orWhere('email', 'like', '%'.$query.'%')
            ->orderBy('id', 'desc')
            ->with('department')
            ->paginate(10);
      
         
      }
      else
      {
        $data =Doctor::with('department')->paginate(10);
      }
  
      return json_encode($data);
     }
    }
}
