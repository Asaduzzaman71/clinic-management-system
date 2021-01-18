<?php

namespace App\Http\Controllers;
use App\Models\Blood;
use Illuminate\Http\Request;
use App\Services\BloodService;
use App\Http\Requests\BloodRequest;
use Illuminate\Support\Facades\Session;

class BloodController extends Controller
{

    protected $bloodtService;
    public function __construct()
    {
        $this->middleware('auth');
        $this->bloodService = new BloodService();
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bloods = $this->bloodService->bloodList();
        return view('blood.index',compact('bloods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    { 
        return view('blood.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BloodRequest $request)
    {
        $validatedData = $request->validated(); 
        $this->bloodService->createOrUpdate($validatedData);
        Session::flash('message','Information stored successfully!!!!');
        return redirect()->route('bloods.index'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Blood  $blood
     * @return \Illuminate\Http\Response
     */
    public function show(Blood $blood)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Blood  $blood
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $blood = $this->bloodService->getById($id);            
        return view('blood.edit', compact('blood'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Blood  $blood
     * @return \Illuminate\Http\Response
     */
    public function update(BloodRequest $request, $id)
    {
        $validatedData = $request->validated(); 
        $validatedData['id']=$id;
        
        $this->bloodService->createOrUpdate($validatedData); 
        Session::flash('message','Information updated successfully!!!!');
        return redirect()->route('bloods.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Blood  $blood
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blood = $this->bloodService->delete($id);
       
        if ($blood) {
            Session::flash('message','Information deleted successfully!!!!');
            }
        return redirect()->route('bloods.index');
    
    }
    
}
