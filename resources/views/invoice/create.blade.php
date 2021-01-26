@extends('layout.master')
@section('css')

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
                                <label class="form-control-label" style="color:black">Search Patient By Id</label>
                                <input type="text"  name="patientName" id="patientName" class="form-control" autocomplete="off" 
                                       value="" >
                                <div id="patient_list">
                                </div>

                                <label>Type a country name</label>
                        <input type="text" name="country" id="country" placeholder="Enter country name" class="form-control">
                            </div>
                        </div>

                    </div>
                </form>

                <br>
                <br>
                <div class="row">
                    <div class="col-lg-4">

                        <table class="table table-bordered table-colored table-dark" id="memo">
                            <tbody>
                            <tr>
                                <th class="wd-10p">Name</th>
                                <td id="medicine_name"></td>
                            </tr>
                            <tr>
                                <th class="wd-35p">Category</th>
                                <td id="category_name"></td>
                            </tr>
                            <tr>
                                <th class="wd-35p">Company</th>
                                <td id="company_name"></td>
                            </tr>
                            <tr>
                                <th class="wd-20p">Expire Date</th>
                                <td id="expire_date"></td>
                            </tr>
                            <tr>
                                <th class="wd-20p">Price</th>
                                <td id="selling_price">$</td>
                            </tr>

                            <tr>
                                <th class="wd-20p">Available Qty</th>
                                <td id="quantity"></td>
                            </tr>
                            <tr>
                                <th class="wd-20p">Sell Qty</th>
                                <td>
                                    <form id="product" action="" method="post">
                                        @csrf
                                        <div class="form-group">

                                            <input type="hidden" name="medicine_id" id="medicine_id">
                                            <input class="form-control" type="number" min="1" id="sellQuantity"
                                                   name="sellQuantity" value="{{old('sellQuantity')}}"
                                                   placeholder="quantity">

                                        </div>
                                        <input type="submit" id="add_cart" class="btn btn-dark" value="Add to list">
                                    </form>
                                </td>
                            </tr>
                            </tbody>
                        </table>
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
                                <form id="invoice" action="" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="col col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" style="color:black">Insert vat(%)
                                                    amount</label>
                                                <input class="form-control" type="number" min="0" max="100" name="vat"
                                                       value="{{old('vat') ?? 0}}" placeholder="0">
                                            </div>
                                        </div>
                                        <div class="col col-lg-6">
                                            <div class="form-group">
                                                <label class="form-control-label" style="color:black">Insert Discount
                                                    amount</label>
                                                <input class="form-control" type="number" min="0" max="100"
                                                       name="discount"
                                                       value="{{old('discount') ?? 0}}" placeholder="0">
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
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

        <script type="text/javascript">
            $(document).ready(function () {

                $('#patientName').on('keyup',function () {
                    var patientName = $(this).val();
                    console.log(patientName)
                    if (patientName != '') {
                        $.ajax({
          
                                url:'{!!URL::to('patients/liveSearch')!!}',
                                type:'GET',
                                dataType:"json",
                                data:{'name':patientName},
                                    success:function(data)
                                    {
                                        console.log(data)
                                        $('#appointmentId').text(data.data.id);
                                        $('#doctorId').text(data.data.doctor_id);
                                        $('#doctorName').text(data.doctor.name);
                                        $('#patientName').text(data.data.name);
                                        $('#date').text(data.data.date);
                                        $('#message').text(data.data.message);
                                        $('#DetailsModal').modal('show');
                                    }
                         })

                    }
                });
            });
        </script>
            
        @endsection
