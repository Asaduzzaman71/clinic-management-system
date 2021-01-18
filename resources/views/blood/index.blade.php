@extends('layout.master')
@section('css')

@endsection
@section('content')

<br>
<div class="br-pagebody">
   <div class="br-section-wrapper">
       @include('include._message')
     <div class="row">
         <div class="col-lg-6">
           <h6 class="br-section-label">Blood List</h6>
         </div>

         <div class="col-lg-3 offset-lg-3">
             <a href="{{route('bloods.create')}}" class="btn btn-primary" style="margin-left: 35px">Add New blood group</a>
         </div>
     </div>

   </br>
     
   <div class="table-responsive">
    <table class="table table-bordered table-colored table-dark">
      <thead class="thead-colored thead-dark">
            <tr>
                <th>Blood Id</th>
                <th>Blood group</th>
                <th>Description </th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
      </thead>   
     <tbody>   
        @foreach($bloods as $blood)
          <tr>
              <td class="center">{{$blood->id}}</td>
              <td class="center">{{$blood->blood_group}}</td>
              <td class="center">{!! $blood->description!!}</td>
              <td class="center">
                  @if($blood->status==1)
                      <span class="badge badge-success">Active</span>
                  @else
                      <span class="label label-danger">Deactive</span>
                  @endif
                  
              </td>
              <td class="center">
                 
               
                  <a class="btn btn-info" href="{{route('bloods.edit',$blood->id)}}">
                    <i class="fas fa-edit"></i> 
                  </a>
                  
                  {!! Form::open(['method' => 'DELETE','route' => ['bloods.destroy', $blood->id],'style'=>'display:inline']) !!}
                  {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                  {!! Form::close() !!}
              </td>
          </tr>
          @endforeach
      </tbody>
    </table>  
  </div><!-- table-wrapper -->
        

  </div>
</div>
@endsection