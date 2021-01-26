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
           <h6 class="br-section-label">accountants List</h6>
         </div>



         <div class="col-lg-3 offset-lg-3">
             <a href="{{route('accountants.create')}}" class="btn btn-primary" style="margin-left: 35px">Add New accountant</a>
         </div>
     </div>

   </br>
     
   <div class="table-responsive">
    <table class="table table-bordered table-colored table-dark">
      <thead class="thead-colored thead-dark">
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Address</th>
                <th>Actions</th>
            </tr>


        </thead>   
     <tbody>   
        @foreach($accountants as $accountant)
          <tr>
              <td class="center"><img src="{{URL::asset($accountant->image)}}" style="width:40px;height:40px;"/></td> 
              <td class="center">{{$accountant->name}}</td>
              <td class="center">{{$accountant->email}}</td>
              <td class="center">{{$accountant->mobile}}</td>
              <td class="center">{!!$accountant->address!!}</td>          
              <td class="center">
                 
                  <a class="btn btn-primary" href="{{route('accountants.edit',$accountant->id)}}">
                    <i class="fas fa-edit">Edit</i> 
                  </a>
                  
                  {!! Form::open(['method' => 'DELETE','route' => ['accountants.destroy', $accountant->id],'style'=>'display:inline']) !!}
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