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
         </div>
       
            @can('create', App\Models\Patient::class)
            <div class="col-lg-3 offset-lg-3">
                <a href="{{route('patients.create')}}" class="btn btn-primary" style="margin-left:75px">Add New Patient</a>
            </div>
            @endcan
       
     
       </div>
       <br>

      
      {!! Form::open(['url' => '/patient/live-search','method'=>'post']) !!}
     <div class="row">
        <div class="col-lg-2">
            <button class="btn btn-primary">Search Patient</button>
        </div>
        <div class="col-lg-4">
            {!! Form::text("query",null, ["class"=>"form-control form-control-label" ,"placeholder"=>"search patient by name, email or mobile"]) !!} 
        </div>
     </div>
     {!! Form::close() !!}
     </br>
     
   <div class="table-responsive">
    <table class="table table-bordered table-colored table-dark">
      <thead class="thead-colored thead-dark">
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Gender</th>
                <th>Birthdate</th>
                <th>Age</th>
                <th>Blood Group</th>
                <th>Actions</th>
                
            </tr>


        </thead>   
     <tbody>   
        @foreach($patients as $patient)
          <tr>
              <td class="center"><img src="{{URL::asset($patient->image)}}" style="width:40px;height:40px;"/></td> 
              <td class="center">{{$patient->name}}</td>
              <td class="center">{{$patient->email}}</td>
              <td class="center">{{$patient->mobile}}</td>
              <td class="center">{{$patient->gender}}</td>
              <td class="center">{{$patient->birthdate}}</td>
              <td class="center">{{$patient->age}}</td>
              <td class="center">{{$patient->blood->blood_group}}</td>
                 
              <td class="center">
                @can('view',$patient)
                  <a class="btn btn-info" href="{{route('patients.show',$patient->id)}}">
                    <i class="fas fa-eye">View</i> 
                  </a>
                  @endcan

                  @can('update',$patient)
                  <a class="btn btn-primary" href="{{route('patients.edit',$patient->id)}}">
                    <i class="fas fa-edit">Edit</i> 
                  </a>
                  @endcan
                  @can('delete',$patient)
                  
                  {!! Form::open(['method' => 'DELETE','route' => ['patients.destroy', $patient->id],'style'=>'display:inline']) !!}
                  {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                  {!! Form::close() !!}
                  @endcan
              </td>
            
          </tr>
          @endforeach
        </tbody>
    </table>  
    </div><!-- table-wrapper -->
    <div class="d-flex justify-content-center">
      {!! $patients->links() !!}
     </div>

  </div>
</div>

                      
        
@endsection