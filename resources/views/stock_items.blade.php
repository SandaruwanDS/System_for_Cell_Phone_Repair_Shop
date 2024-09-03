@extends('layouts.topnavbar')
@extends('layouts.sidebar')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="http://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <link rel="stylesheet" href="http://cdn.bootcss.com/toastr.js/latest/css/toastr.min.css">
    <title>Items</title>
</head>
<body>
    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card shadow ">

                            <div class="col-md-9">
                                <h4 class="card-title m-3">Items</h4>
                            </div>
                            <hr size="6" style="color: blue">

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-sm-12">
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
                                        <div class="card card-table">
                                            <div class="card-body">
                                                {{-- --------------search and add customer button-------- --}}
                                                <div class="row">



                                                </div>
                                            </div>

                                            <div class="card-body">
                                                <div class="table-responsive">
                                                    <div class="table-data" >
                                                        <table class="table table-bordered table-center table-hover datatable">
                                                            <thead >
                                                                <tr class="table-secondary">
                                                                    <th>Code</th>
                                                                    <th>Category</th>
                                                                    <th>Description</th>
                                                                    <th>Purchase Price</th>
                                                                    <th>Sale Price</th>
                                                                    <th>QTY</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($stockDetails as $item)
                                                                <tr>
                                                                    <td>{{$item->Item_code}}</td>
                                                                    <td>{{$item->category}}</td>
                                                                    <td>{{$item->Item_description}}</td>
                                                                    <td>{{$item->purchasePrice}}</td>
                                                                    <td>{{$item->saleprice}}</td>
                                                                    <td>{{$item->total_qun_in - $item->total_qun_out}}</td>
                                                                </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>
                                                    {{-- {!! $customers->links() !!} --}}
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {!! Toastr::message() !!}


    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>


    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/feather.min.js"></script>
    {{-- <script src="assets/plugins/select2/js/select2.min.js"></script> --}}
    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables/datatables.min.js"></script>
    <script src="assets/js/script.js"></script>
    <script src="assets/plugins/apexchart/apexcharts.min.js"></script>
    <script src="assets/plugins/apexchart/chart-data.js"></script>
    <script src="http://cdn.bootcss.com/toastr.js/latest/js/toastr.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>

</body>
@endsection
</html>

