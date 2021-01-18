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
           <h6 class="br-section-label">Facilities List</h6>
         </div>



         <div class="col-lg-3 offset-lg-3">
             <a href="{{route('facilities.create')}}" class="btn btn-primary" style="margin-left: 35px">Add New facility</a>
         </div>
     </div>

   </br>
     
   <div class="table-responsive">
    <table class="table table-bordered table-colored table-dark">
      <thead class="thead-colored thead-dark">
            <tr>
                <th>Department</th>
                <th>Facility</th>
                <th>Description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>


        </thead>   
     <tbody>   
        @foreach($facilities as $facility)
          <tr>
              <td class="center">{{$facility->department->name}}</td>
              <td class="center">{{$facility->title}}</td>
              <td class="center">{!! $facility->description!!}</td>
              <td class="center">
                  @if($facility->status==1)
                      <span class="badge badge-success">Active</span>
                  @else
                      <span class="label label-danger">Deactive</span>
                  @endif
                  
              </td>
              <td class="center">
                 
               
                  <a class="btn btn-primary" href="{{route('facilities.edit',$facility->id)}}">
                    <i class="fas fa-edit">Edit</i> 
                  </a>
                  
                  {!! Form::open(['method' => 'DELETE','route' => ['facilities.destroy', $facility->id],'style'=>'display:inline']) !!}
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