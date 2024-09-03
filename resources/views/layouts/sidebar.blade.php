<head>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css">
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <link rel="stylesheet" href="assets/css/toastr.min.css">

    <link rel="stylesheet" href="assets/plugins/select2/css/select2.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-datetimepicker.min.css">

<style>

    .scroll {
        width: 100%;
        height: 100%;
        overflow-y: scroll;
        scrollbar-width: thin;
    }

    ::-webkit-scrollbar {
        width: 8px;
    }

    ::-webkit-scrollbar-thumb {
        border-radius: 30px;
        background: -webkit-gradient(linear,left top,left bottom,from(#999999),to(#999999));
        box-shadow: inset 2px 2px 2px rgba(255,255,255,.25), inset -2px -2px 2px rgba(238, 237, 237, 0.25);
    }

    ::-webkit-scrollbar-track {
        background-color: #eeeeee;
        border-radius:10px;
        background: linear-gradient(to right,#eeeeee,#eeeeee 1px,#eeeeee 1px,#eeeeee);
    }

</style>

</head>

<div class="sidebar shadow" id="sidebar">
    <div class="scroll">
        <div id="sidebar-menu" class="sidebar-menu">
            <ul>
                    {{-- Main --}}
                    <li class="menu-title"><span>Main</span></li>
                    <li class="{{ Request::is('home') ? 'active' : '' }}">
                        <a href="{{route("home")}}"><i class="fa fa-desktop"></i> <span>Home</span></a>
                    </li>

                    {{-- User Management --}}
                    <li class="submenu {{ Request::is('users') || Request::is('add_user')  ? 'active' : '' }} ">
                        <a href="#" class=" {{ Request::is('users') || Request::is('add_user') ? 'subdrop' : '' }} ">
                            <i class="fa fa-users"></i> <span> User Management</span>
                            <span class="menu-arrow"></span></a>
                        <ul style=" {{ Request::is('users') || Request::is('add_user') ? 'display:block;' : '' }} ">
                            <li class="{{ Request::is('users') || Request::is('add_user') ? 'active ' : '' }}">
                                <a href="{{route("users")}}">
                                    <i class="fa fa-angle-right"></i>
                                    Users
                                </a>
                            </li>
                            <li><a href="#">
                                    <i class="fa fa-angle-right"></i>
                                    Roles</a></li>

                            <li><a href="#">
                                    <i class="fa fa-angle-right"></i>
                                    Sales Commission Agents</a></li>
                        </ul>
                    </li>

                    {{-- system --}}

                    <li class="{{ Request::is('Company*') ? 'active' : '' }}">
                        <a href="#"><i class="fa fa-th-list"></i> <span>System</span>
                            <span class="menu-arrow"></span></a>

                        <ul style=" {{ Request::is('Company*') ? 'display:block;' : '' }}">
                            <li class="{{ Request::is('Company') ? 'active' : '' }}">
                                <a href="{{route("Company")}}">
                                    <i class="fa fa-angle-right"></i>
                                    Company</a>
                            </li>
                        </ul>
                    </li>

                    {{-- Master --}}
                    <li
                        class="dropdown {{ Request::is('master*') || Request::is('Technician') ||Request::is('Suppliers') || Request::is('Item') || Request::is('Category') ? 'active' : '' }} ">
                        <a href="#"><i class="fa fa-sitemap"></i> <span> Master</span> <span
                                class="menu-arrow"></span></a>
                        <ul
                            style=" {{ Request::is('master*') || Request::is('Technician') ||Request::is('Suppliers') || Request::is('Item') || Request::is('Category')  ? 'display:block;' : '' }}">
                            <li class="dropdown {{ Request::is('master_customers') ? 'active' : '' }}">
                                <a href="{{route("master_customers")}}">
                                    <i class="fa fa-angle-right"></i>Customers</a>
                            </li>
                            <li class="{{ Request::is('Category') ? 'active' : '' }}">
                                <a href="{{route("Category")}}"><i class="fa fa-angle-right"></i>Category</a>
                            </li>

                            <li class="{{ Request::is('Item') ? 'active' : '' }}">
                                <a href="{{route('Item')}}"><i class="fa fa-angle-right"></i>Item</a>
                            </li>
                            <li class="{{ Request::is('Suppliers') ? 'active' : '' }}">
                                <a href="{{('Suppliers')}}"><i class="fa fa-angle-right"></i>Suppliers</a>
                            </li>

                            <li class="{{ Request::is('Technician') ? 'active' : '' }}">
                                <a href="{{('Technician')}}"><i class="fa fa-angle-right"></i>Technician</a>
                            </li>

                            <li class="{{ Request::is('master_branchdetails') ? 'active' : '' }}">
                                <a href="{{route("branchdetails")}}">
                                    <i class="fa fa-angle-right"></i>
                                    Branch</a>
                            </li>
                        </ul>
                    </li>


                    {{-- Stock --}}
                    <li class=" dropdown {{ Request::is('repair*') ? 'active' : '' }}">
                        <a href="#"><i class="fa fas fa-wrench"></i> <span>Repair</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul style=" {{ Request::is('repair*') ? 'display:block;' : '' }}">
                            <li class="{{ Request::is('repair_jobsheet') ? 'active' : '' }}">
                                <a href="{{route('repair_jobsheet')}}">
                                    <i class="fa fa-angle-right"></i>Job Sheet</a>
                            </li>

                            <li class="{{ Request::is('repair_jobs') ? 'active' : '' }}">
                                <a href="{{route('repair_jobs')}}">
                                    <i class="fa fa-angle-right"></i>Jobs</a>
                            </li>

                            {{-- <li class="{{ Request::is('repair_invoice') ? 'active' : '' }}">
                            <a href="{{route("repair_invoice")}}">
                                <i class="fa fa-angle-right"></i>Invoice</a>
                    </li> --}}
            </ul>
            </li>

            <li class="{{ Request::is('stock*') ? 'active' : '' }}">
                <a href="#"><i class="fa fas fa-database"></i> <span>Stock</span>
                    <span class="menu-arrow"></span></a>

                <ul style=" {{ Request::is('stock*') ? 'display:block;' : '' }}">
                    <li class="{{ Request::is('stock_items') ? 'active' : '' }}">
                        <a href="{{route("stock_items")}}">
                            <i class="fa fa-angle-right"></i>
                            Stock</a>
                    </li>

                    <li class="{{ Request::is('stock_transfer') ? 'active' : '' }}">
                        <a href="{{route("stock_transfer")}}">
                            <i class="fa fa-angle-right"></i>
                            Stock Transfer</a>
                    </li>

                    <li class="{{ Request::is('stock_open') ? 'active' : '' }}">
                        <a href="{{route("stock_open")}}">
                            <i class="fa fa-angle-right"></i>
                            Open Stock</a>
                    </li>

                    <li class="">
                        <a href="{{("sample")}}">
                            <i class="fa fa-angle-right"></i>
                            Damage Stock</a>
                    </li>

                    <li class="">
                        <a href="{{route("Company")}}">
                            <i class="fa fa-angle-right"></i>
                            Sale Return Stock</a>
                    </li>
                </ul>
            </li>

            <li class=" dropdown {{ Request::is('sales*') ? 'active' : '' }} ">
                <a href="#"><i class="fa fa-th-list"></i> <span>Sales</span>
                    <span class="menu-arrow"></span></a>

                <ul style="{{ Request::is('sales*') ? 'display:block;' : '' }} ">
                    <li class="">
                        <a href="">
                            <i class="fa fa-angle-right"></i>Order sales</a>
                    </li>


                    <li class="{{ Request::is('sales_invoice') ? 'active' : '' }}">
                        <a href="{{route("sales_invoice")}}">
                            <i class="fa fa-angle-right"></i>Invoice Sales</a>
                    </li>

                    <li class="{{ Request::is('sales_create_invoice') ? 'active' : '' }}">
                        <a href="{{route("sales_create_invoice")}}">
                            <i class="fa fa-angle-right"></i>Create Invoice</a>
                    </li>

                    <li class="">
                        <a href="">
                            <i class="fa fa-angle-right"></i>
                            Sales Return</a>
                    </li>
                </ul>
            </li>


            <li class=" dropdown {{ Request::is('purchases*') ? 'active' : '' }} ">
                <a href="#"><i class="fa fa-shopping-cart"></i> <span>Purchases</span>
                    <span class="menu-arrow"></span></a>

                <ul style="{{ Request::is('purchases*') ? 'display:block;' : '' }} ">
                    {{-- <li class="">
                            <a href="">
                                <i class="fa fa-angle-right"></i>
                                Order sales</a>
                        </li>


                        <li class="{{ Request::is('sales_invoice') ? 'active' : '' }}">
                    <a href="{{route("sales_invoice")}}">
                        <i class="fa fa-angle-right"></i>Invoice Sales</a>
            </li> --}}

            <li class="{{ Request::is('purchases_invoice') ? 'active' : '' }}">
                <a href="{{route("purchases_invoice")}}">
                    <i class="fa fa-angle-right"></i>Create Purchases</a>
            </li>

            {{-- <li class="">
                            <a href="">
                                <i class="fa fa-angle-right"></i>
                                Sales Return</a>
                        </li> --}}
            </ul>
            </li>

            <li class="dropdown ">
                <a href="#"><i class="fa fa-chart-area"></i> <span>Reports</span> <span class="menu-arrow"></span></a>
                <ul>
                    <li><a href="Pending_report"><i class="fa fa-angle-right"></i>Pending Job Report</a></li>
                    <li><a href="Completereport"><i class="fa fa-angle-right"></i>Complete Job Report</a></li>
                    <li><a href="{{route("report_by_technician")}}"><i class="fa fa-angle-right"></i>Technician Report</a></li>
                    <li><a href="{{route("report_by_technician_profit")}}"><i class="fa fa-angle-right"></i>Technician Profit Report</a></li>
                    <li><a href="{{route("sales_report")}}"><i class="fa fa-angle-right"></i>Sales Report</a></li>
                    <li><a href="{{route("stock_report")}}"><i class="fa fa-angle-right"></i> Stock Report</a></li>
                    <li><a href="{{route("rejected_job_report")}}"><i class="fa fa-angle-right"></i>Rejected Job Report</a></li>
                    <!--<li><a href="#"><i class="fa fa-angle-right"></i> Table Report</a></li>-->
                    <!--<li><a href="#"><i class="fa fa-angle-right"></i> Sales Representative Report</a></li>-->
                    <!--<li><a href="#"><i class="fa fa-angle-right"></i> Register Report</a></li>-->
                    <!--<li><a href="#"><i class="fa fa-angle-right"></i> Sell Payment Report</a></li>-->
                    <!--<li><a href="#"><i class="fa fa-angle-right"></i> Purchase Payment Report</a></li>-->
                    <!--<li><a href="#"><i class="fa fa-angle-right"></i> Product Sell Report</a></li>-->
                    <!--<li><a href="#"><i class="fa fa-angle-right"></i> Items Report</a></li>-->
                    <!--<li><a href="#"><i class="fa fa-angle-right"></i> Purchase & Sale</a></li>-->
                    <!--<li><a href="#"><i class="fa fa-angle-right"></i> Trending Products</a></li>-->
                    <!--<li><a href="#"><i class="fa fa-angle-right"></i> Stock Adjustment Report</a></li>-->
                    <!--<li><a href="#"><i class="fa fa-angle-right"></i> Lot Report</a></li>-->
                    <!--<li><a href="#"><i class="fa fa-angle-right"></i> Stock Report</a></li>-->
                    <!--<li><a href="#"><i class="fa fa-angle-right"></i> Customer Groups Report</a></li>-->
                    <!--<li><a href="#"><i class="fa fa-angle-right"></i> Supplier & Customer Report</a></li>-->
                    <!--<li><a href="#"><i class="fa fa-angle-right"></i> Tax Report</a></li>-->
                    <!--<li><a href="#"><i class="fa fa-angle-right"></i> Activity Log</a></li>-->
                </ul>
            </li>




            {{-- Vochers --}}
            {{-- <li class="{{ Request::is('PaymentVoucher*') ? 'active' : '' }}||
            {{ Request::is('PaymentVoucher*') ? 'active' : '' }} ">
            <a href="#">
                <i class="fa fa-barcode"></i> <span> Vouchers</span> <span class="menu-arrow"></span></a>
            <ul style=" {{ Request::is('PaymentVoucher*') ? 'display:block;' : '' }}">
                <li class="{{ Request::is('PaymentVoucher') ? 'active' : '' }}">
                    <a href="{{route("PaymentVoucher")}}">
                        <i class="fa fa-angle-right"></i>
                        Payment Vouchers</a>
                </li>
                <li class="{{ Request::is('PettyCash') ? 'active' : '' }}">
                    <a href="{{route("PettyCash")}}">
                        <i class="fa fa-angle-right"></i>
                        Petty Cash</a>
                </li>
            </ul>
            </li> --}}

            {{-- Bank --}}
            {{-- <li class="">
                    <a href="#">
                        <i class="fa fa-credit-card"></i> <span> Banking </span> <span
                            class="menu-arrow"></span></a>
                            <ul style="">
                                <li class="">
                                    <a href="">
                                    <i class="fa fa-angle-right"></i>
                                    Cheque Deposit</a>
                                </li>
                                <li class="">
                                    <a href="">
                                    <i class="fa fa-angle-right"></i>
                                    Issued Cheques </a>
                                </li>
                                <li class="">
                                    <a href="">
                                    <i class="fa fa-angle-right"></i>
                                    Cheque Return</a>
                                </li>
                                <li class="">
                                    <a href="">
                                    <i class="fa fa-angle-right"></i>
                                    Banking Recognition</a>
                                </li>
                            </ul>
                 </li> --}}

            {{-- Accounting --}}
            {{-- <li class="">
                    <a href="#">
                        <i class="fa fa-table"></i> <span> Accounting</span> <span
                            class="menu-arrow"></span></a>
                            <ul style="">
                                <li class="">
                                    <a href="{{route("account_type")}}">
            <i class="fa fa-angle-right"></i>
            Type</a>
            </li>
            <li class="">
                <a href="{{route("account_category")}}">
                    <i class="fa fa-angle-right"></i>
                    Category</a>
            </li>
            <li class="">
                <a href="">
                    <i class="fa fa-angle-right"></i>
                    Chart Of Accounts</a>
            </li>
            <li class="">
                <a href="">
                    <i class="fa fa-angle-right"></i>
                    Journal Entries</a>
            </li>
            </ul>
            </li> --}}

            {{-- Reports --}}

            {{-- Stock --}}
            {{-- <li class="dropdown {{ Request::is('stock*') ? 'active' : '' }} ">
            <a href="#"><i class="fa fa-cogs"></i> <span> Stock</span> <span class="menu-arrow"></span></a>
            <ul style="{{ Request::is('stock*') ? 'display:block;' : '' }} ">
                <li class=" {{ Request::is('stock_OP') ? 'active' : '' }} ">
                    <a href="{{route("stock_OP")}}"><i class="fa fa-angle-right"></i> Opening Stock</a></li>
                <li class=" {{ Request::is('stock_adjustment') ? 'active' : '' }} ">
                    <a href="{{route('stock_adjustment')}}"><i class="fa fa-angle-right"></i> Stock Adjustment</a></li>
                <li class=" {{ Request::is('stock_damage') ? 'active' : '' }} ">
                    <a href="{{route('stock_damage')}}"><i class="fa fa-angle-right"></i> Damage Stock</a></li>
            </ul>
            </li> --}}

            {{-- Contacts --}}
            {{-- <li class="dropdown {{ Request::is('suppliers')|| Request::is('add_supplier') || Request::is('customers') ? 'active' : '' }}">
            <a href="#"><i class="fa fa-address-book"></i> <span> Contacts</span> <span class="menu-arrow"></span></a>
            <ul
                style=" {{ Request::is('suppliers') || Request::is('add_supplier') || Request::is('customers') ? 'display:block;' : '' }}">
                <li class="{{ Request::is('suppliers') || Request::is('add_supplier') ? 'active' : '' }}">
                    <a href="{{route("suppliers")}}">
                        <i class="fa fa-angle-right"></i>
                        Suppliers</a></li>

                <li class="dropdown {{ Request::is('customers') ? 'active' : '' }}">
                    <a href="">
                        <i class="fa fa-angle-right"></i>
                        Customers</a></li>

                <li><a href="#">
                        <i class="fa fa-angle-right"></i>
                        Customer Groups</a></li>

                <li><a href="#">
                        <i class="fa fa-angle-right"></i>
                        Import Contacts</a></li>
            </ul>
            </li> --}}

            {{-- Transactions --}}
            {{-- <li>
                    <a href="#"><i class="fa fa-barcode"></i> <span>Transactions</span>
                        <span class="menu-arrow"></span></a>
                    <ul style="">
                        <li class="">
                            <a href="{{route("stock_OP")}}">
            <i class="fa fa-angle-right"></i>Open Stock
            </li></a>
            <li class="">
                <a href="{{route("transactions_GRN")}}">
                    <i class="fa fa-angle-right"></i>GRN
            </li></a>
            </ul>
            </li> --}}

            {{-- Products --}}
            {{-- <li class="dropdown {{ Request::is('products*') ? 'active' : '' }}">
            <a href="#"><i class="fa fa-shopping-basket"></i> <span> Products</span> <span
                    class="menu-arrow"></span></a>
            <ul style="{{ Request::is('products*') ? 'display:block;' : '' }}">
                <li><a href="#">
                        <i class="fa fa-angle-right"></i>
                        List Products</a></li>
                <li class="{{ Request::is('products_add') ? 'active' : '' }}">
                    <a href="{{route("products_add")}}">
                        <i class="fa fa-angle-right"></i>
                        Add Product</a></li>
                <li><a href="#">
                        <i class="fa fa-angle-right"></i>
                        Print Lables</a></li>
                <li><a href="#">
                        <i class="fa fa-angle-right"></i>
                        Variations</a></li>
                <li><a href="#">
                        <i class="fa fa-angle-right"></i>
                        Import Products</a></li>

                <li><a href="#">
                        <i class="fa fa-angle-right"></i>
                        Import Opening Stock</a></li>
                <li><a href="#">
                        <i class="fa fa-angle-right"></i>
                        Selling Price Group</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i>Units</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i>Categories</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i>Brands</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i>Warranties</a></li>
            </ul>
            </li> --}}

            {{-- Repair --}}
            {{-- <li>
                    <a href="#"><i class="fa fa-wrench"></i> <span>Repair</span></a>
                </li> --}}

            {{-- Purchases --}}
            {{-- <li class="dropdown {{ Request::is('purchases*') ? 'active' : '' }} ">
            <a href="#"><i class="fa fa-arrow-down"></i> <span> Purchases</span> <span class="menu-arrow"></span></a>
            <ul style="{{ Request::is('purchases*') ? 'display:block;' : '' }}">
                <li><a href="#"><i class="fa fa-angle-right"></i>List Purchases</a></li>
                <li class=" {{ Request::is('purchases_addPurchases') ? 'active' : '' }}">
                    <a href="{{route('purchases_addPurchases')}}"><i class="fa fa-angle-right"></i>Add Purchases</a>
                </li>
                <li><a href="#"><i class="fa fa-angle-right"></i>List Purchases Return</a></li>

            </ul>
            </li> --}}

            {{-- Sell --}}
            {{-- <li class="dropdown {{ Request::is('sales*') ? 'active' : '' }}">
            <a href="#"><i class="fa fa-arrow-up"></i> <span> Sell</span> <span class="menu-arrow"></span></a>
            <ul style="{{ Request::is('sales*') ? 'display:block;' : '' }}">
                <li><a href="#"><i class="fa fa-angle-right"></i>All sales</a></li>
                <li class=" {{ Request::is('sales_add') ? 'active' : '' }}">
                    <a href="{{route('sales_add')}}"><i class="fa fa-angle-right"></i>Add sale</a>
                </li>
                <li><a href="#"><i class="fa fa-angle-right"></i>List POS</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i>POS</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i>Add Draft</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i>List Draft</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i>Add Quotation</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i>List Quotation</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i>List Sell Return</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i>Shipments</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i>Discounts</a></li>
                <li><a href="#"><i class="fa fa-angle-right"></i>Import Sales</a></li>

            </ul>
            </li> --}}

            {{-- Stock Transfers --}}
            {{-- <li class="dropdown ">
                    <a href="#"><i class="fa fa-bus"></i> <span> Stock Transfers</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="#"><i class="fa fa-angle-right"></i>List Stock Transfers</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i>Add Stock Transfers</a></li>

                    </ul>
                </li> --}}

            {{-- Stock Adjustment --}}
            {{-- <li class="dropdown ">
                    <a href="#">
                        <i class="fa fa-cogs"></i> <span> Stock Adjustment</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="#"><i class="fa fa-angle-right"></i>List Stock Adjustment</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i>Add Stock Adjustment</a></li>
                    </ul>
                </li> --}}

            {{-- Payment Accounts --}}
            {{-- <li class="dropdown ">
                    <a href="#"><i class="fa fa-credit-card"></i> <span> Payment Accounts</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="#"><i class="fa fa-angle-right"></i>List Accounts</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i>Balance Sheet</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i>Trial Balance</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i>Cash Flow</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i>Payment Account Report</a></li>
                    </ul>
                </li> --}}

            {{-- kitchen section --}}
            {{-- <li>
                    <a href="#"><i class="fa fa-fire"></i> <span>Kitchen</span></a>
                </li> --}}

            {{-- settings section --}}
            {{-- <li class="dropdown ">
                    <a href="#"><i class="fa fa-wrench"></i> <span> Settings</span> <span
                            class="menu-arrow"></span></a>
                    <ul>
                        <li><a href="#"><i class="fa fa-angle-right"></i>  Business Settings</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i>  Business Locations</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i>  Invoice Settings</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i>  Barcode Settings</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i>  Receipt Printers</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i>  Tax Rates</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i>  Tables</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i>  Modifiers</a></li>
                        <li><a href="#"><i class="fa fa-angle-right"></i>  Types of service</a></li>
                    </ul>
                </li> --}}


        </ul>
    {{-- </div> --}}

</div>
</div>


    </div>
</div>
</div>
@yield('content')

