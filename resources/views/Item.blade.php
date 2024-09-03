@extends('layouts.topnavbar')
@extends('layouts.sidebar')
@section('content')
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.7.0/dist/jquery.min.js"></script>
    <link href="https://cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css" rel="stylesheet">
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <title>Item Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="../assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.5/css/jquery.dataTables.min.css">
</head>

<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content container-fluid">

                <div class="row">
                    <div class="col-sm-12">
                        <div class="card shadow ">

                            <div class="col-md-9">
                                <h4 class="card-title m-3">Item Details</h4>
                            </div>
                            <hr size="6" style="color: blue">

                            <div class="container mt-2">
                                <div class="row">
                                    <div class="col-lg-12 margin-tb">
                                        <div class="pull-left">

                                        </div>
                                        <div class="pull-right mb-2">
                                            <a class="btn btn-success card-body shadow p-3 mb-2" onClick="add()"
                                                href="javascript:void(0)">Add Item</a>
                                        </div>
                                    </div>
                                </div>
                                @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div>
                                @endif

                                <div >
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="Item">
                                            <thead>
                                                <tr class="table-secondary">
                                                    <th>Id</th>
                                                    <th>Category</th>
                                                    <th>code</th>
                                                    <th>Name</th>
                                                    <th>Purchase Price</th>
                                                    <th>Sales Price</th>
                                                    <th>Alert Quantity</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


                <!-- add item model -->
                    <div class="modal fade" id="Item-modal" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Item</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="card-body shadow p-3  bg-body-tertiary rounded">
                                        <form action="javascript:void(0)" id="ItemForm" name="ItemForm"
                                            class="form-horizontal" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="id" id="id">
                                            <div class="row">
                                            <div class="col-sm-6">
                                                <label for="name" class="col-sm-2 control-label">Category</label>
                                                <select class="select form-control" name="category" id="category"
                                                    aria-hidden="true">
                                                    <option value="">Please Select</option>
                                                    @foreach($Category as $categoryData)
                                                    <option value="{{ $categoryData->cate_name}}">
                                                        {{ $categoryData->cate_name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>

                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="name" class="control-label">Item Code</label>
                                                    <div >
                                                        <input type="text" class="form-control" id="Item_code"
                                                            name="Item_code" placeholder="Code" maxlength="20" required="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class=" control-label">Description</label>
                                                    <div>
                                                        <input type="text" class="form-control" id="Item_description"
                                                            name="Item_description" placeholder="Description" maxlength="100"
                                                            required="">
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="name" class="col-sm-6 control-label">Reorder Alert Quantity</label>
                                                     <div class="col-sm-12">
                                                     <input type="text" class="form-control" id="alert_quantity"
                                                      name="alert_quantity" placeholder="Reorder Alert Quantity" maxlength="25" required="">
                                                 </div>
                                                </div>
                                            </div>
                                        </div>


                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name" class=" control-label">Purchase Price</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" id="purchasePrice"
                                                                name="purchasePrice" placeholder="Description"
                                                                maxlength="20" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="name" class=" control-label">Sales Price</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" class="form-control" id="saleprice"
                                                                name="saleprice" placeholder="Description"
                                                                maxlength="20" required="">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="">
                                                <button type="submit" class="btn btn-primary" id="btn-save">Save changes</button>
                                            </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- end bootstrap model -->
                    <script type="text/javascript">
                        $(document).ready(function () {
                            $.ajaxSetup({
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                }
                            });

                            $('#Item').DataTable({
                                processing: true,
                                serverSide: true,
                                ajax: "{{ url('Item') }}",
                                columns: [{
                                        data: 'id',
                                        name: 'id'
                                    },
                                    {
                                        data: 'category',
                                        name: 'category'
                                    },
                                    {
                                        data: 'Item_code',
                                        name: 'Item_code'
                                    },
                                    {
                                        data: 'Item_description',
                                        name: 'Item_description'
                                    },

                                    {
                                        data: 'purchasePrice',
                                        name: 'purchasePrice'
                                    },
                                    {
                                        data: 'saleprice',
                                        name: 'saleprice'
                                    },
                                    {
                                        data: 'alert_quantity',
                                        name: 'alert_quantity'
                                    },
                                    {
                                        data: 'action',
                                        name: 'action',
                                        orderable: false
                                    },
                                ],
                                order: [
                                    [0, 'desc']
                                ]
                            });
                        });

                        function add() {
                            $('#ItemForm').trigger("reset");
                            $('#ItemModal').html("Add Item");
                            $('#Item-modal').modal('show');
                            $('#id').val('');
                        }

                        function editFunc(id) {
                            $.ajax({
                                type: "POST",
                                url: "{{ url('mainedit') }}",
                                data: {
                                    id: id
                                },
                                dataType: 'json',
                                success: function (res) {
                                    $('#ItemModal').html("Edit Item");
                                    $('#Item-modal').modal('show');
                                    $('#id').val(res.id);
                                    $('#category').val(res.category);
                                    $('#Item_code').val(res.Item_code);
                                    $('#Item_description').val(res.Item_description);
                                    $('#alert_quantity').val(res.alert_quantity);
                                    $('#purchasePrice').val(res.purchasePrice);
                                    $('#saleprice').val(res.saleprice);

                                }
                            });
                        }

                        function deleteFunc(id) {
                            if (confirm("Delete Record?") == true) {
                                var id = id;
                                // ajax
                                $.ajax({
                                    type: "POST",
                                    url: "{{ url('maindelete') }}",
                                    data: {
                                        id: id
                                    },
                                    dataType: 'json',
                                    success: function (res) {
                                        var oTable = $('#Item').dataTable();
                                        oTable.fnDraw(false);
                                    }
                                });
                            }
                        }

                        $('#ItemForm').submit(function (e) {
                            e.preventDefault();
                            var formData = new FormData(this);
                            $.ajax({
                                type: 'POST',
                                url: "{{ url('mainstore')}}",
                                data: formData,
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: (data) => {
                                    $("#Item-modal").modal('hide');
                                    var oTable = $('#Item').dataTable();
                                    oTable.fnDraw(false);
                                    $("#btn-save").html('Submit');
                                    $("#btn-save").attr("disabled", false);
                                },
                                error: function (data) {
                                    console.log(data);
                                }
                            });
                        });

                    </script>

                    <script>
                        data - cfasync = "false"
                        src = "../../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js" >

                    </script>
                    <script src="assets/js/jquery-3.6.0.min.js"></script>
                    <script src="assets/js/bootstrap.bundle.min.js"></script>
                    <script src="assets/js/feather.min.js"></script>
                    {{-- <script src="assets/plugins/select2/js/select2.min.js"></script> --}}
                    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
                    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
                    <script src="assets/plugins/datatables/datatables.min.js"></script>
                    <script src="assets/js/script.js"></script>

                    <script src="assets/plugins/apexchart/apexcharts.min.js"></script>
                    <script src="assets/plugins/apexchart/chart-data.js"></script>

</body>
@endsection

</html>
