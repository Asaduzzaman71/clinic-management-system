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
           <h6 class="br-section-label">Departments List</h6>
         </div>



         <div class="col-lg-3 offset-lg-3">
             <a href="{{route('departments.create')}}" class="btn btn-primary" style="margin-left: 35px">Add New Department</a>
         </div>
     </div>

   </br>
     
   <div class="table-responsive">
    <table class="table table-bordered table-colored table-dark">
      <thead class="thead-colored thead-dark">
            <tr>
                <th>Department icon</th>
                <th>Department name</th>
                <th>Department description</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>


        </thead>   
     <tbody>   
        @foreach($departments as $department)
          <tr>
              <td class="center"><img src="{{URL::asset($department->icon)}}" style="width:40px;height:40px;"/></td>
              <td class="center">{{$department->name}}</td>
              <td class="center">{!! $department->description!!}</td>
              
              <td class="center">
                  @if($department->status==1)
                      <span class="badge badge-success">Active</span>
                  @else
                      <span class="label label-danger">Deactive</span>
                  @endif
                  
              </td>
              <td class="center">
                 
               
                  <a class="btn btn-primary" href="{{route('departments.edit',$department->id)}}">
                    <i class="fas fa-edit">Edit</i> 
                  </a>
                  
                  {!! Form::open(['method' => 'DELETE','route' => ['departments.destroy', $department->id],'style'=>'display:inline']) !!}
                  {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                  {!! Form::close() !!}
              </td>
          </tr>
          @endforeach
        </tbody>
    </table>  
    </div><!-- table-wrapper -->
    <div class="d-flex justify-content-center">
      {!! $departments->links() !!}
  </div>
        

  </div>
</div>

                      
        
@endsection