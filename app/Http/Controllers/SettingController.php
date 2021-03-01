<?php

namespace App\Http\Controllers;
use App\Models\Setting;
use App\Services\SettingService;
use App\Http\Requests\SettingRequest;
use Illuminate\Http\Request;
use App\Traits\FileUpload;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    use FileUpload;
    protected $settingService;
    public function __construct()
    {
        $this->middleware('auth');
        $this->settingService = new SettingService();
        
    }
    public function index()
    {
        $this->authorize('viewAny',Setting::class);
        $setting = $this->settingService->settingData();
        $sliders=unserialize($setting->sliders);
        //dd($sliders);
        return view('setting.setting',compact('setting','sliders'));
    }

 
    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(Setting $setting)
    {
        //
    }

 
    public function edit(Setting $setting)
    {
        //
    }


    public function update(SettingRequest $request,$id)
    {
        $setting = Setting::whereId($id)->first();
        $this->authorize('update',$setting);
        if ($request->hasFile('favicon')) {
           $favicon = $this->ImageUpload($request, 'favicon', 'setting/', 'favicon_');
           if (isset($request->favicon)){
               if (file_exists($setting->favicon)) 
                { 
                  
                    $filePath = public_path($setting->favicon);
                    unlink($filePath);
                }
           }
           $setting->favicon=$favicon;
        }
       
       
      
        if ($request->hasFile('logo')) {
            $logo= $this->ImageUpload($request, 'logo', 'setting/', 'logo_');
            if (isset($request->logo)){
                if(file_exists($setting->logo)) 
                { 
                    
                    $filePath = public_path($setting->logo);
                    unlink($filePath);
                }
            }
            $setting->logo=$logo;
        }
       
 
        if($request->hasfile('sliders'))
        {
            $i=0;
            foreach($request->file('sliders') as $slider)
            {
                $name = 'slider_'.$i.time().'.'.$slider->extension();
                $slider->move(public_path().'/backend/files/setting', $name);
                $data[] ='backend/files/setting/'.$name;
                $i++;
                     
            }
            if(isset($request->sliders)){
                foreach(unserialize($setting->sliders) as $slider)
                {
                   
                       $filePath = public_path($slider);
                        unlink($filePath);
                   
                    
                }
            }
            
            $setting->sliders=serialize($data);

        }
    
  
        $setting->address=$request->address;
        $setting->title=$request->title;
        $setting->contact=$request->contact;
        $setting->email=$request->email;
        $setting->facebook=$request->facebook;
        $setting->twitter=$request->twitter;
        $setting->instagram=$request->instagram;
        $setting->google=$request->google;
        $setting->youtube=$request->youtube;
        $setting->footer_text=$request->footer_text;
        $setting->footer_year=$request->footer_year;
     
        $setting->updated_by =auth()->user()->id;
        $setting->save();
       
        Session::flash('message','Information updated successfully!!!!');
        return redirect()->route('settings.index');
        
    }

  
    public function destroy(Setting $setting)
    {
        //
    }
}
