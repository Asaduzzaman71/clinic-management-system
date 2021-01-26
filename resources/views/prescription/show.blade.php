@extends('layout.master')
 @section('css')
   <link href="{{asset('public/user/lib/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/lib/ionicons/css/ionicons.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/lib/highlightjs/styles/github.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/lib/select2/css/select2.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/lib/datatables.net-dt/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link href="{{asset('public/user/lib/datatables.net-responsive-dt/css/responsive.dataTables.min.css')}}" rel="stylesheet">
  <style type="text/css">
    .textcolor{
      .color: black;

    }
  </style>


 @endsection
 @section('content')
 <br>
    <div class="br-pagebody">
    <div class="br-section-wrapper">

        <div class="container">


              <div>
                 <h3 style="text-align: center;color: black">Smart Clinic</h3>
              </div>
              <div >
                 <p style="text-align: center;color: black">Kakrail,PHP tower, Dhaka-1230</p>
                 <p style="text-align: center;color: black">Phone: 01756527233</p>
                 <p style="text-align: center;color: black">Email: asad@gmai.com</p>

              </div>

              

                   
               <br>
            <div class="bd bd-gray-300 rounded table-responsive">
            <table class="table ">
              <thead>
                <tr>
                    <th>Prescription Id</th>
                    <th>Patient Name</th>
                    <th>Prescribed By</th>
                    <th>Doctor Mobile</th>
                    <th>Created Date</th>
                </tr>
              </thead>
              <tbody>
            
                    <tr>
                        <td >{{  $prescription->id}}</td>
                        <td >{{  $prescription->patient->name}}</td>
                        <td >{{  $prescription->doctor->name }}</td>
                        <td>{{  $prescription->doctor->mobile }}</td>
                        <td>{{  $prescription->created_at}}</td>
                    </tr>

                
                    <tr>
                        <td  style="color: black"><strong>Case History:</strong></td>
                        <td colspan="4">{!! $prescription->case_history !!}</td>
                    </tr>
                    <tr>
                        <td  style="color: black"><strong>Medication:</strong></td>
                        <td colspan="4">{!! $prescription->medication !!}</td>
                    </tr>

                    <tr>
                        <td  style="color: black"><strong>Note   :<strong></td>
                        <td colspan="4">{!! $prescription->note !!}</td>
                    </tr>
              </tbody>
            </table>
            </div><!-- bd -->
          

          <br>
        </div>
         <div id="button">
            <button style="margin-left:18px" class="btn btn-success" id="print">Print Prescription</button>
            <a href="{{route('prescription.doctor',$prescription->doctor->id)}}"><button style="margin-left:5px" class="btn btn-dark">All prescription List</button> </a>
         </div>
      </div>
    </div>



@endsection



@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script >
    $(document).ready(function(){

    $('#print').click(function(){
       console.log('hi')
        //$(".br-section-wrapper").show();
        $("#button").hide();
        $(".br-footer").hide();
        $(".br-header").hide();
        window.print();
        $("#button").show();
        $(".br-footer").show();
        $(".br-header").show();


        });

 });

</script>

@endsection
