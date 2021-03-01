@extends('layout.master')
@section('css')
<style>
    .fontColor{
        color:black
    }
    .td{
        
         padding-right: 15px;
         

    }
    .td2{
        
        padding-left: 10px;
        

   }
  
</style>
@endsection

@section('content')
    <br>
    <div class="br-pagebody">
        <div class="br-section-wrapper" style="margin-left: 0px">

            <div class="row">
                <h5 style="color: black">Create Invoice</h5>

            </div>
            <hr>
            @include('include._message')
            
                <form action="">
                    @csrf
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="form-group">
                                <label class="form-control-label" style="color:black">Search Patient By Name</label>
                                <input type="text"  name="patientName" id="patientName" class="form-control" autocomplete="off" 
                                       value="" >
                                <div id="patient_list">
                                </div>
                            </div>
                        </div>

                    </div>
                </form>
           
            <br>
    
            <div class="form-layout form-layout-1">
                <div class="row">
                    <h5 style="text-align:center;color:black">Create Invoice</h5>
    
                </div>
                <br>
                {!! Form::open(['url' => '/invoices','method'=>'post']) !!}
                
                @csrf
                <div class="row">
                    <div class="col col-lg-6">
                        <div class="form-group">
                            {!! Form::label('title','Invoice Title', ['class' => 'fontColor form-control-label']);!!}
                            {!! Form::text("title",null, ["class"=>"form-control form-control-label"]) !!}
                    
                        </div>
                    </div>
                    <div class="col col-lg-6">
                        <div class="form-group">
                            {!! Form::label('status', 'Choose a status', ['class' => 'fontColor form-control-label'],false);!!}
                            {!!Form::select('status', ['1' => 'Paid', '0' => 'Non-Paid'],NULL,
                                ["class"=>"form-control form-control-label"]);
                            !!}
                         
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col col-lg-6">
                        <div class="form-group">
                            {!! Form::label('vat','Insert Vat In (%)', ['class' => 'fontColor form-control-label']);!!}
                            {!! Form::number("vat",null, ["class"=>"form-control ",'min'=>0,'max'=>100]) !!}
                         
                        </div>
                    </div>
                    <div class="col col-lg-6">
                        <div class="form-group">
                            {!! Form::label('discount','Insert Discount Amount', ['class' => 'fontColor form-control-label']);!!}
                            {!! Form::number("discount",null, ["class"=>"form-control "]) !!}
                            
                        </div>
                    </div>
                </div>
                <hr>
                <div id="saveInvoice">
                    <table id="dynamicAddRemove">  
                        <tr>
                            <th class="wd-15p fontColor">Invoice Entry</th>
                            <th class="wd-15p fontColor">Quantity</th>
                            <th class="wd-15p fontColor">Amount</th>
                            <th class="wd-15p fontColor">Subtotal</th>
                            <th class="wd-10p fontColor"></th>
                        </tr>
                        <tr>  
                            <td class="td"><input type="text" name="entry[]" placeholder="Enter entry" class="form-control" id="entry" /></td>
                            <td class="td"><input type="text" name="quantity[]" placeholder="Enter quantity" class="form-control quantity" id="quantity" /></td>  
                            <td class="td"><input type="text" name="amount[]" placeholder="Enter amount" class="form-control amount" id="amount" /></td>
                            <td class="td"><input type="text" name="subtotal[]" placeholder="Subtotal" class="form-control subtotal" id="subtotal" value="0.00" readonly/></td>    
                            <td class="td2"><button type="button" name="add" id="add-btn" class="btn btn-success">Add More</button></td>  
                        </tr>  
                 </table> 
                 <br>
                    <input type="hidden" name="patientId" id="patientId">
                    <input type="submit" id="submit" value="Save Invoice" class="btn btn-dark">
                </div>

                {!! Form::close() !!}
            </div>
                

                </div>
            </div>
        </div>

        <br>
    </div>

    @endsection

        @section('js')
        <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
       

        <script type="text/javascript">
            $(document).ready(function () {

                $('#patientName').on('keyup',function() {
                    var name = $(this).val(); 
                    console.log(name)
                    $.ajax({ 
                    
                        url:"{{ route('liveSearch') }}",
                        type:"GET",
                        data:{'name':name},
                        success:function (data) {
                            console.log(data)
                            $('#patient_list').fadeIn();
                            $('#patient_list').html(data);
                        }
                    })
                    // end of ajax call
                });

                
                $(document).on('click', 'li', function(){
                  
                    var value = $(this).text();
                    $('#patientName').val(value);
                    $('#patient_list').html("");
                    $.ajax({ 
                            url:"{{ route('patientSearch') }}",
                            type:"GET",
                            data:{'name':value},
                            dataType:'json',
                            success:function (data) {
                                console.log(data.id)                    
                                $('#patient_id').text(data.id);
                                $('#patient_name').text(data.name);
                                $('#patientId').val(data.id);
                                
                            }
                   })
                });
               
         });
        </script>
         <script type="text/javascript">
                $(document).ready(function () {
                    var i = 0;
                    
                    $("#add-btn").click(function(){
                        ++i;
                        $("#dynamicAddRemove").append('<tr><td class="td"><input type="text" name="entry['+i+']" placeholder="Enter entry" class="form-control"/></td><td class="td"><input type="text" name="quantity['+i+']" placeholder="Enter quantity" class="form-control quantity"  /></td><td class="td"><input type="text" name="amount['+i+']" placeholder="Enter amount" class="form-control amount" /></td><td class="td"><input type="text" name="subtotal['+i+']" placeholder="Subtotal" class="form-control subtotal" value="0.0"  readonly/></td><td class="td2"><button type="button" name="add" id="add-btn" class="btn btn-danger remove-tr">Remove</button></td></tr>');
                        });
                        $(document).on('click', '.remove-tr', function(){  
                        $(this).parents('tr').remove();
                    });
                    $(document).on('keyup', '.amount , .quantity', function() {
                    //get amt and qty value
                    var amount = $(this).closest('tr').find('.amount').val();
                    var quantity = $(this).closest('tr').find('.quantity').val();
                    var subtotal = amount * quantity;
                    //add value to required subtotal td
                    $(this).closest('tr').find('.subtotal').val(subtotal);

                    });
                });  
            </script>


    @endsection
