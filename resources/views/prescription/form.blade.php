
  
 
<div class="row">
    <div class="col-4">
         {!! Form::label('patient_id', 'Select patient', ['class' => 'form-control-label']);!!}
         {!! Form::select('patient_id', $appointments ,  null , ['placeholder' => 'Select patient',"class"=>"form-control patient",'id'=>'patient']) !!}
         <span class="validation-error">{{ $errors->first("patient_id") }}</span>
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
<br>
<div class="row">
    <div class="col-4">
         {!! Form::label('case_history', 'Case history', ['class' => 'form-control-label']);!!}
         {!! Form::textarea('case_history', null, ['class' => 'ckeditor form-control','id'=>'case_history','rows'=>5]) !!}
         <span class="validation-error">{{ $errors->first("case_history") }}</span>
             
       
    </div>
    <div class="col-4">
        {!! Form::label('medication', 'Medication', ['class' => 'form-control-label']);!!}
        {!! Form::textarea('medication', null, ['class' => 'ckeditor form-control','id'=>'case_history','rows'=>5]) !!}
        <span class="validation-error">{{ $errors->first("medication") }}</span>
             
      
   </div>
   <div class="col-4">
    {!! Form::label('note', 'Note', ['class' => 'form-control-label']);!!}
    {!! Form::textarea('note', null, ['class' => 'ckeditor form-control','id'=>'case_history','rows'=>5]) !!}
    <span class="validation-error">{{ $errors->first("note") }}</span>  
</div>
</div>


{!! Form::hidden('doctor_id',$doctor->id) !!}




