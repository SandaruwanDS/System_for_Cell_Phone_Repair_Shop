@extends('layouts.topnavbar')
@extends('layouts.sidebar')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Users</title>

</head>

<body>

    <div class="main-wrapper">
        <div class="page-wrapper">
            <div class="content container-fluid">
                {{-- <div class="page-header">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="page-title">Users</h3>
                            <ul class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Dashboard</a></li>
                                <li class="breadcrumb-item active">Users</li>
                            </ul>
                        </div>
                    </div>
                </div> --}}
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


                        <div class="card card-table">
                            <div class="col-md-9">
                                <h4 class="card-title m-3">All Users</h4>
                            </div>
                            <hr size="6" style="color: blue">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-sm-10">
                                    
                                    </div>
                                    <div class="col-sm-2">
                                    <a href=" {{route('add_user')}} " class="btn btn-success text-center">
                                    <i data-feather="plus"></i>
                                    Add User</a>
                                    </div>
                                </div>
                            </div>

                            <div class="card-body">
                                <div class="table-responsive">

                                    <table class="table table-stripped table-center table-hover datatable">
                                        <thead class="thead-light">
                                            <tr>
                                                {{-- <th>User Id</th> --}}
                                                <th>User Name</th>
                                                <th>Name</th>
                                                <th>Role</th>
                                                <th>Email</th>
                                                {{-- <th>Status</th> --}}
                                                {{-- <th>Registered On</th> --}}
                                                <th >Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($users as $data )
                                            <tr>
                                                {{-- <td>{{$data->id}}</td> --}}
                                                <td>{{$data->username}}</td>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="profile.html">
                                                            {{-- <img class="avatar avatar-sm me-2 avatar-img rounded-circle"
                                                                src="assets/img/profiles/avatar-01.jpg"
                                                                alt="User Image">  --}}
                                                                {{$data->name}}</a>
                                                    </h2>
                                                </td>
                                                <td><span class="text-success">{{$data->role}}</span></td>


                                                <td><a href="/cdn-cgi/l/email-protection" class="__cf_email__"
                                                        data-cfemail="a5c6cdc4d7c9c0d6cdc4c3cbc0d7e5c0ddc4c8d5c9c08bc6cac8">{{$data->email}}</a>
                                                </td>

                                                {{-- <td>{{$data->created_at}}</td> --}}

                                                {{-- <td><span class="badge badge-pill bg-success-light">Active</span></td> --}}
                                                <td>
                                                    <a href="/edit_user/{{ $data->id }}"
                                                        class="btn btn-sm btn-success bg-success-light text-success me-2"><i
                                                            class="far fa-edit me-1"></i> Edit </a>

                                                            <a href="/edit_user/{{ $data->id }}"
                                                                class="btn btn-sm btn-primary bg-primary-light text-primary me-2">
                                                                <i class="far fa-eye me-1"></i> View </a>

                                                    <a href="/delete_user/{{ $data->id }}"
                                                        class="btn btn-sm btn-danger bg-danger-light text-danger me-2"><i
                                                            class="far fa-trash-alt me-1"></i> Delete </a>
                                                </td>
                                            </tr>
                                            @endforeach

                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>

    </div>


    <script data-cfasync="false" src="../../../../cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js">
    </script>
    <script src="assets/js/jquery-3.6.0.min.js"></script>

    <script src="assets/js/bootstrap.bundle.min.js"></script>

    <script src="assets/js/feather.min.js"></script>

    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>

    <script src="assets/plugins/datatables/jquery.dataTables.min.js"></script>
    <script src="assets/plugins/datatables/datatables.min.js"></script>

    <script src="assets/js/script.js"></script>
</body>
@endsection
</html>
