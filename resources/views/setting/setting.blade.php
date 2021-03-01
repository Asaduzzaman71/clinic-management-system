@extends('layout.master')

@section('css')
  
@endsection


@section('content')
<br>
<div class="br-pagebody">

    <div class="br-section-wrapper">
        <div class="row">
            <div class="col-lg-3">
                <h5>Update Setting Information</h5>
            </div>
        </div>
        <hr>
      <br>
      
      <div class="form-layout form-layout-1">
        {!! Form::model($setting, ['route' => ['settings.update', $setting->id], 'method' => 'put','files'=>true]) !!}
        {!! Form::hidden('id',$setting->id) !!}
      <div class="row">
            <div class="col-sm-6 form-group">
                <label>App title <span class="text-danger">*</span></label>
                {!! Form::text("title",null, ["class"=>"form-control"]) !!}
                <span class="validation-error">{{ $errors->first("title") }}</span>
            </div>
            <div class="col-sm-6 form-group">
                <label>Email <span class="text-danger">*</span></label>
                {!! Form::email("email",null, ["class"=>"form-control"]) !!}
                <span class="validation-error">{{ $errors->first("email") }}</span>
            </div>
      </div>
      <div class="row">
            <div class="col-sm-12 form-group">
                <label>Address<span class="text-danger">*</span></label>
                {!! Form::text("address",null,["class"=>"form-control"]) !!}
                <span class="validation-error">{{ $errors->first("address") }}</span>
            </div>
      </div>
        <div class="row">
            <div class="col-sm-6 form-group">
                <label>contact<span class="text-danger">*</span></label>
                {!! Form::text("contact",null,["class"=>"form-control"]) !!}
                <span class="validation-error">{{ $errors->first("contact") }}</span>
            </div>

            <div class="col-sm-6 form-group">
                <label>facebook</label>
                {!! Form::text("facebook",null,["class"=>"form-control"]) !!}
                <span class="validation-error">{{ $errors->first("facebook") }}</span>
            </div>
        </div>
        <div class="row">
        <div class="col-sm-6 form-group">
            <label>twitter</label>
            {!! Form::text("twitter", null,["class"=>"form-control"]) !!}
            <span class="validation-error">{{ $errors->first("twitter") }}</span>
        </div>
        <div class="col-sm-6 form-group">
            <label>google</label>
            {!! Form::text("google",  null,["class"=>"form-control"]) !!}
            <span class="validation-error">{{ $errors->first("google") }}</span>
        </div>
        </div>
        <div class="row">
        <div class="col-sm-6 form-group">
            <label>youtube</label>
            {!! Form::text("youtube", null,["class"=>"form-control"]) !!}
            <span class="validation-error">{{ $errors->first("youtube") }}</span>
        </div>
        <div class="col-sm-6 form-group">
            <label>instagram</label>
            {!! Form::text("instagram",  null,["class"=>"form-control"]) !!}
            <span class="validation-error">{{ $errors->first("instagram") }}</span>
        </div>
        </div>
        <div class="row">
        <div class="col-sm-6 form-group">
            <label>footer text<span class="text-danger">*</span></label>
            {!! Form::text("footer_text", null,["class"=>"form-control"]) !!}
            <span class="validation-error">{{ $errors->first("footer_text") }}</span>
        </div>
        <div class="col-sm-6 form-group">
            <label>year<span class="text-danger">*</span></label>
            {!! Form::text("footer_year", null,["class"=>"form-control"]) !!}
            <span class="validation-error">{{ $errors->first("footer_year") }}</span>
        </div>
        </div>
        <div class="row">
        <div class="col-sm-4 form-group">
            <label >favicon upload</label>
            <img  id='favicon' src="{{URL::asset($setting->favicon)}}" alt="image" class='img-responsive 'style="width:60px;height:60px;"><br><br>
            {!! Form::file("favicon", null,["class"=>"form-control","onchange"=>"readURL(this);"]) !!}
            <span class="validation-error">{{ $errors->first("favicon") }}</span>
        </div>
        
        <div class="col-sm-4 form-group">
            <label >logo</label>
            <img id='logo' src="{{URL::asset($setting->logo)}}" alt="image" class='img-responsive  logo' style="width:60px;height:60px;"><br><br>
            {!! Form::file("logo", null,["class"=>"form-control logo","onchange"=>"readURL2(this);"]) !!}
            <span class="validation-error">{{ $errors->first("logo") }}</span>
        </div>
       
        <div class="col-sm-4 form-group">
            <label >Slider Images</label>
            @if($sliders!=NULL)
            <div class="row">
                @foreach ($sliders as $slider)
                
                <img  id='sliders' src="{{URL::asset($slider)}}" alt="image" class='img-responsive sliders' style="width:80px;height:60px; margin:5px;"><br><br>
                @endforeach
            </div>
            @endif
            {!! Form::file("sliders[]",["class"=>"form-control sliders",'multiple' => 'multiple']) !!}
            <span class="validation-error">{{ $errors->first("sliders[]") }}</span>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12 reset-button">
            <button type="submit" class="btn btn-success">Update Setting</button>
        </div>
    </div>
            
        {!! Form::close() !!}

    </div><!-- form-layout -->
      
   
</div>
</div>
@endsection