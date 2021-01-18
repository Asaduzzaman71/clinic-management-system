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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = $this->doctorService->doctorList();
        return view('doctor.index',compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = $this->departmentService->getDropdownList();
        return view('doctor.create',compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DoctorRequest $request)
    {
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

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $doctor = $this->doctorService->getById($id);
        $departments = $this->departmentService->getDropdownList();            
        return view('doctor.edit', compact('doctor','departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function update(DoctorRequest $request,$id)
    {
        
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Doctor  $doctor
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $doctor = $this->doctorService->delete($id);
       
        if ($doctor) {
            Session::flash('message','Information deleted successfully!!!!');
            }
        return redirect()->route('doctors.index');
    }
}
