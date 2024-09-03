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
    <title>Category Details </title>
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
                                <h4 class="card-title m-3">Category Details</h4>
                            </div>
                            <hr size="6" style="color: blue">

                            <div class="container mt-2">
                                <div class="row">
                                    <div class="col-lg-12 margin-tb">
                                        <div class="pull-left">
                                        </div>
                                        <div class="pull-right mb-2">
                                            <a class="btn btn-success card-body shadow p-3 mb-2" onClick="add()"
                                                href="javascript:void(0)">Add Category</a>
                                        </div>
                                    </div>
                                </div>
                                @if ($message = Session::get('success'))
                                <div class="alert alert-success">
                                    <p>{{ $message }}</p>
                                </div>
                                @endif

                                <div class="card-body shadow p-3 mb-5 bg-body-tertiary rounded">
                                    <div class="table-responsive">
                                        <table class="table table-bordered" id="Category">
                                            <thead>
                                                <tr class="table-secondary">
                                                    <th>Id</th>
                                                    <th>code</th>
                                                    <th>Description</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                <!-- boostrap employee model -->
                    <div class="modal fade" id="Category-modal" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Add Category Details</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <div class="card-body shadow p-3 mb-5 bg-body-tertiary rounded">
                                        <form action="javascript:void(0)" id="CategoryForm" name="CategoryForm"
                                            class="form-horizontal" method="POST" enctype="multipart/form-data">
                                            <input type="hidden" name="id" id="id">
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 control-label">Code</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="code" name="code"
                                                        placeholder="Code" maxlength="15" required="">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="name" class="col-sm-2 control-label">Category Name</label>
                                                <div class="col-sm-12">
                                                    <input type="text" class="form-control" id="cate_name"
                                                        name="cate_name" placeholder="Description" maxlength="15"
                                                        required="">
                                                </div>
                                            </div>

                                            <div class="col-sm-offset-2 col-sm-10"><br />
                                                <button type="submit" class="btn btn-primary" id="btn-save">Save
                                                    changes</button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                                <div class="modal-footer"></div>
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

                            $('#Category').DataTable({
                                processing: true,
                                serverSide: true,
                                ajax: "{{ url('Category') }}",
                                columns: [{
                                        data: 'id',
                                        name: 'id'
                                    },
                                    {
                                        data: 'code',
                                        name: 'code'
                                    },
                                    {
                                        data: 'cate_name',
                                        name: 'cate_name'
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
                            $('#CategoryForm').trigger("reset");
                            $('#CategoryModal').html("Add Category");
                            $('#Category-modal').modal('show');
                            $('#id').val('');
                        }

                        function editFunc(id) {
                            $.ajax({
                                type: "POST",
                                url: "{{ url('edit') }}",
                                data: {
                                    id: id
                                },
                                dataType: 'json',
                                success: function (res) {
                                    $('#CategoryModal').html("Edit Item");
                                    $('#Category-modal').modal('show');
                                    $('#id').val(res.id);
                                    $('#code').val(res.code);
                                    $('#cate_name').val(res.cate_name);
                                }
                            });
                        }

                        function deleteFunc(id) {
                            if (confirm("Delete Record?") == true) {
                                var id = id;
                                // ajax
                                $.ajax({
                                    type: "POST",
                                    url: "{{ url('delete') }}",
                                    data: {
                                        id: id
                                    },
                                    dataType: 'json',
                                    success: function (res) {
                                        var oTable = $('#Category').dataTable();
                                        oTable.fnDraw(false);
                                    }
                                });
                            }
                        }

                        $('#CategoryForm').submit(function (e) {
                            e.preventDefault();
                            var formData = new FormData(this);
                            $.ajax({
                                type: 'POST',
                                url: "{{ url('store')}}",
                                data: formData,
                                cache: false,
                                contentType: false,
                                processData: false,
                                success: (data) => {
                                    $("#Category-modal").modal('hide');
                                    var oTable = $('#Category').dataTable();
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
