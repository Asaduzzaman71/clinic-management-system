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
           <h6 class="br-section-label">bloodBanks List</h6>
         </div>

         <div class="col-lg-3 offset-lg-3">
             <a href="{{route('bloodBanks.create')}}" class="btn btn-primary" style="margin-left: 35px">Add New bloodBank</a>
         </div>
     </div>
     </br>
     
   <div class="table-responsive">
    <table class="table table-bordered table-colored table-dark">
      <thead class="thead-colored thead-dark">
            <tr>
             
               
                <th>Blood Group</th>
                <th>Status</th>
                <th>Actions</th>
              
            </tr>


        </thead>   
     <tbody>   
        @foreach($bloodBanks as $bloodBank)
          <tr>

            <td class="center">{{$bloodBank->blood->blood_group}}</td>
              <td class="center">{{$bloodBank->quantity}}</td>
              <td class="center">
                  <a class="btn btn-primary" href="{{route('bloodBanks.edit',$bloodBank->id)}}">
                    <i class="fas fa-edit">Edit</i> 
                  </a>
                  
                  {!! Form::open(['method' => 'DELETE','route' => ['bloodBanks.destroy', $bloodBank->id],'style'=>'display:inline']) !!}
                  {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                  {!! Form::close() !!}
              </td>
             
          </tr>
          @endforeach
        </tbody>
    </table>  
    </div><!-- table-wrapper -->
    <div class="d-flex justify-content-center">
      {!! $bloodBanks->links() !!}
     </div>

  </div>
</div>

                      
        
@endsection