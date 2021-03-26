<?php

namespace App\Http\Controllers;
use App\Models\Test;
use Illuminate\Http\Request;
use App\Services\TestService;
use App\Http\Requests\TestRequest;
use Illuminate\Support\Facades\Session;

class TestController extends Controller
{

    protected $testService;
    public function __construct()
    {
        $this->middleware('auth');
        $this->testService = new TestService();
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('viewAny', Test::class); 
        $tests = $this->testService->testList();
        return view('test.index',compact('tests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('create', Test::class); 
        return view('test.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TestRequest $request)
    {
        $this->authorize('store', Test::class); 
        $validatedData = $request->validated(); 
        $this->testService->createOrUpdate($validatedData);
        Session::flash('message','Information stored successfully!!!!');
        return redirect()->route('tests.index'); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
       
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        $test = $this->testService->getById($id);  
        $this->authorize('update',$test);           
        return view('test.edit', compact('test'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TestRequest $request, $id)
    {
        $test = $this->testService->getById($id);  
        $this->authorize('update',$test);
        $validatedData = $request->validated(); 
        $validatedData['id']=$id;
        $this->testService->createOrUpdate($validatedData); 
        Session::flash('message','Information updated successfully!!!!');
        return redirect()->route('tests.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $test = $this->testService->getById($id);  
        $this->authorize('delete',$test);
        $test = $this->testService->delete($id);
       
        if ($test) {
            Session::flash('message','Information deleted successfully!!!!');
            }
        return redirect()->route('tests.index');
    }
}
