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
           <h6 class="br-section-label">Doctors List</h6>
         </div>



         <div class="col-lg-3 offset-lg-3">
             <a href="{{route('doctors.create')}}" class="btn btn-primary" style="margin-left: 35px">Add New Doctor</a>
         </div>
     </div>

   </br>
     
   <div class="table-responsive">
    <table class="table table-bordered table-colored table-dark">
      <thead class="thead-colored thead-dark">
            <tr>
                <th>Doctor Id</th>
                <th>Name</th>
                <th>Department</th>
                <th>Email</th>
                <th>mobile</th>
                <th>Image</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>


        </thead>   
     <tbody>   
        @foreach($doctors as $doctor)
          <tr>
              <td class="center">{{$doctor->id}}</td>
              <td class="center">{{$doctor->name}}</td>
              <td class="center">{{$doctor->department->name}}</td>
              <td class="center">{{$doctor->email}}</td>
              <td class="center">{{$doctor->mobile}}</td>
              <td class="center"><img src="{{URL::asset($doctor->image)}}" style="width:40px;height:40px;"/></td>            
              <td class="center">
                  @if($doctor->status==1)
                      <span class="badge badge-success">Active</span>
                  @else
                      <span class="label label-danger">Deactive</span>
                  @endif
                  
              </td>
              <td class="center">
                 
                  <a class="btn btn-primary" href="{{route('doctors.edit',$doctor->id)}}">
                    <i class="fas fa-edit">Edit</i> 
                  </a>
                  
                  {!! Form::open(['method' => 'DELETE','route' => ['doctors.destroy', $doctor->id],'style'=>'display:inline']) !!}
                  {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                  {!! Form::close() !!}
              </td>
          </tr>
          @endforeach
        </tbody>
    </table>  
    </div><!-- table-wrapper -->
    <div class="d-flex justify-content-center">
      {!! $doctors->links() !!}
  </div>

  </div>
</div>

                      
        
@endsection