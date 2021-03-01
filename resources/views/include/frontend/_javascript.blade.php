 
     <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
     <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>



<script>


  @if(Session::has('success'))
            toastr.success("{{ Session::get('success') }}");
  @endif


  @if(Session::has('info'))
            toastr.info("{{ Session::get('info') }}");
  @endif


  @if(Session::has('warning'))
            toastr.warning("{{ Session::get('warning') }}");
  @endif


  @if(Session::has('error'))
            toastr.error("{{ Session::get('error') }}");
  @endif


</script>


     <script>
          $(document).ready(function(){
               $("#new").click(function(){
                    $("#name").show();
                    $("#email").show();
                    $("#phone").show();
                    $("#patientId").hide();
                   
               });
               $("#old").click(function(){
                    $("#name").hide();
                    $("#email").hide();
                    $("#phone").hide();
                    $("#patientId").show();
               });

              
          });
     </script>
     <script type="text/javascript">
          $(document).ready(function(){
     
               $(document).on('change','.department',function(){
                     
                    var department_id=$(this).val();   
                    var div=$(this).parent();
                    var op=" ";
                    $.ajax({
                         type:'get',
                         url:'{!!URL::to('findDoctorDropdownList')!!}',
                         data:{'id':department_id},
                         dataType:'json',
                              success:function(data){
                                   $('#doctor').empty();
                                   for(var i=0;i<data.length;i++){
                                        op+='<option value="'+data[i].id+'">'+data[i].name+'</option>';
                                      }
                                   $("#doctor").append(op); 
                              },
                              error:function(){
                                    $('#doctor').empty();
                             }
                         });
                    });
          });
     </script>

{{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous"></script>
     <script>
          @if(Session::has('message'))
           toastr.success(Session::get('message'))
          @endif
     </script> --}}
    
     <script src="{{asset('assets/frontend/js/jquery.js')}}"></script>
     <script src="{{asset('assets/frontend/js/bootstrap.min.js')}}"></script>
     <script src="{{asset('assets/frontend/js/jquery.sticky.js')}}"></script>
     <script src="{{asset('assets/frontend/js/jquery.stellar.min.js')}}"></script>
     <script src="{{asset('assets/frontend/js/wow.min.js')}}"></script>
     <script src="{{asset('assets/frontend/js/smoothscroll.js')}}"></script>
     <script src="{{asset('assets/frontend/js/owl.carousel.min.js')}}"></script>
     <script src="{{asset('assets/frontend/js/custom.js')}}"></script>
     {{-- <script type="text/javascript">
     $(document).ready(function(){

          $('#date').change(function(){
                
               var doctor_id= $('#doctor').val();
               var date= $(this).val();
          
               $.ajax({
                    type:'get',
                    url:'{!!URL::to('checkAppointmentAvailability')!!}',
                    data:{
                           'date':date,
                           'doctor_id':doctor_id
                         },
                    dataType:'json',
                    success:function(data){
                              console.log(data)

                    }

                    error:function(){
                              alert('mismatch')
               
                                   }
               });
          });

     });
</script> --}}
