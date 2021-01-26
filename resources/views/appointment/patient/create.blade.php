@extends('layout.master')

@section('css')

@endsection

@section('content')
<br>

<div class="br-pagebody">

   
    <div class="br-section-wrapper">
        <div class="row">
            <div class="col-lg-3">
                <h5>Make a new appointment</h5>
            </div>
            
        </div>
       
      <br>
      
      <div class="form-layout form-layout-1">
        @include('include._message')
        {!! Form::open(['url' => '/appointments','method'=>'post']) !!}  
       
          @include('appointment.patient.form')
          
         <br>
          <button class="btn btn-info">Save information</button>
          {!! Form::close() !!}
        </div><!-- form-layout-footer -->
        
       
    </div><!-- form-layout -->
    
 
</div>
@endsection
@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript">
    $(document).ready(function(){

         $(document).on('change','.department',function(){
               
              var department_id=$(this).val();   
              var div=$(this).parent();
              var op=" ";
              $.ajax({
                   type:'get',
                   url:'{!!URL::to('findDoctorName')!!}',
                   data:{'id':department_id},
                   dataType:'json',
                        success:function(data){
                             
                        //op+='<option value="0" selected disabled>chose product</option>';
                        $('#doctor').empty();
                                  for(var i=0;i<data.length;i++){
                                  op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
                             }
                        $("#doctor").append(op); 
                             // div.find('.doctor').html(" ");
                             // div.find('.doctor').append(op);
                             },
                             error:function(){
                        $('#doctor').empty();
         
                   }
              });
         });

    });
</script>


@endsection