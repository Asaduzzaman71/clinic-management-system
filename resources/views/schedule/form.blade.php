
         
 <div class="row">
  
           
  <div class="col-lg-6">
      <div class="form-group">
        <div class="form-group">
          {!! Form::label('department_id', 'Select department', ['class' => 'form-control-label']);!!}
          {!! Form::select('department_id', $departments ,  null , ['placeholder' => 'Select department',"class"=>"form-control department",'id'=>'department']) !!}
        </div>
         
          <span class="validation-error">{{ $errors->first("department_id") }}</span>
      </div>
  </div>

  <div class="col-lg-6">
    <div class="form-group">
    <label for="title">Select Doctor:</label>
        <select name="doctor_id" id="doctor" class="form-control doctor" >
          <option value="0" disabled="true" selected="true">Doctor Name</option>
        </select>
        <span class="validation-error">{{ $errors->first("doctor_id") }}</span>
    </div>
  </div>
 </div>
  
 <div class="row">
 
  <div class="col-lg-6">
          <div class="form-group">
            <div class="form-group">
              {!! Form::label('day_id', 'Select a day', ['class' => 'form-control-label']);!!}
              {!! Form::select('day_id', $days ,  null , ['placeholder' => 'Select Day',"class"=>"form-control"]) !!}
            </div>
       </div>
   </div>

   <div class="col-lg-6">
    <div class="form-group">
      {!! Form::label('patient','Number of patient:', ['class' => 'form-control-label']);!!}
      {!! Form::number("total_patient",null, ["class"=>"form-control form-control-label",'min'=>'0']) !!}
      <span class="validation-error">{{ $errors->first("total_patient") }}</span>
      
    </div>
  </div>
</div>

<div class="row">


  <div class="col-lg-4">
    <div class="form-group">
      {!! Form::label('starting time','Starting Time:', ['class' => 'form-control-label']);!!}
      {!! Form::time("starting_time",NULL, ["class"=>"form-control form-control-label"]) !!}
      <span class="validation-error">{{ $errors->first("starting_time") }}</span>
  </div>
  </div>

  <div class="col-lg-4">
   <div class="form-group">
    {!! Form::label('ending time','Ending Time:', ['class' => 'form-control-label']);!!}
    {!! Form::time("ending_time",NULL, ["class"=>"form-control form-control-label"]) !!}
    <span class="validation-error">{{ $errors->first("ending_time") }}</span>
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

  
</div>






  
  
   






  
  
   

  
