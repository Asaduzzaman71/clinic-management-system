
@extends('layout.master')
@section('content')

<div class="br-pagebody">

    <br>
    <div class="br-section-wrapper">
      <div class="row">
        <div class="col-lg-3">
          <h2 style="text-align: center">Manage profile</h2>
        </div>
       
      </div>
    <hr>
    
      
      
      <h6 class="br-section-label">Edit Profile</h6>
      <br>
      

      <div class="form-layout form-layout-1">
        {!! Form::open(['url' => 'admin/'.$admin->id.'','method'=>'PUT','files'=>true]) !!}
       
        @include('admin.form')
       
          <button class="btn btn-info">Update Profile</button>
          {!! Form::close() !!}
          
        </div><!-- form-layout-footer -->
       
      </div><!-- form-layout -->
      





   
</div>
@endsection
