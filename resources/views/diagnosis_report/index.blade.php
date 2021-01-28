@extends('layout.master')
@section('css')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@endsection
@section('content')

<br>
<div class="br-pagebody">
   <div class="br-section-wrapper">
       @include('include._message')
     <div class="row">
         <div class="col-lg-6">
           <h6 class="br-section-label">diagnosisReports List</h6>
         </div>



         <div class="col-lg-3 offset-lg-3">
          @if(Auth()->user()->role_id==2)
             <a href="{{route('diagnosis.report.create',$prescriptionId)}}" class="btn btn-primary" style="margin-left: 35px">Add New diagnosisReport</a>
          @endif
            </div>
         
     </div>

   </br>
     
   <div class="table-responsive">
    <table class="table table-bordered table-colored table-dark">
      <thead class="thead-colored thead-dark">
            <tr>
                <th>Date</th>
                <th>Prescription Id</th>
                <th>Patient Name</th>
                <th>Patient Email</th>
                <th>Doctor Name</th>
                <th>Document Type</th>
                <th>Actions</th>
            </tr>


        </thead>   
     <tbody>   
        @foreach($diagnosisReports as $diagnosisReport)
          <tr>
              <td class="center">{{$diagnosisReport->created_at}}</td> 
              <td class="center">{{$diagnosisReport->prescription->id}}</td>
              <td class="center">{{$diagnosisReport->prescription->patient->name}}</td>
              <td class="center">{{$diagnosisReport->prescription->patient->email}}</td>
              <td class="center">{{$diagnosisReport->prescription->doctor->name}}</td>
              <td class="center">{{$diagnosisReport->documentType->document_type}}</td>
                     
              <td class="center">
                   
                  @if(Auth()->User()->role_id==2||Auth()->User()->role_id==3)
                  <a href="{{route('diagnosis.report.download',$diagnosisReport->id)}}" class="btn btn-info">
                    <i  class="fa fa-download" aria-hidden="true"></i>
                  </a>
                  @endif
                
                  @if(Auth()->User()->role_id==2)
                  {!! Form::open(['method' => 'DELETE','route' => ['diagnosisReports.destroy', $diagnosisReport->id],'style'=>'display:inline']) !!}
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
      {!! $diagnosisReports->links() !!}
  </div>
        
    
  </div>
  
   
</div>
         
        
@endsection