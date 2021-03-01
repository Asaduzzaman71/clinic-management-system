@extends('layout.master')
@section('css')
<meta name="csrf-token" content="{{ csrf_token() }}">
@endsection
@section('content')

<br>
<div class="br-pagebody">
   <div class="br-section-wrapper">
    @include('include._message')
   

@can('create', App\Models\Doctor::class)
    <div class="row">
        <div class="col-lg-3 offset-lg-9">
            <a href="{{route('doctors.create')}}" class="btn btn-primary" style="margin-left: 55px"><i class="fas fa-plus"></i> Add New Doctor</a>
        </div>
    </div>
   
    <br>
    @endcan

    <div class="row">
         
         <div class="col-lg-4">
            <a href="" class="btn btn-primary">
                <i class="fa fa-list"> Doctor List</i> 
            </a>
        </div>
        <div class="col-lg-4 offset-lg-4">
            <div class="form-group">
              <input type="text" name="search" id="search" class="form-control" placeholder="Search doctor Data" />
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
                <th>Department</th>
                <th>Email</th>
                <th>mobile</th>
                <th>Status</th>

                <th>Actions</th>
            </tr>


        </thead>   
     <tbody>   
     
      </tbody>
    </table> 
    <input type="hidden" name="hidden_page" id="hidden_page" value="1" />
    <input type="hidden" name="role" id="role" value="{{ Auth()->user()->rolde_id }}" />  
    </div><!-- table-wrapper -->
    {{-- <div class="d-flex justify-content-left">
      {!! $doctors->links() !!}
  </div> --}}

  </div>
</div>

                      
        
@endsection
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.0/jquery.min.js"></script>


    
<script>
$(document).ready(function(){
 
 fetch_doctor_data();

 function fetch_doctor_data(query = '')
 {
 
  $.ajax({
   url:"{{route('search.doctor')}}",
   method:"GET",
   data:{'query':query},
   dataType:'json',
   success:function(data)
   {
    var role=$('#role').val();
    var output = '';
    if(data.data.length > 0)
    {
     for(var count = 0; count < data.data.length; count++)
     {
     
      output += '<tr>';
      output += '<td class="center"><img src="'+data.data[count].image+'" style="width:40px;height:40px;"/></td>';
      output += '<td>'+data.data[count].name+'</td>';
      output += '<td>'+data.data[count].department.name+'</td>';
      output += '<td>'+data.data[count].email+'</td>';
      output += '<td>'+data.data[count].mobile+'</td>';
      output += '<td>'+data.data[count].status+'</td>';
     
      output += '<td><a class="btn btn-info" href="doctors/'+data.data[count].id+'"><i class="fas fa-eye">View</i></a><a style="margin-left:3px;" class="btn btn-primary" href="doctors/'+data.data[count].id+'/edit"><i class="fas fa-edit">Edit</i></a><button style="margin-left:3px;" class="btn btn-danger delete" value="'+data.data[count].id+'" data-id="'+data.data[count].id+'"><i class="fas fa-trash">Delete</i></button></td>';
      

    
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
  fetch_doctor_data(query);
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
      
     
      $.ajax(
      {
          url: "doctors/"+id,
          type: 'delete', 
          data: {
              "id": id ,
              "_token": token,
          },
          success: function (response)
          {
            
              $element.fadeOut().remove(); 
          }
             
        });
         
      });
    });

</script>
     
@endsection




  
