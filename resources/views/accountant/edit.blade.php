@extends('layout.master')
@section('css')

@endsection
@section('content')
<div class="br-pagebody">
    <br>
    <div class="br-section-wrapper">
        <div class="row">
            <div class="col-lg-3">
                <h5>Edit Accountant</h5>
            </div>
            <div class="col-lg-3 offset-lg-6">
                <a href="{{route('accountants.index')}}" class="btn btn-primary">All accountant List</a>
            </div>
        </div>
        <hr>
      <br>
      
      <div class="form-layout form-layout-1">
        {!! Form::model($accountant, ['route' => ['accountants.update', $accountant->id], 'method' => 'put','files'=>true]) !!}
            @include('accountant.form')
            {!! Form::hidden('user_id',$accountant->user_id) !!}
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
