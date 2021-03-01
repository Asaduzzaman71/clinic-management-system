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

               <div class="row">
                 <div class="col col-lg-3">
                 <strong style="color: black">Invoice Number :  </strong><p>{{  $invoice->invoice_number }}</p>
                 </div>
                
                 <div class="col col-lg-2 offset-7">
                  <strong style="color: black">Date and Time: </strong><p>{{$invoice->created_at}} </p>
 
                  </div>
               </div>
               <div class="row">
                <div class="col col-lg-3">
                <strong style="color: black"> Patient ID :  </strong><p>{{$invoice->patient->name}} </p>
                </div>
               
                <div class="col col-lg-2 offset-7">
                 <strong style="color: black">Created By: </strong><p>{{ $user->name }}</p>

                 </div>
              </div>


               <br>
            <div class="bd bd-gray-300 rounded table-responsive">
            <table class="table">
              <thead>
                <tr>
                  <th>SN</th>
                  <th>Invoice Entry</th>
                  <th>Quantity</th>
                  <th>Amount</th>
                  <th>Subtotal</th>
                 
                </tr>
              </thead>
              <tbody>
               @foreach($invoiceEntries as $invoiceEntry)
                <tr>
                  <th scope="row">{{$invoiceEntry->invoice_number}}</th>
                  <td style="color: black">{{ $invoiceEntry->entry}}</td>
                  <td style="color: black">{{ $invoiceEntry->quantity}}</td>
                  <td style="color: black">{{ $invoiceEntry->amount}}</td>
                  <td style="color: black">{{ $invoiceEntry->subtotal}}</td>
                </tr>
                @endforeach
                <tr>
                 <td colspan="4"><strong>Sub Total Amount:</strong></td>
                 <td style="color: black"><strong>{{$invoice->subtotal}} ৳</strong> </td>
                </tr>
                <tr>
                <td colspan="4"><strong>vat</strong></td>
                <td style="color: black"><strong>{{$invoice->vat}} ৳</strong> </td>
                </tr>
                <tr>
                <td colspan="4"><strong>Discount<strong></td>
                <td style="color: black"><strong>{{$invoice->discount}} ৳</strong> </td>
                </tr>
                <tr>
                <td colspan="4"><strong>Grand Total</strong></td>
                <td style="color: black"><strong>{{$invoice->total}} ৳</strong></td>
                </tr>
              </tbody>
            </table>
          </div><!-- bd -->
          <br>

  <br>
  </div>
          <div id="button">

            <button style="margin-left:18px" class="btn btn-success" id="print">Print invoiceEntry</button>
          <a href="{{route('invoices.create')}}"<button style="margin-left:5px" class="btn btn-dark">Create New Invoice</button> </a>
          </div>
      </div>
    </div>
 @endsection

@section('js')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script >
      $(document).ready(function(){
     
      $('#print').click(function(){

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
