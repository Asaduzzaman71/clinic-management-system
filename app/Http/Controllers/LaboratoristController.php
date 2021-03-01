<?php

namespace App\Http\Controllers;
use App\Http\Requests\LaboratoristRequest;
use App\Services\LaboratoristService;
use App\Services\UserService;
use App\Models\Laboratorist;
use App\Traits\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;


class LaboratoristController extends Controller
{

    use FileUpload;
    protected $laboratoristService;
    protected $userService;
  
    public function __construct()
    {
        $this->middleware('auth');
        $this->laboratoristService = new LaboratoristService();
        $this->userService = new UserService();
   
    }

    public function index()
    {
        $this->authorize('viewAny',Laboratorist::class);
        $laboratorists = $this->laboratoristService->laboratoristList();
        return view('laboratorist.index',compact('laboratorists'));
    }

  
    public function create()
    {  
        $this->authorize('create',Laboratorist::class);
        return view('laboratorist.create');
    }

  
    public function store(LaboratoristRequest $request)
    {
        $this->authorize('create',Doctor::class);
        $validatedData = $request->validated();
        $validatedData['role_id']=$request->role_id;
        if ($request->hasFile('image')) {
            $validatedData['image'] = $this->ImageUpload($request, 'image', 'laboratorist/', 'laboratorist_');
        }

        $laboratorist=$this->laboratoristService->createOrUpdate($validatedData);
        if($laboratorist){
            $user=$this->userService->createUser($validatedData);
            $laboratorist=$this->laboratoristService->userIdUpdate($laboratorist->id,$user->id);
            
        }
        Session::flash('message','Information Added successfully!!!!');
        return redirect()->route('laboratorists.index');
    }

    public function show($id)
    {
        $laboratorist = $this->laboratoristService->getById($id);
        $this->authorize('view',$laboratorist); 
        return view('laboratorist.show', compact('laboratorist'));    
    }

  
    public function edit($id)
    {
        $laboratorist = $this->laboratoristService->getById($id);
        $this->authorize('update',$laboratorist);           
        return view('laboratorist.edit', compact('laboratorist'));
    }

  
    public function update(LaboratoristRequest $request, $id)
    {
        $laboratorist = $this->laboratoristService->getById($id);
        $this->authorize('update',$laboratorist);   
        $validatedData = $request->validated();
        $validatedData['user_id']=$request->user_id;//laboratorist user id 
        $validatedData['id']=$id;//laboratorist id
        
        if ($request->hasFile('image')) {
            $validatedData['image'] = $this->ImageUpload($request, 'image', 'laboratorist/', 'laboratorist_');
        }
        
        $laboratorist=$this->laboratoristService->createOrUpdate($validatedData); 
        if($laboratorist){
            $user=$this->userService->updateUser($laboratorist);      
        }
        Session::flash('message','Information updated successfully!!!!');
        return redirect()->route('laboratorists.index');
    }


    public function destroy($id)
    {
        $laboratorist = $this->laboratoristService->getById($id);
        $this->authorize('delete',$laboratorist);   
        $laboratorist = $this->laboratoristService->delete($id);
      
       
        if ($laboratorist) {
            return response()->json([
                'success' => 'Record has been deleted successfully!'
            ]);
            }
    }

    function liveSearchLaboratorist(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      
      if($query != '')
      {
        
        $data =Laboratorist::
            where('name', 'like', '%'.$query.'%')
            ->orWhere('mobile', 'like', '%'.$query.'%')
            ->orWhere('email', 'like', '%'.$query.'%')
            ->orderBy('id', 'desc')
            ->paginate(10);
      
         
      }
      else
      {
        $data =Laboratorist::paginate(10);
      }
  
      return json_encode($data);
     }
    }
    
    
}
