<div class="row">
    {!! Form::hidden('id',$admin['id']) !!}  
    {!! Form::hidden('role_id',$admin['role_id']) !!}
    {!! Form::hidden('password',$admin['password']) !!} 
    {!! Form::hidden('status',$admin['status']) !!}
     
    <div class="col-lg-6">
      <div class="form-group">

        {!! Form::label('name','Name', ['class' => 'form-control-label']);!!}
        {!! Form::text("name",old('name',$admin->name), ["class"=>"form-control form-control-label"]) !!}
        <span class="validation-error">{{ $errors->first("name") }}</span>
        
      </div>
    </div><!-- col-6 -->
    <div class="col-lg-6">
      <div class="form-group">
        {!! Form::label('email', 'Email', ['class' => 'form-control-label']);!!}
        {!! Form::text("email", old('email',$admin->email), ["class"=>"form-control form-control-label"]) !!}
        <span class="validation-error">{{ $errors->first("email") }}</span>
      </div>
    </div><!-- col-6 -->
   
  </div><!-- row -->

  <div class="row">
    <div class="col-lg-6">
      <div class="form-group">
        {!! Form::label('phone', 'Phone', ['class' => 'form-control-label']);!!}
        {!! Form::text("phone", old('phone',$admin->phone), ["class"=>"form-control form-control-label"]) !!}
        <span class="validation-error">{{ $errors->first("phone") }}</span>
      </div>
    </div><!-- col-6 -->
    <div class="col-lg-6">
      <div class="form-group">
        {!! Form::label('address', 'Address', ['class' => 'form-control-label']);!!}
        {!! Form::text("address", old('address',$admin->address), ["class"=>"form-control form-control-label"]) !!}
        <span class="validation-error">{{ $errors->first("address") }}</span>
      </div>
    </div><!-- col-6 -->
   
  </div><!-- row -->

  
    <div class="row">
      <div class="col-lg-6">
        <div class="form-group">
          {!! Form::label('image', 'Image', ['class' => 'form-control-label']);!!}
          {!! Form::file("image", null, ["class"=>"form-control form-control-label"]) !!}
          <span class="validation-error">{{ $errors->first("image") }}</span>
        </div>
      </div>
    
    </div>
