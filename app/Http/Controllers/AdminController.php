<?php

namespace App\Http\Controllers;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Requests\AdminRequest;
use App\Services\AdminService;
use App\Services\UserService;
use App\Traits\FileUpload;
use Illuminate\Support\Facades\Session;


class AdminController extends Controller
{
    use FileUpload;
    protected $adminService;
    protected $userService;
    public function __construct()
    {
        $this->middleware('auth');
        $this->adminService = new AdminService();
        $this->userService = new UserService();
    }
  
    public function edit($id)
    {
        $admin = $this->adminService->getAdminByAdminId($id);
        return view('admin.edit', compact('admin'));
    }

    public function update(AdminRequest $request,$id)
    {    
        $validatedData = $request->validated();
        $admin = $this->adminService->getAdminByAdminId($id);
    
        if ($request->hasFile('image')) {
            $validatedData['image'] = $this->ImageUpload($request, 'image', 'admin/', 'admin_');
            
        } 
 
        $admin=$this->adminService->createOrUpdate($validatedData,$admin->id); 
        if($admin){
            $user=$this->userService->updateUser($admin);
        }
        Session::flash('message','Information updated successfully!!!!');
        return redirect()->route('admin.show',$admin->id);
    }
    
    public function show($id)
    {
        
        $admin = $this->adminService->getAdminByAdminId($id);
        return view('admin.show', compact('admin'));
    }

}
