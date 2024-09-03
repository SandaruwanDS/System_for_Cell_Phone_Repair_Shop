@extends('layouts.topnavbar')
@extends('layouts.sidebar')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Stock Transfer</title>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js"
        integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
</head>

<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card shadow">
                            <div class="col-md-9">
                                <h4 class="card-title m-3">Stock Transfer</h4>
                            </div>
                            <hr size="6" style="color: blue">
                            <div class="card-body">
                                {{-- alerts section --}}
                                @if (session('delete'))
                                <div class="alert alert-danger text-center" role="alert">
                                    {{session('delete')}} &#10004;
                                </div>
                                @endif
                                @if (session('added'))
                                <div class="alert alert-success text-center" role="alert">
                                    {{session('added')}} &#10004;
                                </div>
                                @endif
                                @if ($errors->any())
                                <div class="alert alert-danger" role="alert">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                @endif
                                @if (Session::has('done'))
                                <div class="alert alert-success text-center">
                                    <p>{{ Session::get('done') }}</p>
                                </div>
                                <script>
                                    document.addEventListener('DOMContentLoaded', function () {
                                            // Replace 'your_pdf_link_here' with the actual variable containing the PDF link
                                            var pdfLink = "{{ Session::get('pdfLink') }}";
                                            var newWindow = window.open(pdfLink, '_blank');

                                            // Wait for the new window load, then trigger the print function
                                            newWindow.onload = function () {
                                                newWindow.print();
                                            };
                                    });

                                </script>
                                @endif


                                <form action="{{route('add_stocktransfer')}}" method="post">
                                    @csrf
                                    <div class="row ">
                                        <div class="row mb-1 form-group">
                                            <div class="col-md-3">
                                                <label for="job_no"> Branch No:
                                                    <div class="input-group">
                                                        <input type="text" class="form-control  form-control-lg"
                                                            name="bccode" id="bccode"
                                                            placeholder="Enter Branch No" required />
                                                        <div class="input-group-append">
                                                            <button type="button"
                                                                class="btn btn-success btn-lg form-control "
                                                                data-bs-toggle="modal"
                                                                data-bs-target="#addJobModel">
                                                                <i class="fas fa-plus" style="color: white"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </label>
                                            </div>

                                            <div class="col-md-2 payment-history">
                                            </div>

                                            {{-- <div class="col">
                                                <div class=" form-group ">
                                                    <label for="receipt_type">Receipt Type:
                                                        <select class="form-select " id="receipt_type"
                                                            name="receipt_type" aria-hidden="true" required>
                                                            <option value="">Please Select</option>
                                                            @foreach( as $receiptData)
                                                            <option value="{{ $receiptData->receiptname }}"
                                                                data-rate="{{ $receiptData->rate1 }}">
                                                                {{ $receiptData->receiptname}}</option>
                                                            @endforeach
                                                        </select>
                                                    </label>
                                                </div>
                                            </div> --}}

                                            <div class="col">
                                              
                                            </div>
                                            <div class="col">
                                                <label for="date">Date:
                                                    <input class="form-control " type="date"
                                                        id="invoice_date" name="invoice_date" required>
                                                </label>
                                            </div>
                                            <div class="col">
                                                <label for="receipt_no">Invoice No:
                                                    <input class="form-control" type="text" value="{{$maxInvoiceNo+1}}"
                                                        placeholder="Invoice Number:" id="invoice_no" name="invoice_no"
                                                        >
                                                </label>
                                            </div>
                                        </div>

                                        {{-- heading inputs --}}
                                        <div class="row form-group">
                                            <div class="col-md-4 ">
                                            </div>
                                            <div class="row">

                                                <div class="customer-data">

                                                </div>

                                            </div>
                                        </div>

                                        {{-- dynamicAdded table --}}
                                        <table class="table table-bordered">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th style="width:15%; text-align: center;">Category</th>
                                                    <th style="width:12%; text-align: center;">Item Code</th>
                                                    <th style="width:12%; text-align: center;">Item Description</th>
                                                    <th style="width:10%; text-align: center;">QTY</th>
                                                    <th style="width:13%; text-align: center;">Unit Price</th>
                                                    <th style="width:13%; text-align: center;">Discount</th>
                                                    <th style="width:13%; text-align: center;">Net Value</th>
                                                    <th class="text-center" style="width:12%;">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>

                                                <tr>
                                                    <td>
                                                        <select class="select form-control"
                                                            id="item_category" name="item_category" aria-hidden="true">
                                                            <option value="">Select a category</option>
                                                            @foreach($itemCategory as $categoryData)
                                                            <option value="{{ $categoryData->cate_name }}">
                                                                {{ $categoryData->cate_name	}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td id="showItems">
                                                        <select class="select form-control"
                                                            id="item_code" name="item_code" aria-hidden="true">
                                                            <option value="">Select an item</option>
                                                            @foreach( $itemCode as $itemData)
                                                            <option value="{{ $itemData->Item_code }}">
                                                                {{ $itemData->Item_code}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <select class="select form-control "
                                                            id="item_description" name="item_description" aria-hidden="true">
                                                            <option value="">Select an item</option>
                                                            @foreach( $itemCode as $itemData)
                                                            <option value="{{ $itemData->Item_description }}">
                                                                {{ $itemData->Item_description}}</option>
                                                            @endforeach
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" placeholder="QTY"
                                                            id="qty" name="qty" >
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" placeholder="Unit Price"
                                                            id="unit_price" name="unit_price" value="0">
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" placeholder="Discount"
                                                            id="discount" name="discount" value="0">
                                                    </td>
                                                    <td>
                                                        <input class="form-control" type="text" placeholder="Net Value"
                                                            id="net_value" name="net_value" value="0">
                                                    </td>
                                                    <td class="text-center">
                                                        <button type="button" name="add"
                                                            class="btn add-item  btn-outline-info btn-lg shadow"> Add
                                                            <i class="fas fa-plus"></i></button>
                                                    </td>
                                                </tr>

                                            </tbody>
                                        </table>
                                        <br>

                                        {{-- dynamicAdded table --}}
                                        <table class="table table-bordered" id="dynamicAdded">

                                        </table>

                                        {{-- table footer for total calculations --}}
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr class="table-success">
                                                    <td style="width:8%;"> </td>
                                                    <td style="width:8%;"><strong>
                                                            <p>TOTAL :</p>
                                                        </strong> </td>
                                                    <td style="width:8%;"> </td>
                                                    <td style="width:8%;"></td>
                                                    <td class="total-weight text-center" style="width:8%;">
                                                        <p><strong></strong></p>
                                                    </td>
                                                    <td class="total-total_weight text-center" style="width:8%;">
                                                        <p><strong></strong></p>
                                                    </td>
                                                    <td class="total-qty text-center" style="width:8%;">
                                                        <p><strong></strong></p>
                                                    </td>
                                                    <td class="total-value text-center" style="width:8%;">
                                                        <p><strong>0.00</strong></p>
                                                    </td>
                                                    <td style="width:11%;"></td>
                                                </tr>
                                            </tbody>
                                        </table>

                                        {{-- bottom buttons  --}}
                                        <div class="row mt-3">
                                            <div class="col-md-6">

                                                <!--<div class="row">-->
                                                <!--    <div class="col">-->
                                                <!--        <label for="CASH">CASH PAY:-->
                                                <!--            <input class="form-control form-control-lg"-->
                                                <!--                style="font-weight:bold;" type="text"-->
                                                <!--                placeholder="CASH PAY:" id="cash_payment" name="cash_payment"-->
                                                <!--                >-->
                                                <!--        </label>-->
                                                <!--    </div>-->
                                                <!--</div>-->
                                                <!--<div class="row">-->
                                                <!--    <div class="col">-->
                                                <!--        <label for="amount">CARD PAY:-->
                                                <!--            <input class="form-control form-control-lg"-->
                                                <!--                style="font-weight:bold;" type="text"-->
                                                <!--                placeholder="CARD PAY:" id="card_payment" name="card_payment"-->
                                                <!--                required>-->
                                                <!--        </label>-->
                                                <!--    </div>-->
                                                <!--</div>-->
                                                <!--{{-- <div class="row">-->
                                                <!--    <div class="col">-->
                                                <!--        <label for="amount">TOTAL VALUE :-->
                                                <!--            <input style="font-weight:bold;"-->
                                                <!--                class="form-control form-control-lg" type="text"-->
                                                <!--                placeholder="AMOUNT:" id="total_amount"-->
                                                <!--                name="total_amount" readonly required>-->
                                                <!--        </label>-->
                                                <!--    </div>-->
                                                <!--</div> --}}-->
                                            </div>


                                            <div class="col-md-6">
                                                <div class="row">

                                                    <div class="col">
                                                        <label for="amount">
                                                            <input class="form-control form-control-lg"
                                                                style="font-weight:bold;" type="hidden"
                                                                placeholder="ADVANCE:" id="paid_advance" name="paid_advance"
                                                                readonly>
                                                        </label>
                                             
                                                    </div>
                                                    <div class="col">
                                                           <label for="amount">AMOUNT :
                                                            <input class="form-control form-control-lg"
                                                                style="font-weight:bold;" type="text"
                                                                placeholder="AMOUNT:" id="paid_amount" name="paid_amount"
                                                                required>
                                                        </label>
                                                    </div>
                                                    <!--<div class="col">-->
                                                    <!--    <label for="amount">DISCOUNT :-->
                                                    <!--        <input class="form-control form-control-lg"-->
                                                    <!--            style="font-weight:bold;" type="text"-->
                                                    <!--            placeholder="DISCOUNT:" id="paid_discount" name="paid_discount"-->
                                                    <!--            readonly>-->
                                                    <!--    </label>-->
                                                    <!--</div>-->
                                                    <div class="col">
                                                        <label for="amount">TOTAL VALUE :
                                                            <input style="font-weight:bold;"
                                                                class="form-control form-control-lg" type="text"
                                                                placeholder="AMOUNT:" id="total_amount"
                                                                name="total_amount" readonly required>
                                                        </label>
                                                    </div>

                                                    @foreach ($companyData as $companyCode)
                                                    <input type="hidden" id="bc" name="bc" value="{{ $companyCode->co_code}}" required>
                                                    @endforeach
                                                    <input type="hidden" id="operator" name="operator" value="{{ Auth::user()->name }}" required>

                                                </div>

                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-5"></div>
                                            <div class="col-md-7">
                                                <br>
                                                <button type="submit" name="save"
                                                    class="btn btn-outline-info btn-lg shadow">SAVE</button>
                                                <button type="button" name="print"
                                                    class="btn btn-outline-primary printReceipt btn-lg shadow">PRINT</button>
                                                <button type="button" name="pawn_delete" id="pawn_delete"
                                                    class="btn btn-outline-danger btn-lg shadow pawn_delete">DELETE</button>
                                                <button type="button" name="pawn_cancel" id="pawn_cancel"
                                                    class="btn btn-outline-warning btn-lg shadow pawn_cancel">CANCEL</button>
                                                <button type="reset" name="reset"
                                                    class="btn btn-outline-secondary btn-lg shadow">RESET</button>
                                            </div>
                                        </div>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('layouts.footer')
        </div>
    </div>



    {!! Toastr::message() !!}

    {{-- form default date set for today --}}
    <script>
        var dateObj = new Date();
        document.getElementById('invoice_date').value = dateObj.toISOString().slice(0,10);
    </script>

    {{-- CSRF Token --}}
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>

    {{-- value auto calculation --}}
    <script>
        $(document).ready(function () {
            // Listen for changes in the amount and advance fields
            $('#amount, #advance').on('input', function () {
                // Get values from the Weight and QTY fields
                let amount = parseFloat($('#amount').val()) || 0;
                let advance = parseInt($('#advance').val()) || 0;

                // Calculate the value
                let balance = (amount - advance).toFixed(2);

                // Update the Value field
                $('#balance').val(balance);
            });
        });

    </script>

    {{--  get customer data inserting job no --}}
    <script>
        $(document).ready(function () {
            // search customer data
            $(document).on('keyup', function (e) {
                e.preventDefault();
                var search_string = $('#bccode').val();
                // console.log(search_string);
                if (search_string != null) {
                    if (e.keyCode == 13 || e.keyCode == 10) {
                        $.ajax({
                            url: "{{ route('get_Branch_ajax') }}",
                            method: 'GET',
                            data: {
                                search_string: search_string
                            },
                            success: function (res) {
                                if (res.status == 'success') {
                                    let data = res.BranchNo;
                                    let Branch_details = data[0];

                                    $('.customer-data').html(
                                        `
                                        <div class="row mt-2">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label for="">Branch name: </label>
                                                    <input class="form-control " type="text"
                                                        id="name" name="branch_name" readonly required>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label for="customer_phone">Branch Address: </label>
                                                    <input class="form-control " type="text"
                                                        id="address" name="branch_address" readonly required>
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                    <label for="brand">Phone </label>
                                                    <input class="form-control " type="text"
                                                        id="contact1" name="branch_phone"  readonly required>
                                                    </div>
                                                </div>

                                            </div>
                    
                                        </div>
                                        `
                                    );

                                    // get job data
                                    let name = Branch_details.name;
                                    let address = Branch_details.address;
                                    let contact1 = Branch_details.contact1;
            

                                    $('#name').val(name);
                                    $('#address').val(address);
                                    $('#contact1').val(contact1);
                 

                                    // set complete date to today
                                    document.getElementById('completed_on').value = dateObj.toISOString().slice(0,10);
                                }

                                if (res.status == 'not_found') {
                                    $('.customer-data').html(
                                        `   <div class="form-group text-center m-1">
                                            <label for="customer_name" class="text-danger "> Customer Not Found...! </label>
                                            </div>
                                                    `
                                    );

                                }
                            }
                        });
                    }
                }
            })
        });

    </script>

    {{-- clear form --}}
    <script>
        $(document).ready(function () {
            //add new customer
            $(document).on('keyup', '#job_no', function (e) {
                e.preventDefault();
                $('#customer_name').val("");
                $('#customer_phone').val("");
                $('#receipt_date').val("");
                $('#brand').val("");
                $('#device_model').val("");
                $('#imei_number').val("");
                $('#amount').val("");
                $('#advance').val("");
                $('#balance').val("");
                $('#problem_reported').val("");
                $('#status').val("");
            })
        });

    </script>

    {{-- add new row script --}}
    <script type="text/javascript">
        var i = -1;
        let dataArray = [];
        let totalWeight = 0;
        let total_totalWeight = 0;
        let totalQty = 0;
        let totalValue = 0;
        $(".add-item").click(function () {
            i++;
            let job_no = $('#job_no').val();
            let invoice_no = $('#invoice_no').val();
            let invoice_date = $('#invoice_date').val();
            let item_category = $('#item_category').val();
            let item_code = $('#item_code').val();
            let item_description = $('#item_description').val();
            let qty = $('#qty').val();
            let unit_price = $('#unit_price').val();
            let discount = $('#discount').val();
            let net_value = $('#net_value').val();
            let operator = $('#operator').val();
            let bc = $('#bc').val();
            // let receipt_date = $('#receipt_date').val();
            // let category = $('#category').val();
            // let articles = $('#articles').val();
            // let condition = $('#condition').val();
            // let karatage = $('#karatage').val();
            // let weight = $('#weight').val();
            // let total_weight = $('#total_weight').val();
            // let qty = $('#qty').val();
            // let value = $('#value').val();


            if (job_no == "" || invoice_no == "" || item_category == "" || item_code == "" || item_description ==
                "" || qty == "" || unit_price == "" || net_value == "") {
                alert("Please fill in all the fields.");
                return;
            } else {

                // Construct the newRowData object
                let newRowData = {
                    job_no: job_no,
                    invoice_no: invoice_no,
                    invoice_date:invoice_date,
                    item_category: item_category,
                    item_code: item_code,
                    item_description: item_description,
                    qty: qty,
                    unit_price: unit_price,
                    discount: discount,
                    net_value: net_value,
                    operator:operator,
                    bc: bc,
                };

                // Add data to the array
                dataArray.push(newRowData);
                $("#dynamicAdded").prepend(
                    `
                    <tr>
                        <td style="width:15%;">
                            <input type="hidden" name="inputs[` + i + `][job_no]" value="` + job_no + `">
                            <input type="hidden" name="inputs[` + i + `][invoice_no]" value="` + invoice_no + `">
                            <input type="hidden" name="inputs[` + i + `][invoice_date]" value="` + invoice_date + `">
                            <input type="hidden" name="inputs[` + i + `][operator]" value="` + operator + `">
                            <input type="hidden" name="inputs[` + i + `][bc]" value="` + bc + `">

                            <select class="select form-control" style="text-align: center;" id="dy_item_category"
                            name="inputs[` + i + `][item_category]" aria-hidden="true" readonly>
                                <option value="">Please Select</option>
                                @foreach($itemCategory as $categoryData)
                                    <option value="{{$categoryData->cate_name}}">{{ $categoryData->cate_name }}</option>
                                @endforeach
                            </select>
                        </td>

                        <td style="width:12%;">
                            <select class="select form-control" style="text-align: center;" id="dy_item_code"
                            name="inputs[` + i + `][item_code]" aria-hidden="true" readonly>
                                <option value="">Please Select</option>
                                @foreach($itemCode as $itemData)
                                    <option value="{{ $itemData->Item_code}}">{{ $itemData->Item_code}}</option>
                                @endforeach
                            </select>
                        </td>

                        <td style="width:15%;">
                            <select class="select form-control" style="text-align: center;" id="dy_item_description"
                            name="inputs[` + i + `][item_description]" aria-hidden="true" readonly>
                                <option value="">Please Select</option>
                                @foreach($itemCode as $itemData)
                                    <option value="{{ $itemData->Item_description}}">{{ $itemData->Item_description}}</option>
                                @endforeach
                            </select>
                        </td>

                        <td style="width:10%;">
                            <input class="form-control" type="text" style="text-align: center;" placeholder="QTY"
                            id="dy_qty" name="inputs[` + i + `][qty]" value="` + qty + `" readonly>
                        </td>

                        <td style="width:13%;">
                            <input class="form-control" type="text" style="text-align: center;" placeholder="Unit Price"
                            id="dy_unit_price" name="inputs[` + i + `][unit_price]" value="` + unit_price + `" readonly>
                        </td>

                         <td style="width:13%;">
                            <input class="form-control" type="text" style="text-align: center;" placeholder="Discount"
                            id="dy_discount" name="inputs[` + i + `][discount]" value="` + discount + `" readonly>
                        </td>

                        <td style="width:13%;">
                            <input class="form-control" type="text" style="text-align: center;" placeholder="Net Value"
                            id="dy_net_value" name="inputs[` + i + `][net_value]" value="` + net_value + `" readonly>
                        </td>

                        <td style="width:6%;">
                            <center>
                                <button type="button" class="btn btn-outline-danger text-center shadow remove-input-field m-2"> <i class="far fa-trash-alt me-1"></i> Delete </button>
                            </center>
                        </td>

                    </tr>
                    `
                );
            }

            // set values in select option
            $("#dy_item_category").val(item_category);
            $('#dy_item_code').val(item_code);
            $('#dy_item_description').val(item_description);

            // totalWeight = parseFloat(totalWeight) + parseFloat(weight);
            // total_totalWeight = parseFloat(total_totalWeight) + parseFloat(total_weight);
            // totalQty = parseInt(totalQty) + parseInt(qty);
            totalValue = parseFloat(totalValue) + parseFloat(net_value);
            setTotal();
            resetTableRow()
        });

        // Function to reset the input fields and dropdowns in the table row
        function resetTableRow() {
            document.getElementById("item_category").value = "";
            document.getElementById("item_code").value = "";
            document.getElementById("item_description").value = "";
            document.getElementById("qty").value = "";
            document.getElementById("unit_price").value = "0";
            document.getElementById("discount").value = "0";
            document.getElementById("net_value").value = "0";
        }

        // get total function
        function setTotal() {
            // $('.total-weight').html(
            //     `<p><strong>` + totalWeight + `</strong></p>`
            // );
            // $('.total-total_weight').html(
            //     `<p><strong>` + total_totalWeight + `</strong></p>`
            // );
            // $('.total-qty').html(
            //     `<p><strong>` + totalQty + `</strong></p>`
            // );
            $('.total-value').html(
                `<p><strong>` + totalValue + `</strong></p>`
            );
            
            let paid_advance = $('#paid_advance').val();
            let totalValueWithAdvance = parseFloat(totalValue-paid_advance);
            if (totalValueWithAdvance > 0){
                document.getElementById("total_amount").value =totalValueWithAdvance;
            }else{
                document.getElementById("total_amount").value = 0;
            }
            
            // let totalValueFormat = number_format(totalValue,2);
            // document.getElementById("total_amount").value = totalValue;
            
        };

    </script>

    {{-- change net value calculation when change the QTY field --}}
    <script>
        $(document).on('keyup', '#qty', function () {
            let unit_price_value = $('#unit_price').val();
            let unit_qty = $('#qty').val();
            let qty_decimal = Math.trunc(unit_qty);
            let net_value_row = qty_decimal * unit_price_value ;

            if (qty_decimal != null) {
                $('#net_value').val(net_value_row);
            }
        })

    </script>

    {{-- change net value calculation when change the discount field --}}
    <script>
        $(document).on('keyup', '#discount', function () {
            let unit_price_value = $('#unit_price').val();
            let unit_qty = $('#qty').val();
            let qty_decimal = Math.trunc(unit_qty);
            let net_value_row = qty_decimal * unit_price_value ;

            let unit_discount = $('#discount').val();
            let discounted_net_value = net_value_row  - unit_discount;

            if (unit_discount > 0) {
                $('#net_value').val(discounted_net_value);
            }else{
                // $('#discount').val("0");
                $('#net_value').val(net_value_row);
            }
        })

    </script>

    {{-- Items code show acording to category --}}
    <script>
        $(document).ready(function () {
            // Listen for changes in the Weight and QTY fields
            $('#item_category').on('change', function () {
                let item_category = $('#item_category').val();
                
                $.ajax({
                            url: "{{ route('show_select_category_item_ajax') }}",
                            method: 'GET',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                item_category: item_category
                            },
                            success: function (res) {
                                if (res.status == 'success') {

                                    var itemsCodeSelected = $('#item_code');
                                    var itemDescriptionSelected = $('#item_description');
                                    var itemUnit_price = $('#unit_price');
                                    // Change this to match your items select element
                                    // Clear existing options
                                    itemsCodeSelected.empty();
                                    itemDescriptionSelected.empty();
                                    itemUnit_price.empty();
                                    

                                    // Add a default option for item code
                                    itemsCodeSelected.append($('<option>', {
                                        value: '',
                                        text: 'Select an item'
                                    }));
                                    
                                    $.each(res.data, function (index, item) {
                                        itemsCodeSelected.append($('<option>', {
                                            value: item.Item_code,
                                            text: item.Item_code
                                        }));
                                    });

                                    // Add a default option for item description
                                    itemDescriptionSelected.append($('<option>', {
                                        value: '',
                                        text: 'Select an item'
                                    }));

                                    $.each(res.data, function (index, item) {
                                        itemDescriptionSelected.append($('<option>', {
                                            value: item.Item_description,
                                            text: item.Item_description
                                        }));
                                    });

                                }
                            },
                            error: function (err) {
                                $('.errMsgContainer').html('');
                                let error = err.responseJSON;
                                $.each(error.errors, function (index, value) {
                                    $('.errMsgContainer').append(
                                        '<span class="text-danger">' + value +
                                        '<span>' + '<br>');
                                });
                            }
                        });
            });
        });
    </script>


    {{-- Item description show acording to item code --}}
    <script>
        $(document).ready(function () {
            // Listen for changes in the Weight and QTY fields
            $('#item_code').on('change', function () {
                let Item_code = $('#item_code').val();
                $.ajax({
                            url: "{{ route('show_select_item_description_ajax') }}",
                            method: 'GET',
                            data: {
                                "_token": "{{ csrf_token() }}",
                                Item_code: Item_code
                            },
                            success: function (res) {
                                if (res.status == 'success') {

                                    var itemDescriptionSelected = $('#item_description');
                                    var itemUnit_price = $('#unit_price');
                                    // Change this to match your items select element
                                    // Clear existing options
                                    itemDescriptionSelected.empty();
                                    itemUnit_price.empty();



                                    $.each(res.data, function (index, item) {
                                        itemDescriptionSelected.append($('<option>', {
                                            value: item.Item_description,
                                            text: item.Item_description
                                        }));

                                        itemUnit_price.val(item.saleprice);
                                    });

                                }
                            },
                            error: function (err) {
                                $('.errMsgContainer').html('');
                                let error = err.responseJSON;
                                $.each(error.errors, function (index, value) {
                                    $('.errMsgContainer').append(
                                        '<span class="text-danger">' + value +
                                        '<span>' + '<br>');
                                });
                            }
                        });
            });
        });
    </script>



    {{-- delete added item rows script --}}
    <script>
        $(document).on('click', '.remove-input-field', function () {
            var row = $(this).parents('tr');
            var re_item_category = row.find('#dy_item_category');
            var re_item_code = row.find('#dy_item_code');
            var re_item_description = row.find('#dy_item_description');
            var re_qty = row.find('#dy_qty');
            var re_unit_price = row.find('#dy_unit_price');
            var re_net_value = row.find('#dy_net_value');

            // var re_weightValue = re_weight.val();
            // var re_total_weightValue = re_total_weight.val();
            // var re_qtyValue = re_qty.val();
            var re_valueValue = re_net_value.val();

            // totalWeight = parseInt(totalWeight) - parseInt(re_weightValue);
            // total_totalWeight = parseInt(total_totalWeight) - parseInt(re_total_weightValue);
            // totalQty = parseInt(totalQty) - parseInt(re_qtyValue);
            totalValue = parseInt(totalValue) - parseInt(re_valueValue);

            // Remove data from the array
            var index = row.index();
            dataArray.splice(index, 1);

            $(this).parents('tr').remove();
            setTotal();
        });
    </script>

    {{-- add new invoice script --}}
    <script>
        $(document).ready(function () {
            $(document).on('click', '.add_invoice', function (e) {
                e.preventDefault();
                let invoice_no = $('#invoice_no').val();
                let invoice_date = $('#invoice_date').val();
                let job_no = $('#job_no').val();
                let customer_name = $('#customer_name').val();
                let customer_phone = $('#customer_phone').val();
                let brand = $('#brand').val();
                let device_model = $('#device_model').val();
                let imei_number = $('#imei_number').val();
                let receipt_date = $('#receipt_date').val();
                let completed_on = $('#completed_on').val();
                let status = $('#status').val();
                let amount = $('#amount').val();
                let advance = $('#advance').val();
                let balance = $('#balance').val();

                $.ajax({
                    url: "{{ route('add_invoice_ajax') }}",
                    method: 'post',
                    data: {
                        "_token": "{{ csrf_token() }}",
                        invoice_no: invoice_no,
                        invoice_date: invoice_date,
                        job_no: job_no,
                        customer_name: customer_name,
                        customer_phone: customer_phone,
                        brand: brand,
                        device_model: device_model,
                        imei_number: imei_number,
                        receipt_date: receipt_date,
                        completed_on: completed_on,
                        status: status,
                        amount: amount,
                        advance: advance,
                        balance: balance,
                    },

                    success: function (res) {
                        if (res.status == 'success') {
                            $("#addInvoiceModel").modal('hide');
                            $('#addInvoice')[0].reset();
                            $('.table').load(location.href+' .table');
                            Command: toastr["success"]("Invoice Added ...!", "Success")
                            toastr.options = {
                                "closeButton": true,
                                "debug": false,
                                "newestOnTop": false,
                                "progressBar": true,
                                "positionClass": "toast-top-right",
                                "preventDuplicates": false,
                                "onclick": null,
                                "showDuration": "300",
                                "hideDuration": "1000",
                                "timeOut": "5000",
                                "extendedTimeOut": "1000",
                                "showEasing": "swing",
                                "hideEasing": "linear",
                                "showMethod": "fadeIn",
                                "hideMethod": "fadeOut"
                            }

                            // get customer data
                            // let data = res.telNo;
                            // let cus_details = data[0];
                            // let cus_tel = cus_details.Contact_1;
                            // let cus_name = cus_details.First_name;

                            // $('#searchCustomer').val(cus_tel);
                            // $('#customer_name').val(cus_name);
                        }
                    },
                    error: function (err) {
                        $('.errMsgContainer').html('');
                        let error = err.responseJSON;
                        $.each(error.errors, function (index, value) {
                            $('.errMsgContainer').append(
                                '<span class="text-danger">' + value +
                                '<span>' + '<br>');
                        });
                    }
                })
            })
        });

    </script>

    {{-- delete invoice script --}}
    <script>
        $(document).ready(function(){
            $(document).on('click','.delete_invoice',function(e){
                        e.preventDefault();
                        let invoice_id = $(this).data('id');

                        if(confirm('Are you sure to delete invoice ?')){
                            $.ajax({
                                url:"{{ route('delete_invoice_ajax') }}",
                                method: 'post',
                                data:{"_token": "{{ csrf_token() }}",invoice_id:invoice_id},
                                success:function(res){
                                    if(res.status=='success'){
                                        $('.table').load(location.href+' .table');
                                        Command: toastr["success"]("Invoice deleted...", "Success")
                                        toastr.options = {
                                        "closeButton": true,
                                        "debug": false,
                                        "newestOnTop": false,
                                        "progressBar": true,
                                        "positionClass": "toast-top-right",
                                        "preventDuplicates": false,
                                        "onclick": null,
                                        "showDuration": "300",
                                        "hideDuration": "1000",
                                        "timeOut": "5000",
                                        "extendedTimeOut": "1000",
                                        "showEasing": "swing",
                                        "hideEasing": "linear",
                                        "showMethod": "fadeIn",
                                        "hideMethod": "fadeOut"
                                        }
                                    }
                                }
                            });
                        }
            })
        });
    </script>

    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/feather.min.js"></script>
    <script src="assets/js/toastr.min.js"></script>

    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables/datatables.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/plugins/apexchart/apexcharts.min.js"></script>
    <script src="assets/plugins/apexchart/chart-data.js"></script>
    {{-- <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
    </script>

</body>

</html>
@endsection
