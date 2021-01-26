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
           <h6 class="br-section-label">Requested Appointments List</h6>
         </div>



         <div class="col-lg-3 offset-lg-3">
             <a href="{{route('appointments.create')}}" class="btn btn-primary" style="margin-left: 35px">Add New Appointment</a>
         </div>
     </div>

   </br>
     
   <div class="table-responsive">
    <table class="table table-bordered table-colored table-dark">
      <thead class="thead-colored thead-dark">
            <tr>
                <th>Appointment Id</th>
                <th>Doctor Name</th>
                <th>Patient Name</th>
                <th>Email</th>
                <th>Appointment Date</th>
                <th>Status</th>
            </tr>


        </thead>   
     <tbody>   
        @foreach($appointments as $appointment)
          <tr>
            <td class="center">{{$appointment->id}}</td>
            <td class="center">{{$appointment->doctor->name}}</td>
            <td class="center">{{$appointment->name}}</td>
            <td class="center">{{$appointment->email}}</td>
            <td class="center">{{$appointment->date}}</td>
            <td class="center">
                @if($appointment->status==0)
                <span class="btn btn-warning">Pending</span>
                @endif
              
                
                
            </td>
          </tr>
          @endforeach
        </tbody>
    </table>  
    </div><!-- table-wrapper -->
        

  </div>
</div>

                      
        
@endsection