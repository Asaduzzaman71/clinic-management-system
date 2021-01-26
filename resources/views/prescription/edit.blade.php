@extends('layout.master')
@section('css')

@endsection
@section('content')
<br>
<div class="br-pagebody">
    
    <div class="br-section-wrapper">
        <div class="row">
            <div class="col-lg-3">
                <h5>Edit Doctor prescription Information</h5>
            </div>
            <div class="col-lg-3 offset-lg-6">
                <a href="{{route('prescriptions.index')}}" class="btn btn-primary">All prescription List</a>
            </div>
        </div>
        <hr>
      <br>
      
      <div class="form-layout form-layout-1">
        {!! Form::model($prescription, ['route' => ['prescriptions.update', $prescription->id], 'method' => 'put']) !!}
            @include('prescription.form')
            <button class="btn btn-info">Update Information </button>
        {!! Form::close() !!}
          
            
   
</div>
</div>
@endsection
@section('js')
   
<script src="//cdn.ckeditor.com/4.14.0/standard/ckeditor.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
       $('.ckeditor').ckeditor();
    });
</script>

@endsection