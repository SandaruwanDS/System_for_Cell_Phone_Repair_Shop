{{-- @extends('layouts.app') --}}
@extends('layouts.topnavbar')
@extends('layouts.sidebar')
@section('content')

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Dashboard</title>

    <style>
        html, body {
            overflow: visible;
        }

        .scrollerme {
            width: 100%;
            height: 200px;
            overflow-y: scroll;
            scrollbar-width: thin;
            }

        .alert {
            border-radius: 0;
            -webkit-border-radius: 0;
            box-shadow: 0 1px 2px rgba(0, 0, 0, 0.11);
            display: table;
            width: 100%;
        }

        .alert-white {
            background-image: linear-gradient(to bottom, #fff, #f9f9f9);
            border-top-color: #d8d8d8;
            border-bottom-color: #bdbdbd;
            border-left-color: #cacaca;
            border-right-color: #cacaca;
            color: #404040;
            padding-left: 61px;
            position: relative;
        }

        .alert-white.rounded {
            border-radius: 3px;
            -webkit-border-radius: 3px;
        }

        .alert-white.rounded .icon {
            border-radius: 3px 0 0 3px;
            -webkit-border-radius: 3px 0 0 3px;
        }

        .alert-white .icon {
            text-align: center;
            width: 45px;
            height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            border: 1px solid #bdbdbd;
            padding-top: 15px;
        }


        .alert-white .icon:after {
            -webkit-transform: rotate(45deg);
            -moz-transform: rotate(45deg);
            -ms-transform: rotate(45deg);
            -o-transform: rotate(45deg);
            transform: rotate(45deg);
            display: block;
            content: '';
            width: 10px;
            height: 10px;
            border: 1px solid #bdbdbd;
            position: absolute;
            border-left: 0;
            border-bottom: 0;
            top: 50%;
            right: -6px;
            margin-top: -3px;
            background: #fff;
        }

        .alert-white .icon i {
            font-size: 20px;
            color: #fff;
            left: 12px;
            margin-top: -10px;
            position: absolute;
            top: 50%;
        }

        /*============ colors ========*/
        .alert-success {
            color: #3c763d;
            background-color: #dff0d8;
            border-color: #d6e9c6;
        }

        .alert-white.alert-success .icon,
        .alert-white.alert-success .icon:after {
            border-color: #54a754;
            background: #60c060;
        }

        .alert-info {
            background-color: #d9edf7;
            border-color: #98cce6;
            color: #3a87ad;
        }

        .alert-white.alert-info .icon,
        .alert-white.alert-info .icon:after {
            border-color: #3a8ace;
            background: #4d90fd;
        }


        .alert-white.alert-warning .icon,
        .alert-white.alert-warning .icon:after {
            border-color: #d68000;
            background: #fc9700;
        }

        .alert-warning {
            background-color: #fcf8e3;
            border-color: #f1daab;
            color: #c09853;
        }

        .alert-danger {
            background-color: #f2dede;
            border-color: #e0b1b8;
            color: #b94a48;
        }

        .alert-white.alert-danger .icon,
        .alert-white.alert-danger .icon:after {
            border-color: #ca452e;
            background: #da4932;
        }

    </style>

</head>

<body class="nk-body bg-lighter npc-default has-sidebar no-touch nk-nio-theme">
    <div class="main-wrapper">

        <div class="page-wrapper">
            <div class="content container-fluid">
                <div class="row">

                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="shadow p-3 mb-1 bg-body-tertiary rounded">
                                <div class="dash-widget-header">
                                    <span class="dash-widget-icon bg-1">
                                        <i class="fas fa-dollar-sign"></i>
                                    </span>
                                    <div class="dash-count">
                                        <div class="dash-title">TOTAL SALES</div>
                                        <div class="dash-counts">
                                            <p>{{ number_format($totalSales, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-3">
                                    <div class="progress-bar bg-5" role="progressbar" style="width: 75%"
                                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                {{-- <p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i
                                    class="fas fa-arrow-down me-1"></i>1.15%</span> since last week</p> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="shadow p-3 mb-1 bg-body-tertiary rounded">
                                <div class="dash-widget-header">
                                    <span class="dash-widget-icon bg-2">
                                        <i class="fas fa-shopping-cart"></i>
                                    </span>
                                    <div class="dash-count">
                                        <div class="dash-title">TOTAL PURCHASES</div>
                                        <div class="dash-counts">
                                            <p>{{ number_format($totalPurchases, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-3">
                                    <div class="progress-bar bg-6" role="progressbar" style="width: 65%"
                                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                {{-- <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i
                                    class="fas fa-arrow-up me-1"></i>2.37%</span> since last week</p> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="shadow p-3 mb-1 bg-body-tertiary rounded">
                                <div class="dash-widget-header">
                                    <span class="dash-widget-icon bg-3">
                                        <i class="fas fa-exclamation"></i>
                                    </span>
                                    <div class="dash-count">
                                        <div class="dash-title">TOTAL ADVANCE</div>
                                        <div class="dash-counts">
                                            <p>{{ number_format($totalAdvance, 2) }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-3">
                                    <div class="progress-bar bg-7" role="progressbar" style="width: 85%"
                                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                {{-- <p class="text-muted mt-3 mb-0"><span class="text-success me-1"><i
                                            class="fas fa-arrow-up me-1"></i>3.77%</span> since last week</p> --}}
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-3 col-sm-6 col-12">
                        <div class="card">
                            <div class="shadow p-3 mb-1 bg-body-tertiary rounded">
                                <div class="dash-widget-header">
                                    <span class="dash-widget-icon bg-4">
                                        <i class="far fa-file"></i>
                                    </span>
                                    <div class="dash-count">
                                        <div class="dash-title">JOB SHEETS</div>
                                        <div class="dash-counts">
                                            <p>{{$jobsCount}}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="progress progress-sm mt-3">
                                    <div class="progress-bar bg-8" role="progressbar" style="width: 45%"
                                        aria-valuenow="75" aria-valuemin="0" aria-valuemax="100"></div>
                                </div>
                                {{-- <p class="text-muted mt-3 mb-0"><span class="text-danger me-1"><i
                                            class="fas fa-arrow-down me-1"></i>8.68%</span> since last week</p> --}}
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card flex-fill mt-0 mb-1">
                    <div class="card-header">

                        <div class="scrollerme" >


                                <!-- Show Out of Stock alerts first -->
                                @foreach ($stockDetails as $data)
                                @if ($data->total_qun_in - $data->total_qun_out < 1)
                                    <div class="alert alert-danger alert-white rounded">
                                        <div class="icon">
                                            <i class="fa fa-times-circle"></i>
                                        </div>
                                        <strong>Warning !</strong>
                                        Item Out of Stock !&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="">Code: </a>{{$data->Item_code}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="">Item Name: </a>{{$data->Item_description}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    </div>
                                @endif
                                @endforeach

                                <!-- Show Low Stock alerts -->
                                @foreach ($stockDetails as $data)
                                @if ($data->total_qun_in - $data->total_qun_out >= 1 && $data->total_qun_in - $data->total_qun_out < $data->alert_quantity)
                                    <div class="alert alert-warning alert-white rounded">
                                        <div class="icon"><i class="fa fa-warning"></i></div>
                                        <strong>Warning !</strong>
                                        Item Low Stock !&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="">Code: </a> {{$data->Item_code}} &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="">Item Name: </a> {{$data->Item_description}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                        <a href="">Stock : </a> {{$data->total_qun_in - $data->total_qun_out}}
                                    </div>
                                @endif
                                @endforeach

                        </div>

                    </div>
                </div>


                <div class="row">
                    <div class="col-xl-7 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">Sales Analytics</h5>
                                    <div class="dropdown">
                                        <button class="btn btn-white btn-sm dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            Monthly
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item">Weekly</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item">Monthly</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item">Yearly</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="d-flex align-items-center justify-content-between flex-wrap flex-md-nowrap">
                                    <div class="w-md-100 d-flex align-items-center mb-3 flex-wrap flex-md-nowrap">
                                        <div>
                                            <span>Total Sales</span>
                                            <p class="h3 text-primary me-5">$1000</p>
                                        </div>
                                        <div>

                                            <span>Total Sell Return</span>
                                            <p class="h3 text-success me-5">$1000</p>
                                        </div>
                                        <div>
                                            <span>Expenses</span>
                                            <p class="h3 text-danger me-5">$300</p>
                                        </div>
                                        <div>
                                            <span>Earnings</span>
                                            <p class="h3 text-dark me-5">$700</p>
                                        </div>
                                    </div>
                                </div>
                                <div id="sales_chart"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-5 d-flex">
                        <div class="card flex-fill">
                            <div class="card-header">
                                <div class="d-flex justify-content-between align-items-center">
                                    <h5 class="card-title">Invoice Analytics</h5>
                                    <div class="dropdown">
                                        <button class="btn btn-white btn-sm dropdown-toggle" type="button"
                                            id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                            Monthly
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item">Weekly</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item">Monthly</a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0);" class="dropdown-item">Yearly</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div id="invoice_chart"></div>
                                <div class="text-center text-muted">
                                    <div class="row">
                                        <div class="col-4">
                                            <div class="mt-4">
                                                <p class="mb-2 text-truncate"><i
                                                        class="fas fa-circle text-primary me-1"></i> Invoiced</p>
                                                <h5>$2,132</h5>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mt-4">
                                                <p class="mb-2 text-truncate"><i
                                                        class="fas fa-circle text-success me-1"></i> Received</p>
                                                <h5>$1,763</h5>
                                            </div>
                                        </div>
                                        <div class="col-4">
                                            <div class="mt-4">
                                                <p class="mb-2 text-truncate"><i
                                                        class="fas fa-circle text-danger me-1"></i> Pending</p>
                                                <h5>$973</h5>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title">Recent Invoices</h5>
                                    </div>
                                    <div class="col-auto">
                                        <a href="invoices.html" class="btn-right btn btn-sm btn-outline-primary">
                                            View All
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="progress progress-md rounded-pill mb-3">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 47%"
                                            aria-valuenow="47" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 28%"
                                            aria-valuenow="28" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 15%"
                                            aria-valuenow="15" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div class="progress-bar bg-info" role="progressbar" style="width: 10%"
                                            aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-auto">
                                            <i class="fas fa-circle text-success me-1"></i> Paid
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-circle text-warning me-1"></i> Unpaid
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-circle text-danger me-1"></i> Overdue
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-circle text-info me-1"></i> Draft
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-stripped table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Customer</th>
                                                <th>Amount</th>
                                                <th>Due Date</th>
                                                <th>Status</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="profile.html"><img
                                                                class="avatar avatar-sm me-2 avatar-img rounded-circle"
                                                                src="assets/img/profiles/avatar-04.jpg"
                                                                alt="User Image">Barbara Moore</a>
                                                    </h2>
                                                </td>
                                                <td>$118</td>
                                                <td>23 Nov 2020</td>
                                                <td><span class="badge bg-success-light">Paid</span></td>
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-h"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="edit-invoice.html"><i
                                                                    class="far fa-edit me-2"></i>Edit</a>
                                                            <a class="dropdown-item" href="view-invoice.html"><i
                                                                    class="far fa-eye me-2"></i>View</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-trash-alt me-2"></i>Delete</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-check-circle me-2"></i>Mark as
                                                                sent</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-paper-plane me-2"></i>Send Invoice</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-copy me-2"></i>Clone Invoice</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="profile.html"><img
                                                                class="avatar avatar-sm me-2 avatar-img rounded-circle"
                                                                src="assets/img/profiles/avatar-06.jpg"
                                                                alt="User Image">Karlene Chaidez</a>
                                                    </h2>
                                                </td>
                                                <td>$222</td>
                                                <td>18 Nov 2020</td>
                                                <td><span class="badge bg-info-light">Sent</span></td>
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-h"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="edit-invoice.html"><i
                                                                    class="far fa-edit me-2"></i>Edit</a>
                                                            <a class="dropdown-item" href="view-invoice.html"><i
                                                                    class="far fa-eye me-2"></i>View</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-trash-alt me-2"></i>Delete</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-check-circle me-2"></i>Mark as
                                                                sent</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-paper-plane me-2"></i>Send Invoice</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-copy me-2"></i>Clone Invoice</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="profile.html"><img
                                                                class="avatar avatar-sm me-2 avatar-img rounded-circle"
                                                                src="assets/img/profiles/avatar-08.jpg"
                                                                alt="User Image">Russell Copeland</a>
                                                    </h2>
                                                </td>
                                                <td>$347</td>
                                                <td>10 Nov 2020</td>
                                                <td><span class="badge bg-warning-light">Partially Paid</span></td>
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-h"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="edit-invoice.html"><i
                                                                    class="far fa-edit me-2"></i>Edit</a>
                                                            <a class="dropdown-item" href="view-invoice.html"><i
                                                                    class="far fa-eye me-2"></i>View</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-trash-alt me-2"></i>Delete</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-check-circle me-2"></i>Mark as
                                                                sent</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-paper-plane me-2"></i>Send Invoice</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-copy me-2"></i>Clone Invoice</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="profile.html"><img
                                                                class="avatar avatar-sm me-2 avatar-img rounded-circle"
                                                                src="assets/img/profiles/avatar-10.jpg"
                                                                alt="User Image">Joseph Collins</a>
                                                    </h2>
                                                </td>
                                                <td>$826</td>
                                                <td>25 Sep 2020</td>
                                                <td><span class="badge bg-danger-light">Overdue</span></td>
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-h"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="edit-invoice.html"><i
                                                                    class="far fa-edit me-2"></i>Edit</a>
                                                            <a class="dropdown-item" href="view-invoice.html"><i
                                                                    class="far fa-eye me-2"></i>View</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-trash-alt me-2"></i>Delete</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-check-circle me-2"></i>Mark as
                                                                sent</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-paper-plane me-2"></i>Send Invoice</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-copy me-2"></i>Clone Invoice</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="profile.html"><img
                                                                class="avatar avatar-sm me-2 avatar-img rounded-circle"
                                                                src="assets/img/profiles/avatar-11.jpg"
                                                                alt="User Image">Jennifer Floyd</a>
                                                    </h2>
                                                </td>
                                                <td>$519</td>
                                                <td>18 Sep 2020</td>
                                                <td><span class="badge bg-success-light">Paid</span></td>
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-h"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="edit-invoice.html"><i
                                                                    class="far fa-edit me-2"></i>Edit</a>
                                                            <a class="dropdown-item" href="view-invoice.html"><i
                                                                    class="far fa-eye me-2"></i>View</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-trash-alt me-2"></i>Delete</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-check-circle me-2"></i>Mark as
                                                                sent</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-paper-plane me-2"></i>Send Invoice</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-copy me-2"></i>Clone Invoice</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-6">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col">
                                        <h5 class="card-title">Recent Estimates</h5>
                                    </div>
                                    <div class="col-auto">
                                        <a href="estimates.html" class="btn-right btn btn-sm btn-outline-primary">
                                            View All
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="mb-3">
                                    <div class="progress progress-md rounded-pill mb-3">
                                        <div class="progress-bar bg-success" role="progressbar" style="width: 39%"
                                            aria-valuenow="39" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div class="progress-bar bg-danger" role="progressbar" style="width: 35%"
                                            aria-valuenow="35" aria-valuemin="0" aria-valuemax="100"></div>
                                        <div class="progress-bar bg-warning" role="progressbar" style="width: 26%"
                                            aria-valuenow="26" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <div class="row">
                                        <div class="col-auto">
                                            <i class="fas fa-circle text-success me-1"></i> Sent
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-circle text-warning me-1"></i> Draft
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-circle text-danger me-1"></i> Expired
                                        </div>
                                    </div>
                                </div>
                                <div class="table-responsive">
                                    <table class="table table-hover">
                                        <thead class="thead-light">
                                            <tr>
                                                <th>Customer</th>
                                                <th>Expiry Date</th>
                                                <th>Amount</th>
                                                <th>Status</th>
                                                <th class="text-right">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="profile.html"><img
                                                                class="avatar avatar-sm me-2 avatar-img rounded-circle"
                                                                src="assets/img/profiles/avatar-05.jpg"
                                                                alt="User Image"> Greg Lynch</a>
                                                    </h2>
                                                </td>
                                                <td>5 Nov 2020</td>
                                                <td>$175</td>
                                                <td><span class="badge bg-info-light">Sent</span></td>
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-h"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="edit-invoice.html"><i
                                                                    class="far fa-edit me-2"></i>Edit</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-trash-alt me-2"></i>Delete</a>
                                                            <a class="dropdown-item" href="view-estimate.html"><i
                                                                    class="far fa-eye me-2"></i>View</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-file-alt me-2"></i>Convert to
                                                                Invoice</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-check-circle me-2"></i>Mark as
                                                                sent</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-paper-plane me-2"></i>Send
                                                                Estimate</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-check-circle me-2"></i>Mark as
                                                                Accepted</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-times-circle me-2"></i>Mark as
                                                                Rejected</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="profile.html"><img
                                                                class="avatar avatar-sm me-2 avatar-img rounded-circle"
                                                                src="assets/img/profiles/avatar-06.jpg"
                                                                alt="User Image"> Karlene Chaidez</a>
                                                    </h2>
                                                </td>
                                                <td>28 Oct 2020</td>
                                                <td>$1500</td>
                                                <td><span class="badge bg-warning-light">Expired</span></td>
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-h"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="edit-invoice.html"><i
                                                                    class="far fa-edit me-2"></i>Edit</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-trash-alt me-2"></i>Delete</a>
                                                            <a class="dropdown-item" href="view-estimate.html"><i
                                                                    class="far fa-eye me-2"></i>View</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-file-alt me-2"></i>Convert to
                                                                Invoice</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-check-circle me-2"></i>Mark as
                                                                sent</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-paper-plane me-2"></i>Send
                                                                Estimate</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-check-circle me-2"></i>Mark as
                                                                Accepted</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-times-circle me-2"></i>Mark as
                                                                Rejected</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="profile.html"><img
                                                                class="avatar avatar-sm me-2 avatar-img rounded-circle"
                                                                src="assets/img/profiles/avatar-07.jpg"
                                                                alt="User Image"> John Blair</a>
                                                    </h2>
                                                </td>
                                                <td>17 Oct 2020</td>
                                                <td>$2350</td>
                                                <td><span class="badge bg-success-light">Accepted</span></td>
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-h"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="edit-invoice.html"><i
                                                                    class="far fa-edit me-2"></i>Edit</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-trash-alt me-2"></i>Delete</a>
                                                            <a class="dropdown-item" href="view-estimate.html"><i
                                                                    class="far fa-eye me-2"></i>View</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-file-alt me-2"></i>Convert to
                                                                Invoice</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-check-circle me-2"></i>Mark as
                                                                sent</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-paper-plane me-2"></i>Send
                                                                Estimate</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-check-circle me-2"></i>Mark as
                                                                Accepted</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-times-circle me-2"></i>Mark as
                                                                Rejected</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="profile.html"><img
                                                                class="avatar avatar-sm me-2 avatar-img rounded-circle"
                                                                src="assets/img/profiles/avatar-08.jpg"
                                                                alt="User Image"> Russell Copeland</a>
                                                    </h2>
                                                </td>
                                                <td>8 Oct 2020</td>
                                                <td>$1890</td>
                                                <td><span class="badge bg-success-light">Accepted</span></td>
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-h"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="edit-invoice.html"><i
                                                                    class="far fa-edit me-2"></i>Edit</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-trash-alt me-2"></i>Delete</a>
                                                            <a class="dropdown-item" href="view-estimate.html"><i
                                                                    class="far fa-eye me-2"></i>View</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-file-alt me-2"></i>Convert to
                                                                Invoice</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-check-circle me-2"></i>Mark as
                                                                sent</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-paper-plane me-2"></i>Send
                                                                Estimate</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-check-circle me-2"></i>Mark as
                                                                Accepted</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-times-circle me-2"></i>Mark as
                                                                Rejected</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <h2 class="table-avatar">
                                                        <a href="profile.html"><img
                                                                class="avatar avatar-sm me-2 avatar-img rounded-circle"
                                                                src="assets/img/profiles/avatar-09.jpg"
                                                                alt="User Image"> Leatha Bailey</a>
                                                    </h2>
                                                </td>
                                                <td>30 Sep 2020</td>
                                                <td>$785</td>
                                                <td><span class="badge bg-success-light">Accepted</span></td>
                                                <td class="text-right">
                                                    <div class="dropdown dropdown-action">
                                                        <a href="#" class="action-icon dropdown-toggle"
                                                            data-bs-toggle="dropdown" aria-expanded="false"><i
                                                                class="fas fa-ellipsis-h"></i></a>
                                                        <div class="dropdown-menu dropdown-menu-right">
                                                            <a class="dropdown-item" href="edit-invoice.html"><i
                                                                    class="far fa-edit me-2"></i>Edit</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-trash-alt me-2"></i>Delete</a>
                                                            <a class="dropdown-item" href="view-estimate.html"><i
                                                                    class="far fa-eye me-2"></i>View</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-file-alt me-2"></i>Convert to
                                                                Invoice</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-check-circle me-2"></i>Mark as
                                                                sent</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-paper-plane me-2"></i>Send
                                                                Estimate</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-check-circle me-2"></i>Mark as
                                                                Accepted</a>
                                                            <a class="dropdown-item" href="javascript:void(0);"><i
                                                                    class="far fa-times-circle me-2"></i>Mark as
                                                                Rejected</a>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @include('layouts.footer')
            </div>
        </div>
    </div>

    <script src="assets/js/jquery-3.6.0.min.js"></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/feather.min.js"></script>
    <script src="assets/plugins/slimscroll/jquery.slimscroll.min.js"></script>
    <script src="assets/plugins/apexchart/apexcharts.min.js"></script>
    <script src="assets/plugins/apexchart/chart-data.js"></script>
    <script src="assets/js/script.js"></script>
</body>

</html>


@endsection
