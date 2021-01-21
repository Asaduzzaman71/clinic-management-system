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
           <h6 class="br-section-label">Approved Appointments List</h6>
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
                <th>Actions</th>
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
                  <a class="btn btn-primary"  href="{{route('appointments.approve',$appointment->id)}}"> Approve</a>
                @endif
              
                
                <a class="btn btn-info details" id="{{$appointment->id}}">View</a>
              
                  
                  {!! Form::open(['method' => 'DELETE','route' => ['appointments.destroy', $appointment->id],'style'=>'display:inline']) !!}
                  {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                  {!! Form::close() !!}
            </td>
          </tr>
          @endforeach
        </tbody>
    </table>  
    </div><!-- table-wrapper -->
      @include('appointment.show')

  </div>
</div>

                      
        
@endsection
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  
<script>
  
$(document).ready(function () {

      $('.details').click(function(){

        var appointmentId = $(this).attr('id');
        console.log(appointmentId)
        $('#DetailsModal').modal('show');
        $.ajax({
          
          url:'{!!URL::to('getAppointmentDetails')!!}',
          type:'GET',
          dataType:"json",
          data:{'id':appointmentId},
            success:function(data)
            {
              console.log(data)
              $('#appointmentId').text(data.data.id);
              $('#doctorId').text(data.data.doctor_id);
              $('#doctorName').text(data.doctor.name);
              $('#patientName').text(data.data.name);
              $('#date').text(data.data.date);
              $('#message').text(data.data.message);
              $('#DetailsModal').modal('show');
            }
            })

      }); 
 
}); 
 </script>
          
   
@endsection