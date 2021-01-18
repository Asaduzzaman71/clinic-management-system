
@extends('layout.master')
@section('css')

@endsection
@section('content')
<div class="br-pagebody">
    <br>
    <div class="br-section-wrapper">
        <div class="row">
            <div class="col-lg-3">
                <h5>New Facility</h5>
            </div>
            <div class="col-lg-3 offset-lg-6">
                <a href="{{route('facilities.index')}}" class="btn btn-primary">All facility</a>
            </div>
        </div>
        <hr>
      <br>
      
      <div class="form-layout form-layout-1">
        {!! Form::model($facility, ['route' => ['facilities.update', $facility->id], 'method' => 'put']) !!}
            @include('facility.form')
            {!! Form::hidden('id',$facility->id) !!}
            <button class="btn btn-info">Update </button>
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
