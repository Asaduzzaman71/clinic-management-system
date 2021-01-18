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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $facilities = $this->facilityService->facilityList();
        return view('facility.index',compact('facilities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     * 
     */
    public function create()
    {
        $departments = $this->departmentService->getDropdownList();
        return view('facility.create',compact('departments'));
    }
   

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FacilityRequest $request)
    {
        $validatedData = $request->validated(); 
        $this->facilityService->createOrUpdate($validatedData);
        Session::flash('message','Information stored successfully!!!!');
        return redirect()->route('facilities.index'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $facility = $this->facilityService->getById($id);
        $departments = $this->departmentService->getDropdownList();            
        return view('facility.edit', compact('facility','departments'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function update(FacilityRequest $request, $id)
    {
        
        $validatedData = $request->validated(); 
        $validatedData['id']=$id;
        
        $this->facilityService->createOrUpdate($validatedData); 
        Session::flash('message','Information updated successfully!!!!');
        return redirect()->route('facilities.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Facility  $facility
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $facility = $this->facilityService->delete($id);
       
        if ($facility) {
            Session::flash('message','Information deleted successfully!!!!');
            }
        return redirect()->route('facilities.index');
    
    }
}
