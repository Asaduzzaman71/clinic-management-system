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
           <h6 class="br-section-label">Test  List</h6>
         </div>



         <div class="col-lg-3 offset-lg-3">
             <a href="{{route('tests.create')}}" class="btn btn-primary" style="margin-left: 35px">Add New test</a>
         </div>
     </div>

   </br>
     
   <div class="table-responsive">
    <table class="table table-bordered table-colored table-dark">
      <thead class="thead-colored thead-dark">
            <tr>
                <th>Test Name</th>
                <th>Description</th>
                <th>status</th>
                <th>Actions</th>
            </tr>


        </thead>   
     <tbody> 
      @if(!empty($tests) && $tests->count())
            
        @foreach($tests as $test)
          <tr>
              
              <td class="center">{{$test->name}}</td>
              <td class="center">{!! $test->description !!}</td>
              <td class="center">
                @if($test->status==1)
                    <button class="btn btn-success" disabled>Active</button>
                @else
                    <button class="btn btn-danger" disabled>Inactive</button>
                @endif
                
            </td>
              <td class="center">
                 
                  <a class="btn btn-primary" href="{{route('tests.edit',$test->id)}}">
                    <i class="fas fa-edit">Edit</i> 
                  </a>
                  
                  {!! Form::open(['method' => 'DELETE','route' => ['tests.destroy', $test->id],'style'=>'display:inline']) !!}
                  {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                  {!! Form::close() !!}
              </td>
          </tr>
          @endforeach
          
          @else
          <tr>
            <td style="text-align: center" colspan="4" >No data available</td>

          </tr>
          @endif

        </tbody>
        
    </table>
   
    </div><!-- table-wrapper -->
    {!!$tests->links() !!}  
   
  </div>
  
</div>

                      
        
@endsection