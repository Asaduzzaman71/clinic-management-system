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
           <h6 class="br-section-label">prescriptions List</h6>
         </div>



         <div class="col-lg-3 offset-lg-3">
          @if(Auth()->user()->role_id==2)
             <a href="{{route('prescriptions.create')}}" class="btn btn-primary" style="margin-left: 35px">Add New prescription</a>
          @endif
            </div>
         
     </div>

   </br>
     
   <div class="table-responsive">
    <table class="table table-bordered table-colored table-dark">
      <thead class="thead-colored thead-dark">
            <tr>
                <th>Id</th>
                <th>Date</th>
                <th>Name</th>
                <th>Email</th>
                <th>Doctor</th>
                <th>Actions</th>
            </tr>


        </thead>   
     <tbody>   
        @foreach($prescriptions as $prescription)
          <tr>
              
              <td class="center">{{$prescription->id}}</td>
              <td class="center">{{$prescription->created_at}}</td> 
              <td class="center">{{$prescription->patient->name}}</td>
              <td class="center">{{$prescription->patient->email}}</td>
              <td class="center">{{$prescription->doctor->name}}</td>
                     
              <td class="center">
                @if(Auth()->User()->role_id==2)
                 
                  <a class="btn btn-primary" href="{{route('prescriptions.edit',$prescription->id)}}">
                    <i class="fas fa-edit">Edit</i> 
                  </a>
                @endif
                  <a class="btn btn-info" href="{{route('prescriptions.show',$prescription->id)}}">
                    <i class="fas fa-eye">View Prescription</i> 
                  </a>
                 
                  <a class="btn btn-info" href="{{route('diagnosisReports.show',$prescription->id)}}">
                    <i class="fas fa-eye">View Report</i> 
                  </a>
                @if(Auth()->User()->role_id==2)
                  
                  {!! Form::open(['method' => 'DELETE','route' => ['prescriptions.destroy', $prescription->id],'style'=>'display:inline']) !!}
                  {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                  {!! Form::close() !!}
                @endif
              </td>
          </tr>
          @endforeach
        </tbody>
    </table>  
    </div><!-- table-wrapper -->
        
    <div class="d-flex justify-content-center">
      {!! $prescriptions->links() !!}
  </div>
  </div>
</div>

                      
        
@endsection