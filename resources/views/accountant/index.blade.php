@extends('layout.master')
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">

@endsection
@section('content')

<br>
<div class="br-pagebody">
   <div class="br-section-wrapper">
       @include('include._message')
       <div class="row">
      
        <div class="col-lg-3 offset-lg-9">
          <a href="{{route('accountants.create')}}" class="btn btn-primary" style="margin-left: 40px"><i class="fas fa-plus"></i> Add New Accountant</a>
      </div>
       
       </div>
       <br>
     <div class="row">
      <div class="col-lg-4">
        <a href="" class="btn btn-primary">
          <i class="fa fa-list"> Accountant List</i> 
         </a>
      </div>
      <div class="col-lg-4 offset-4">
        <div class="form-group">
          <input type="text" name="search" id="search" class="form-control" placeholder="Search  Accountant" />
         </div>
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
                <th>Status</th>
                <th>Actions</th>
            </tr>


        </thead>   
     <tbody>   
       
        </tbody>
    </table>  
    </div><!-- table-wrapper -->
    {{-- <div class="d-flex justify-content-center">
      {!! $accountants->links() !!}
  </div> --}}
        

  </div>
</div>

                      
        
@endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


    
<script>
$(document).ready(function(){

 fetch_accountant_data();

 function fetch_accountant_data(query = '')
 {
 
  $.ajax({
   url:"{{route('search.accountant')}}",
   method:"GET",
   data:{'query':query},
   dataType:'json',
   success:function(data)
   {
    
     var output = '';
    if(data.data.length > 0)
    {
     for(var count = 0; count < data.data.length; count++)
     {
     
      output += '<tr>';
      output += '<td class="center"><img src="'+data.data[count].image+'" style="width:40px;height:40px;"/></td>';
      output += '<td>'+data.data[count].id+'</td>';
      output += '<td>'+data.data[count].name+'</td>';
      output += '<td>'+data.data[count].email+'</td>';
      output += '<td>'+data.data[count].mobile+'</td>';
      output += '<td>'+data.data[count].status+'</td>';
      output += '<td><a class="btn btn-info"  href="accountants/'+data.data[count].id+'"><i class="fas fa-eye">View</i></a><a class="btn btn-primary" style="margin-left:2px;" href="accountants/'+data.data[count].id+'/edit"><i class="fas fa-edit">Edit</i></a><button style="margin-left:2px;" class="btn btn-danger delete" value="'+data.data[count].id+'" data-id="'+data.data[count].id+'"><i class="fas fa-trash">Delete</i></button></td>';
      output += '</tr>';
     }
    }
    else
    {
     output += '<tr>';
     output += '<td colspan="8" style="text-align:center">No Data Found</td>';
     output += '</tr>';
    }
    $('tbody').html(output);
   }
   
  })
 }

 $(document).on('keyup', '#search', function(){
  var query = $(this).val();
  fetch_accountant_data(query);
 });

});
</script>
 <script>

$(document).ready(function(){    
  $(document).on("click", ".delete", function() { 
    if(!confirm("Do you really want to do this?")) {
       return false;
     }

        var $element = $(this).parent().parent();
        var id= $(this).val();
       var token = $("meta[name='csrf-token']").attr("content");
      
      console.log(id)
      $.ajax(
      {
          url: "accountants/"+id,
          type: 'delete', 
          data: {
              "id": id ,
              "_token": token,
          },
          success: function (response)
          {
              console.log(response)
              $element.fadeOut().remove(); 
          }
             
        });
         
      });
    });

</script>
     
@endsection


{{-- @foreach($accountants as $accountant)
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
@endforeach --}}