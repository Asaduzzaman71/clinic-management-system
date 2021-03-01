<?php

namespace App\Http\Controllers;

use App\Models\BloodBank;
use App\Services\BloodService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class BloodBankController extends Controller
{
 
    protected $bloodService;

    
    public function __construct()
    {
        $this->middleware('auth');
        $this->bloodService = new bloodService();
   
    }

    public function index()
    {
        $bloodBanks=BloodBank::paginate(10);
        return view('blood_bank.index',compact('bloodBanks'));
    }

    public function create()
    {
        //
    }


    public function store()
    {
        
    }


    public function show(BloodBank $bloodBank)
    {
        //
    }


    public function edit($bloodBank)
    {
        $bloodBank=BloodBank::findOrFail($bloodBank);
        $bloods = $this->bloodService->getDropdownList();
        return view('blood_bank.edit',compact('bloods','bloodBank'));
    }

   
    public function update(Request $request,$bloodBank)
    {
      
        $bloodBank = BloodBank::whereId($bloodBank)->first();
        $bloodBank->blood_id=$request->blood_id;
        $bloodBank->quantity=$request->quantity;
        $bloodBank->updated_by=Auth()->user()->id;
        $bloodBank->save();
        Session::flash('message','Information updated successfully!!!!');
        return redirect()->route('bloodBanks.index');

    }


    public function destroy(BloodBank $bloodBank)
    {
        //
    }
}
