
@extends('layout.master')

@section('css')

@endsection

@section('content')
<br>

<div class="br-pagebody">

   
    <div class="br-section-wrapper">
        <div class="row">
            <div class="col-lg-3">
                <h5>New Department</h5>
            </div>
            <div class="col-lg-3 offset-lg-6">
                <a href="{{route('departments.index')}}" class="btn btn-primary">All Department</a>
            </div>
        </div>
        <hr>
      <br>
      
      <div class="form-layout form-layout-1">
        {!! Form::open(['url' => '/departments','method'=>'post','files'=>true]) !!}
       
          @include('department.form')
       
         <button class="btn btn-info">Save </button>
        {!! Form::close() !!}
          
        </div><!-- form-layout-footer -->
       
      </div><!-- form-layout -->
      
   
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
