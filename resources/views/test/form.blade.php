<div class="row">

    <div class="col-lg-6">
      <div class="form-group">

        {!! Form::label('name','Test name', ['class' => 'form-control-label']);!!}
        {!! Form::text("name",null, ["class"=>"form-control form-control-label"]) !!}
        <span class="validation-error">{{ $errors->first("name") }}</span>
        
      </div>
    </div><!-- col-12 -->
    <div class="col-lg-6">
        <div class="form-group">
          {!! Form::label('status', 'Choose a status', ['class' => 'form-control-label']);!!}
          {!!Form::select('status', ['1' => 'Active', '0' => 'Inactive'],NULL,
              ["class"=>"form-control form-control-label"]);
          !!}
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
      <div class="form-group">
        {!! Form::label('description', 'Short Description', ['class' => 'form-control-label']);!!}
        {!! Form::textarea('description', null, ['class' => 'ckeditor form-control']) !!}
        <span class="validation-error">{{ $errors->first("description") }}</span>
      </div>
    </div><!-- col-12 -->
   
</div><!-- row -->

  
  
   

  
