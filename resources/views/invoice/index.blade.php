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
           <a href="" class="btn btn-primary">
             <i class="fa fa-list"> invoices List</i> 
            </a>
         </div>



         <div class="col-lg-3 offset-lg-3">
             <a href="{{route('invoices.create')}}" class="btn btn-primary" style="margin-left: 35px">Add New invoice</a>
         </div>
     </div>

   </br>
     
   <div class="table-responsive">
    <table class="table table-bordered table-colored table-dark">
      <thead class="thead-colored thead-dark">
            <tr>
                <th>Invoice Number</th>
                <th>Title</th>
                <th>Patient Id</th>
                <th>vat</th>
                <th>Discount</th>
                <th>Sub total</th>
                <th>Total</th>
                <th>Action</th>
            </tr>


        </thead>   
     <tbody>   
        @foreach($invoices as $invoice)
          <tr>
             
              <td class="center">{{$invoice->invoice_number}}</td>
              <td class="center">{{$invoice->title}}</td>
              <td class="center">{{$invoice->patient_id}}</td>  
              <td class="center">{{$invoice->vat}}</td>    
              <td class="center">{{$invoice->discount }}</td>  
              <td class="center">{{$invoice->subtotal }}</td> 
              <td class="center">{{$invoice->total }}</td>         
              <td class="center">
                <a class="btn btn-info" href="{{route('invoices.show',$invoice->invoice_number)}}">
                  <i class="fas fa-eye">View</i> 
                </a>
                
                  <a class="btn btn-primary" href="{{route('invoices.edit',$invoice->invoice_number)}}">
                    <i class="fas fa-edit">Edit</i> 
                  </a>
                  
                  {!! Form::open(['method' => 'DELETE','route' => ['invoices.destroy', $invoice->invoice_number],'style'=>'display:inline']) !!}
                  {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                  {!! Form::close() !!}
              </td>
          </tr>
          @endforeach
        </tbody>
    </table>  
    </div><!-- table-wrapper -->
    <div class="d-flex justify-content-center">
      {!! $invoices->links() !!}
  </div>
        

  </div>
</div>

                      
        
@endsection