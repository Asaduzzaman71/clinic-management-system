<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\Models\Department;
use App\Http\Requests\DepartmentRequest;
use App\Services\DepartmentService;
use Illuminate\Http\Request;
use App\Traits\FileUpload;
use Illuminate\Support\Facades\Session;

class DepartmentController extends Controller
{


    use FileUpload;
    protected $departmentService;
    public function __construct()
    {
        $this->middleware('auth');
        $this->departmentService = new DepartmentService();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny',Department::class);
        $departments = $this->departmentService->departmentList();
        return view('department.index',compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create',Department::class);
        return view('department.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(DepartmentRequest $request)
    {
        $this->authorize('create',Department::class);
        $validatedData = $request->validated(); 
      
        if ($request->hasFile('icon')) {
            $validatedData['icon'] = $this->ImageUpload($request, 'icon', 'department/', 'department_');
            
        } 
        $this->departmentService->createOrUpdate($validatedData); 
        Session::flash('message','Information updated successfully!!!!');
        return redirect()->route('departments.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(Department $department)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $department = $this->departmentService->getById($id);
        $this->authorize('update',$department);
        $department = $this->departmentService->getById($id);            
        return view('department.edit', compact('department'));

        
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(DepartmentRequest $request, $id)
    {
        $department = $this->departmentService->getById($id);
        $this->authorize('update',$department);
        $validatedData = $request->validated(); 
        $validatedData['id']=$id;
        
      
        if ($request->hasFile('icon')) {
            $validatedData['icon'] = $this->ImageUpload($request, 'icon', 'department/', 'department_');
            
        } 
        
        $this->departmentService->createOrUpdate($validatedData); 
        Session::flash('message','Information updated successfully!!!!');
        return redirect()->route('departments.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $department = $this->departmentService->getById($id);
        $this->authorize('delete',$department);
        $department = $this->departmentService->delete($id);
       
        if ($department) {
            Session::flash('message','Information deleted successfully!!!!');
            }
        return redirect()->route('departments.index');
    }
}