<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Recipts</title>

    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            border: 1px solid rgb(8, 8, 8);
            padding: 5px;
        }

        .styled-table {
            border-collapse: collapse;
            margin: 25px 0;
            font-size: 0.9em;
            font-family: sans-serif;
            min-width: 400px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .styled-table thead tr {
            background-color: #009879;
            color: #ffffff;
            text-align: left;
        }

        .styled-table th,
        .styled-table td {
            padding: 12px 15px;
        }

        .styled-table tbody tr {
            border-bottom: 1px solid #dddddd;
        }

        .styled-table tbody tr:nth-of-type(even) {
            background-color: #f3f3f3;
        }

        .styled-table tbody tr:last-of-type {
            border-bottom: 2px solid #009879;
        }


    </style>
</head>

<body>
    {{-- <div class="card shadow p-3 mb-3 bg-body-tertiary rounded" > --}}
    <div class="d-flex justify-content-center profile-container">
        <div class='col-md-6 text-center sort-profile' id='sort-profile'>
            <div class='row'>
                <div class='col-md-6 text-center'><br />
                    @if ($errors->any())
                    <div class="alert alert-danger text-center" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                            <ul>{{ $error }}</ul>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    <div styel="background-color: yellow;">
                        <h2 style="text-align:center;"><b>STOCK REPORT</b></h2>
                        <hr/>
                        <div style="display: flex; text-align: center;">
                            <div style="flex: 20%;">
                                <Button  class="d-inline p-2 text-bg-primary"><a href="{{route("home")}}"> Back</a></Button>
                            </div>
                            <div style="flex: 60%; align-content: center;">
                                <form action="{{route("filter_stock_by_date")}}" method="GET">
                                    @csrf
                                    <label for="date">Date :</label>
                                    <input type="date" name="date" id="date">
                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                    <button type="submit" id="submit_1">Submit</button>
                                </form>
                            </div>
                            <div style="flex: 20%; align-content: center;">
                                <button onclick="printTablefun()">Print</button>
                            </div>
                        </div>


                    <table class="styled-table" class="display" id="t_item_movements" style="background-color: transparent; border:1px solid rgb(7, 7, 7); margin-top:15px;width:40%;text-align: center; margin-left: auto;
        margin-right: auto;">
                        <tr class="styled-table">
                            {{-- <th>Date</th> --}}
                            <th style="width:10%">ITEM CODE</th>
                            <th style="width:30%">ITEM NAME</th>
                            <th style="width:30%">QUANTITY</th>
                        </tr>
                        <tbody>
                            @foreach ( $stockDetails as $key=>$stockDetails)
                            <tr>
                                {{-- <td>{{$stockDetails->dDate}}</td> --}}
                                <td>{{$stockDetails->Item_code}}</td>
                                <td>{{$stockDetails->Item_description}}</td>
                                <td>{{$stockDetails->total_qun_in - $stockDetails->total_qun_out }}</td>
                                @endforeach
                            </tr>
                        </tbody>

                        <tfoot>
                            <tr>
                                <td></td>
                                <td><b> Total Balance</td>
                                <td><b>{{$balance}}</td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
    </div>

</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.25/css/jquery.dataTables.css">

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>
<script type="text/javascript" charset="utf8"
    src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js">
</script>
<script type="text/javascript" charset="utf8"
    src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js">
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js">
</script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js">
</script>

{{-- form default date set for today --}}
<script>
    document.getElementById('date').valueAsDate = new Date();
</script>

{{-- CSRF token script --}}
<script type="text/javascript">
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>
    // Select wrong element
    // Error as #demo is the `div` element
    $('#DB').DataTable()
    // Selector too broad.
    // Error as `.display` is applied to both the div and the table
    $('.display').DataTable();
</script>
<script>
    jQuery(document).ready(function ($) {
        $('#DB').DataTable( //database table name
            {
                dom: 'Bfrtip',
                buttons: [
                    'copy',
                    'excel',
                    'csv',
                    'pdf',


                ],
            }
        );

    });

</script>

<script>
    function printTablefun() {

        var divToPrint = document.getElementById("t_item_movements");
        newWin = window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
    }

    function printtbodyfun() {
        var divToPrint = document.getElementById("t_item_movements");
        newWin = window.open("");
        newWin.document.write(divToPrint.outerHTML);
        newWin.print();
        newWin.close();
    }

</script>


</html>
