<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\BloodDonor;
use App\Models\BloodBank;
use App\Services\BloodDonorService;
use App\Http\Requests\BloodDonorRequest;
use App\Services\BloodService;
use Illuminate\Support\Facades\Session;

class BloodDonorController extends Controller
{

    protected $bloodService;
    protected $bloodDonorService;
    
    public function __construct()
    {
        $this->middleware('auth');
        $this->bloodDonorService = new bloodDonorService();
        $this->bloodService = new bloodService();
   
    }

    public function index()
    {
       
        $bloodDonors = $this->bloodDonorService->bloodDonorList();
        return view('blood_donor.index',compact('bloodDonors'));
    }

    public function create()
    {
        $bloods = $this->bloodService->getDropdownList();
        return view('blood_donor.create',compact('bloods'));
    }


    public function store(BloodDonorRequest $request)
    {
        $validatedData = $request->validated(); 
        $this->bloodDonorService->createOrUpdate($validatedData);
        $bloodQunatityByGroup = BloodDonor::groupBy('blood_id')
                    ->selectRaw('count(*) as total, blood_id')
                    ->get();
        for($i=0;$i<count($bloodQunatityByGroup);$i++){
            $checkBloodGroup=BloodBank::Where('blood_id',$bloodQunatityByGroup[$i]->blood_id)->first();
         
            if($checkBloodGroup==NULL){
                $bloodBank=new BloodBank();
                $bloodBank->blood_id=$bloodQunatityByGroup[$i]->blood_id;
                $bloodBank->quantity=$bloodQunatityByGroup[$i]->total;
                $bloodBank->save();

            }
            else{
                $checkBloodGroup->blood_group=$bloodQunatityByGroup[$i]->blood_id;
                $checkBloodGroup->quantity=$bloodQunatityByGroup[$i]->total;
                $checkBloodGroup->updated_by=Auth()->user()->id;
                $checkBloodGroup->save();

            }
        }
        
       
        Session::flash('message','Information stored successfully!!!!');
        return redirect()->route('bloodDonors.index'); 
    }

    public function show($bloodDonor)
    {
        $bloodDonor = $this->bloodDonorService->getById($bloodDonor); 
        return view('blood_donor.show', compact('bloodDonor'));    
    }

    public function edit($bloodDonor)
    {   
        $bloodDonor = $this->bloodDonorService->getById($bloodDonor);
        $bloods = $this->bloodService->getDropdownList();
        return view('blood_donor.edit',compact('bloods','bloodDonor'));
       
    }

  
    public function update(BloodDonorRequest $request,$bloodDonor)
    {
        $validatedData = $request->validated(); 
        $validatedData['id']=$bloodDonor;  
        $this->bloodDonorService->createOrUpdate($validatedData); 
        Session::flash('message','Information updated successfully!!!!');
        return redirect()->route('bloods.index');
    }

   
    public function destroy($bloodDonor)
    {
        $bloodDonor = $this->bloodDonorService->delete($bloodDonor);
        if ($bloodDonor) {
            Session::flash('message','Information deleted successfully!!!!');
            }
        return redirect()->route('bloodDonors.index');
    
    }
}
