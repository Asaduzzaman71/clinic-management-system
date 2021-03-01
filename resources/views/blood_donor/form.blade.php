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
  
          {!! Form::label('mobile','Mobile', ['class' => 'form-control-label']);!!}
          {!! Form::text("mobile",null, ["class"=>"form-control form-control-label"]) !!}
          <span class="validation-error">{{ $errors->first("mobile") }}</span>
          
        </div>
      </div><!-- col-12 -->
   
  </div><!-- col-12 -->
<div class="row">
  
    <div class="col-lg-12">
      <div class="form-group">
        {!! Form::label('address', 'Address', ['class' => 'form-control-label']);!!}
        {!! Form::textarea('address', null, ['class' => 'ckeditor form-control']) !!}
        <span class="validation-error">{{ $errors->first("address") }}</span>
      </div>
    </div><!-- col-12 -->
  
</div>




<div class="row">
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
  
          {!! Form::label('age','Age', ['class' => 'form-control-label']);!!}
          {!! Form::number("age",null, ["class"=>"form-control form-control-label",'min'=>'0']) !!}
          <span class="validation-error">{{ $errors->first("age") }}</span>
          
        </div>
    </div><!-- col-12 -->
  
    <div class="col-lg-4">
        <div class="form-group">
            {!! Form::label('blood_id', 'Choose a status', ['class' => 'form-control-label']);!!}
            {!! Form::select('blood_id', $bloods ,  null , ['placeholder' => 'Choose Blood Group',"class"=>"form-control"]) !!}
         </div>
    </div>

</div>


<div class="row">
    <div class="col-lg-12">
        <div class="form-group">
  
          {!! Form::label('last_donation','Last Donation Date', ['class' => 'form-control-label']);!!}
          {!! Form::date("last_donation",NULL, ["class"=>"form-control form-control-label",'id'=>'datetimepicker']) !!}
          <span class="validation-error">{{ $errors->first("last_donation") }}</span>
          
        </div>
      </div><!-- col-12 -->

</div>




  
  
   

  
