<div class="row">

    <div class="col-lg-4">
      <div class="form-group">

        {!! Form::label('name','Name', ['class' => 'form-control-label']);!!}
        {!! Form::text("name",null, ["class"=>"form-control form-control-label"]) !!}
        <span class="validation-error">{{ $errors->first("name") }}</span>
        
      </div>
    </div><!-- col-12 -->

    <div class="col-lg-4">
        <div class="form-group">
  
          {!! Form::label('email','Email', ['class' => 'form-control-label']);!!}
          {!! Form::email("email",null, ["class"=>"form-control form-control-label"]) !!}
          <span class="validation-error">{{ $errors->first("email") }}</span>
          
        </div>
    </div><!-- col-12 -->
    <div class="col-lg-4">
      <div class="form-group">

        {!! Form::label('password','Password', ['class' => 'form-control-label']);!!}
        {{ Form::password('password', array('id' => 'password', "class" => "form-control", "autocomplete" => "off")) }}
        <span class="validation-error">{{ $errors->first("password") }}</span>
        
      </div>
  </div><!-- col-12 -->
   
   
</div>


<div class="row">

    <div class="col-lg-4">
        <div class="form-group">
  
          {!! Form::label('birthdate','Birthdate', ['class' => 'form-control-label']);!!}
          {!! Form::date("birthdate",NULL, ["class"=>"form-control form-control-label",'id'=>'your_datepicker_id']) !!}
          <span class="validation-error">{{ $errors->first("birthdate") }}</span>
          
        </div>
      </div><!-- col-12 -->

      <div class="col-lg-4">
        <div class="form-group">
  
          {!! Form::label('age','Age', ['class' => 'form-control-label']);!!}
          {!! Form::number("age",null, ["class"=>"form-control form-control-label",'min'=>'0']) !!}
          <span class="validation-error">{{ $errors->first("age") }}</span>
          
        </div>
      </div><!-- col-12 -->
  


  <div class="col-lg-4">
      <div class="form-group">

        {!! Form::label('mobile','Mobile', ['class' => 'form-control-label']);!!}
        {!! Form::text("mobile",null, ["class"=>"form-control form-control-label"]) !!}
        <span class="validation-error">{{ $errors->first("mobile") }}</span>
        
      </div>
    </div><!-- col-12 -->
   
</div>


<div class="row">
  <div class="col-lg-4">
    <div class="form-group">
      {!! Form::label('blood_id', 'Choose a status', ['class' => 'form-control-label']);!!}
      {!! Form::select('blood_id', $bloods ,  null , ['placeholder' => 'Choose Blood Group',"class"=>"form-control"]) !!}
    </div>
</div>

<div class="col-lg-4">
  <div class="form-group">
    {!! Form::label('gender', 'Gender', ['class' => 'form-control-label']);!!}
    {!!Form::select('gender', ['Male' => 'Male', 'Female' => 'Female'],NULL,
        ['placeholder' => 'Choose  Gender',"class"=>"form-control form-control-label"]);
    !!}
  </div>
</div>

    <div class="col-lg-4">
        <div class="form-group">
          {!! Form::label('status', 'Choose a status', ['class' => 'form-control-label']);!!}
          {!!Form::select('status', ['1' => 'Active', '0' => 'Inactive'],NULL,
              ["class"=>"form-control form-control-label"]);
          !!}
        </div>
      </div>

      

 
  
</div><!-- row -->
<div class="row">
  
  <div class="col-lg-8">
    <div class="form-group">
      {!! Form::label('address', 'Address', ['class' => 'form-control-label']);!!}
      {!! Form::textarea('address', null, ['class' => 'ckeditor form-control']) !!}
      <span class="validation-error">{{ $errors->first("address") }}</span>
    </div>
  </div><!-- col-12 -->

<div class="col-lg-4">
<div class="form-group">
  {!! Form::label('image', 'Image', ['class' => 'form-control-label']);!!}
  {!! Form::file("image", null, ["class"=>"form-control form-control-label"]) !!}
  <span class="validation-error">{{ $errors->first("image") }}</span>
</div>
</div>


</div>

{!! Form::hidden('role_id',3) !!}

  
  
   

  
