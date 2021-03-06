@extends('layout.master')
@section('css')

@endsection
@section('content')
<div class="br-pagebody">
    <br>
    <div class="br-section-wrapper">
        <div class="row">
            <div class="col-lg-3">
                <h5>Edit laboratorist</h5>
            </div>
            <div class="col-lg-3 offset-lg-6">
                <a href="{{route('laboratorists.index')}}"style="margin-left: 35px"  class="btn btn-primary">All laboratorist List</a>
            </div>
        </div>
        <hr>
      <br>
      
      <div class="form-layout form-layout-1">
        {!! Form::model($laboratorist, ['route' => ['laboratorists.update', $laboratorist->id], 'method' => 'put','files'=>true]) !!}
            @include('laboratorist.form')
            {!! Form::hidden('user_id',$laboratorist->user_id) !!}
            <button class="btn btn-info">Update Information </button>
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
