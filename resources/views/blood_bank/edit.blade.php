@extends('layout.master')
@section('css')

@endsection
@section('content')
<div class="br-pquantitybody">
    <br>
    <div class="br-section-wrapper">
        <div class="row">
            <div class="col-lg-3">
                <h5>Edit Blood Bank Information</h5>
            </div>
            <div class="col-lg-3 offset-lg-6">
                <a href="{{route('bloodBanks.index')}}" class="btn btn-primary">Blood Bank </a>
            </div>
        </div>
        <hr>
      <br>
      
      <div class="form-layout form-layout-1">
        {!! Form::model($bloodBank, ['route' => ['bloodBanks.update', $bloodBank->id], 'method' => 'put']) !!}
      <div class="row">
       
        <div class="col-lg-8">
            <div class="form-group">
                {!! Form::label('blood_id', 'Blood Group', ['class' => 'form-control-label']);!!}
                {!! Form::select('blood_id', $bloods ,  null , ['placeholder' => 'Choose Blood Group',"class"=>"form-control",'disabled' => true]) !!}
             </div>
        </div>
    
    </div>
    <div class="row">
       
        <div class="col-lg-8">
            <div class="form-group">
      
              {!! Form::label('quantity','Quantity', ['class' => 'form-control-label']);!!}
              {!! Form::number("quantity",null, ["class"=>"form-control form-control-label",'min'=>'0']) !!}
              <span class="validation-error">{{ $errors->first("quantity") }}</span>
              
            </div>
        </div><!-- col-12 -->
    </div>
    {!! Form::hidden('blood_id',$bloodBank->blood_id) !!}
            
            <button class="btn btn-info">Update </button>
        {!! Form::close() !!}
          
        </div><!-- form-layout-footer -->
       
      </div><!-- form-layout -->
      
   
</div>
@endsection
    @section('js')
  

    @endsection
