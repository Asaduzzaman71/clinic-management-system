
  


<div class="row">
     <div class="col-md-6 col-sm-6 ">
                                        
          {!! Form::label('Patient Id','Patient Id', ['class' => 'form-control-label']);!!}
          {!! Form::number("patient_id",null, ["class"=>"form-control "]) !!}
          <span class="validation-error">{{ $errors->first("patient_id") }}</span>
     </div>
     <div class="col-md-6 col-sm-6">
          {!! Form::label('date','Date:', ['class' => 'form-control-label']);!!}
          {!! Form::date("date",NULL, ["class"=>"form-control","placeholder"=>"Your Email","id"=>"date"]) !!}
          <span class="validation-error">{{ $errors->first("date") }}</span>
     </div>
     
    
</div>  
<div class="row">
     <div class="col-md-6 col-sm-6">
          {!! Form::label('department_id', 'Select Department', ['class' => 'form-control-label']);!!}
          {!! Form::select('department_id', $departments ,  null , ['placeholder' => 'Select Department',"class"=>"form-control department",'id'=>'department']) !!}
          <span class="validation-error">{{ $errors->first("department_id") }}</span>
     </div>
     <div class="col-md-6 col-sm-6">
          <label for="select">Select Doctor</label>
               <select name="doctor_id" id="doctor" class="form-control doctor" >
                    <option value="0" disabled="true" selected="true">Doctor Name</option>
               </select>
               <span class="validation-error">{{ $errors->first("doctor_id") }}</span>
     </div>
    
</div>
<div class="row">
     <div class="col-md-12 col-sm-12">
          {!! Form::label('message', 'Message', ['class' => 'form-control-label']);!!}
          {!! Form::textarea('message', null, ['class' => 'form-control','id'=>'message','rows'=>5]) !!}
          <span class="validation-error">{{ $errors->first("messgae") }}</span>
          {!! Form::hidden('status',0) !!}         
        
     </div>
</div>




