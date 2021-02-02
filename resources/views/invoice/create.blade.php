@extends('layout.master')
@section('css')
<style>
    .fontColor{
        color:black
    }
</style>
@endsection

@section('content')
    <br>
    <div class="br-pagebody">
        <div class="br-section-wrapper" style="margin-left: 0px">

            @if(Session::has('message'))
                <div class="alert alert-danger" role="alert">
                    <strong></strong>{{Session::get('message')}}
                </div>
            @endif

            <div class="row">
                <h5 style="color: black">Point Of Sale</h5>

            </div>
            <hr>

            <div class="form-layout form-layout-1" style="margin-left: -20px">
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
                <br>
                <div class="row">
                    <div class="col-lg-4">
                        <form id="product" action="{{ route('invoice.entry.add') }}" method="post">
                            @csrf
                            <table class="table table-bordered table-colored table-dark" id="memo">
                                <tbody>
                                    <tr>
                                        <th class="wd-10p">Patient Id</th>
                                        <td id="patient_id"></td>    
                                    </tr>
                                    <tr>
                                        <th class="wd-10p">Patient Name</th>
                                        <td id="patient_name"></td>
                                    </tr>
                                    <tr>
                                        <th class="wd-10p">Invoice Entry</th>
                                        <td id="invoiceEntry">
                                            <input class="form-control" type="text"
                                            name="invoiceEntry" value="{{old('invoiceEntry')}}" placeholder="Description">
                                        </td>
                                    </tr>
                                    <tr>
                                        <th class="wd-10p">Amount</th>
                                        <td id="amount">
                                            <input class="form-control" type="number" min="1" id="amount" name="amount" value="{{old('amount')}}" placeholder="Amount">
                                        </td>
                                    </tr>
                        
                                </tbody>
                            </table>
                            <input type="hidden" name="patientId" id="patientId">
                            <input type="submit" id="add_cart" class="btn btn-dark" value="Add to list">
                        </form>
                    </div>

                    <div class="col-lg-8" style="margin-left:-0px">
                       
                        <div class="container">
                            <div class="row">
                                <table class="table table-bordered table-colored table-dark">
                                    <thead>
                                    <tr>
                                        <th class="wd-10p">SN</th>
                                        <th class="wd-35p">Medicine Name</th>
                                        <th class="wd-20p">Quantity</th>
                                        <th class="wd-20p">Unit Price</th>
                                        <th class="wd-20p">Sub Total</th>
                                        <th class="wd-20p">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                  
                                        <tr>
                                            <th scope="row"></th>
                                            <td id="name_medicine"></td>
                                            <td></td>
                                            <td></td>
                                            <td></td>
                                            <td>
                                                <a class="cart_quantity_delete"
                                                   href=""><i
                                                        class="fa fa-times"></i>
                                                </a>
                                            </td>
                                        </tr>
                                  
                                    </tbody>
                                </table>
                            </div>

                            <div id="memoSaveInvoice">
                                <div class="row">
                                    <div>
                                        <h6 style="color:black">Total : <span>tk</span></h6>
                                    </div>
                                </div>
                                <br>
                                <form id="invoice" action="" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col col-lg-6">
                                            <div class="form-group">
                                                {!! Form::label('title','Invoice Title', ['class' => 'fontColor form-control-label']);!!}
                                                {!! Form::text("title",null, ["class"=>"form-control form-control-label"]) !!}
                                                <span class="validation-error">{{ $errors->first("title") }}</span>
                                            </div>
                                        </div>
                                        <div class="col col-lg-6">
                                            <div class="form-group">
                                                {!! Form::label('status', 'Choose a status', ['class' => 'fontColor form-control-label'],false);!!}
                                                {!!Form::select('status', ['1' => 'Active', '0' => 'Inactive'],NULL,
                                                    ["class"=>"form-control form-control-label"]);
                                                !!}
                                                <span class="validation-error">{{ $errors->first("status") }}</span>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col col-lg-6">
                                            <div class="form-group">
                                                {!! Form::label('vat','Insert Vat In (%)', ['class' => 'fontColor form-control-label']);!!}
                                                {!! Form::number("vat",null, ["class"=>"form-control ",'min'=>0,'max'=>100]) !!}
                                                <span class="validation-error">{{ $errors->first("vat") }}</span>
                                            </div>
                                        </div>
                                        <div class="col col-lg-6">
                                            <div class="form-group">
                                                {!! Form::label('discount','Insert Discount Amount', ['class' => 'fontColor form-control-label']);!!}
                                                {!! Form::number("discount",null, ["class"=>"form-control "]) !!}
                                                <span class="validation-error">{{ $errors->first("discount") }}</span>
                                            </div>
                                        </div>
                                    </div>
                                   
                                    <div id="saveInvoice">
                                        <input type="submit" id="submit" value="Save Invoice" class="btn btn-dark">
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <br>

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
                                $('#patientId').value(data.id);
                                
                            }
                   })
                });
            });
        </script>
        @endsection
