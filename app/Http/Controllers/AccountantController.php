<?php

namespace App\Http\Controllers;
use App\Http\Requests\AccountantRequest;
use App\Services\AccountantService;
use App\Services\UserService;
use App\Models\Accountant;
use App\Traits\FileUpload;
use Illuminate\Support\Facades\Session;

class AccountantController extends Controller
{

    use FileUpload;
    protected $accountantService;
    protected $userService;
  
    public function __construct()
    {
        $this->middleware('auth');
        $this->accountantService = new AccountantService();
        $this->userService = new UserService();
   
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $accountants = $this->accountantService->accountantList();
        return view('accountant.index',compact('accountants'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('accountant.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(AccountantRequest $request)
    {
        $validatedData = $request->validated();
        $validatedData['role_id']=$request->role_id;
        if ($request->hasFile('image')) {
            $validatedData['image'] = $this->ImageUpload($request, 'image', 'accountant/', 'accountant_');
        }

        $accountant=$this->accountantService->createOrUpdate($validatedData);
        if($accountant){
            $user=$this->userService->createUser($validatedData);
            $accountant=$this->accountantService->userIdUpdate($accountant->id,$user->id);
            
        }
        Session::flash('message','Information Added successfully!!!!');
        return redirect()->route('accountants.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Accountant  $accountant
     * @return \Illuminate\Http\Response
     */
    public function show(Accountant $accountant)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Accountant  $accountant
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $accountant = $this->accountantService->getById($id);          
        return view('accountant.edit', compact('accountant'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Accountant  $accountant
     * @return \Illuminate\Http\Response
     */
    public function update(AccountantRequest $request, $id)
    {
        $validatedData = $request->validated();
        $validatedData['user_id']=$request->user_id;//accountant user id 
        $validatedData['id']=$id;//accountant id
        
        if ($request->hasFile('image')) {
            $validatedData['image'] = $this->ImageUpload($request, 'image', 'accountant/', 'accountant_');
        }
        
        $accountant=$this->accountantService->createOrUpdate($validatedData); 
        if($accountant){
            $user=$this->userService->updateUser($accountant);      
        }
        Session::flash('message','Information updated successfully!!!!');
        return redirect()->route('accountants.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Accountant  $accountant
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $accountant = $this->accountantService->delete($id);
       
        if ($accountant) {
            Session::flash('message','Information deleted successfully!!!!');
            }
        return redirect()->route('accountants.index');
    }
    
}
