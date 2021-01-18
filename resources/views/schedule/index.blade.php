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
           <h6 class="br-section-label">Schedule List</h6>
         </div>



         <div class="col-lg-3 offset-lg-3">
             <a href="{{route('schedules.create')}}" class="btn btn-primary" style="margin-left: 35px">Add New Schedule</a>
         </div>
     </div>

   </br>
     
   <div class="table-responsive">
    <table class="table table-bordered table-colored table-dark">
      <thead class="thead-colored thead-dark">
            <tr>
                <th>Doctor Name</th>
                <th>Department</th>
                <th>Day</th>
                <th>Starting Time</th>
                <th>Ending TIme</th>
                <th>No of patient</th>
                <th>status</th>
                <th>Actions</th>
            </tr>


        </thead>   
     <tbody>   
        @foreach($schedules as $schedule)
          <tr>
              
              <td class="center">{{$schedule->doctor->name}}</td>
              <td class="center">{{$schedule->doctor->department->name}}</td>
              <td class="center">{{$schedule->day->day_name}}</td>
              <td class="center">{{$schedule->starting_time}}</td>
              <td class="center">{{$schedule->ending_time}}</td>
              <td class="center">{{$schedule->total_patient}}</td>
              <td class="center">{{$schedule->status}}</td>
                       
              <td class="center">
                 
                  <a class="btn btn-primary" href="{{route('schedules.edit',$schedule->id)}}">
                    <i class="fas fa-edit">Edit</i> 
                  </a>
                  
                  {!! Form::open(['method' => 'DELETE','route' => ['schedules.destroy', $schedule->id],'style'=>'display:inline']) !!}
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