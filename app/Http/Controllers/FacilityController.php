<?php

namespace App\Http\Controllers;
use App\Models\Facility;
use Illuminate\Http\Request;
use App\Services\FacilityService;
use App\Services\DepartmentService;
use App\Http\Requests\FacilityRequest;
use Illuminate\Support\Facades\Session;

class FacilityController extends Controller
{

    protected $departmentService;
    public function __construct()
    {
        $this->middleware('auth');
        $this->facilityService = new FacilityService();
        $this->departmentService = new DepartmentService();
    }
  
    public function index()
    {
        $this->authorize('viewAny',Facility::class);
        $facilities = $this->facilityService->facilityList();
        return view('facility.index',compact('facilities'));
    }

 
    public function create()
    {
        $this->authorize('create',Facility::class);
        $departments = $this->departmentService->getDropdownList();
        return view('facility.create',compact('departments'));
    }
   

    
    public function store(FacilityRequest $request)
    {
        $this->authorize('create',Facility::class);
        $validatedData = $request->validated(); 
        $this->facilityService->createOrUpdate($validatedData);
        Session::flash('message','Information stored successfully!!!!');
        return redirect()->route('facilities.index'); 
    }

   
    public function show()
    {
        
        
    }

    public function edit($id)
    {
        $facility = $this->facilityService->getById($id);
        $this->authorize('update',$facility);
        $departments = $this->departmentService->getDropdownList();            
        return view('facility.edit', compact('facility','departments'));
    }

   
    public function update(FacilityRequest $request, $id)
    {
        $facility = $this->facilityService->getById($id);
        $this->authorize('update',$facility);
        
        $validatedData = $request->validated(); 
        $validatedData['id']=$id;
        
        $this->facilityService->createOrUpdate($validatedData); 
        Session::flash('message','Information updated successfully!!!!');
        return redirect()->route('facilities.index');
    }

   
    public function destroy($id)
    {
        $facility = $this->facilityService->getById($id);
        $this->authorize('delete',$facility);
        $facility = $this->facilityService->delete($id);
       
        if ($facility) {
            Session::flash('message','Information deleted successfully!!!!');
            }
        return redirect()->route('facilities.index');
    
    }
}
