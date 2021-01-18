<div class="row">

    <div class="col-lg-12">
      <div class="form-group">

        {!! Form::label('title','Title', ['class' => 'form-control-label']);!!}
        {!! Form::text("title",null, ["class"=>"form-control form-control-label"]) !!}
        <span class="validation-error">{{ $errors->first("title") }}</span>
        
      </div>
    </div><!-- col-12 -->
</div>
<div class="row">
    <div class="col-lg-12">
      <div class="form-group">
        {!! Form::label('description', 'Description', ['class' => 'form-control-label']);!!}
        {!! Form::textarea('description', null, ['class' => 'ckeditor form-control']) !!}
        <span class="validation-error">{{ $errors->first("description") }}</span>
      </div>
    </div><!-- col-12 -->
   
</div><!-- row -->

  <div class="row">

    <div class="col-lg-6">
        <div class="form-group">
          {!! Form::label('department_id', 'Choose a status', ['class' => 'form-control-label']);!!}
          {!! Form::select('department_id', $departments ,  null , ['placeholder' => 'Select Department',"class"=>"form-control"]) !!}
        </div>
      </div>

      <div class="col-lg-6">
        <div class="form-group">
          {!! Form::label('status', 'Choose a status', ['class' => 'form-control-label']);!!}
          {!!Form::select('status', ['1' => 'Active', '0' => 'Inactive'],NULL,
              ["class"=>"form-control form-control-label"]);
          !!}
        </div>
      </div>
  </div>
  
   

  
