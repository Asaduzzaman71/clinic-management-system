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
           <h6 class="br-section-label">bloodDonors List</h6>
         </div>
         @can('create',\App\Models\BloodDonor::Class)
         <div class="col-lg-3 offset-lg-3">
             <a href="{{route('bloodDonors.create')}}" class="btn btn-primary" style="margin-left: 35px">Add New bloodDonor</a>
         </div>
         @endcan
     </div>
     </br>
     
   <div class="table-responsive">
    <table class="table table-bordered table-colored table-dark">
      <thead class="thead-colored thead-dark">
            <tr>
             
               
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Gender</th>
                <th>Last Blood Donation</th>
                <th>Age</th>
                <th>Blood Group</th>
                @if(Auth()->user()->role_id==5)
                <th>Actions</th>
                @endif
              
            </tr>


        </thead>   
     <tbody>   
        @foreach($bloodDonors as $bloodDonor)
          <tr>
              
             
              <td class="center">{{$bloodDonor->name}}</td>
              <td class="center">{{$bloodDonor->email}}</td>
              <td class="center">{{$bloodDonor->mobile}}</td>
              <td class="center">{{$bloodDonor->gender}}</td>
              <td class="center">{{$bloodDonor->last_donation}}</td>
              <td class="center">{{$bloodDonor->age}}</td>
              <td class="center">{{$bloodDonor->blood->blood_group}}</td>
              @can('view',$bloodDonor )   
              <td class="center">
                
               
                <a class="btn btn-primary" href="{{route('bloodDonors.show',$bloodDonor->id)}}">
                  <i class="fas fa-eye">View</i> 
                </a>
                @endcan
                @can('update', $bloodDonor)
                  <a class="btn btn-primary" href="{{route('bloodDonors.edit',$bloodDonor->id)}}">
                    <i class="fas fa-edit">Edit</i> 
                  </a>
                @endcan
                @can('delete', $bloodDonor)
                  
                  {!! Form::open(['method' => 'DELETE','route' => ['bloodDonors.destroy', $bloodDonor->id],'style'=>'display:inline']) !!}
                  {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                  {!! Form::close() !!}
              </td>
              @endcan
             
          </tr>
          @endforeach
        </tbody>
    </table>  
    </div><!-- table-wrapper -->
    <div class="d-flex justify-content-center">
      {!! $bloodDonors->links() !!}
     </div>

  </div>
</div>

                      
        
@endsection