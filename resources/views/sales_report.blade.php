 @if($salesReportDetails->count() > 0)
    <h2>Sales Report</h2>

@else
    <p>No results found.</p>
@endif

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    {{-- <div><button onClick="window.print()">Print --}}

    </button></div>

    <script>
        // Select wrong element
        // Error as #demo is the `div` element
        $('#t_invoice_sums').DataTable()

        // Selector too broad.
        // Error as `.display` is applied to both the div and the table
        $('.display').DataTable();
            </script>
            <title>Recipts</title>
            <style>
                table{
                    border-collapse: collapse;
                    width: 100%;
                }
            th,td{
                border: 1px solid rgb(8, 8, 8);
                padding: 5px;
            }

    </style>

</head>

<body>
    <form action="" method="get">
        <label for="from_date">From Date:</label>
        <input type="date" name="from_date" id="from_date">

        <label for="to_date">To Date:</label>
        <input type="date" name="to_date" id="to_date">

        <button type="submit">Search</button>
        <button onclick="printTablefun()">Print</button>
        <Button ><a href="{{route("home")}}"> Back</a></Button>
    </form>



    {{-- <div class="card shadow p-3 mb-3 bg-body-tertiary rounded" > --}}
        <div class="d-flex justify-content-center profile-container">
            <div class='col-md-6 text-center sort-profile' id='sort-profile'>
            <div class='row'>
            <div class='col-md-6 text-center' ><br/>
                <div styel="background-color: yellow;">

                    <h2 style="text-align:center;"><b>Sales Report</b></h2><hr/>
                </div>


            <table class="display" id="t_invoice_sums" style="background-color: transparent; border:1px solid rgb(7, 7, 7); margin-top:15px;">

                @if($salesReportDetails!=null)
                <caption style="font-size: 18px; font-weight: bold;">
                    Sales Report &nbsp;&nbsp;&nbsp;&nbsp;From: {{$fromDate}}&nbsp;&nbsp;To: {{$toDate}}
                <caption>
                @endif

                <tr class="styled-table">
                        <th>Invoice No</th>
                        <th>Invoice Date</th>
                        <th>Job No</th>
                        <th>IMEI</th>
                        <th>Model</th>
                        <th>Brand</th>
                        <th>Problem</th>
                        <th>Item</th>
                        <th>Category</th>
                        <th>Technician</th>
                        <th>Unit Purchase Price</th>
                        <th>Unit Salese Price</th>
                        <th>Discount</th>
                        <th>Amount</th>
                        <th>Profit</th>
                    </tr>
                <tbody>
                @foreach ( $salesReportDetails as $key=>$details)
                    <tr>

                        <td>{{$details->Invoice_no}}</td>
                        <td>{{$details->Invoice_date}}</td>
                        <td>{{$details->Job_no }}</td>
                        <td>{{$details->IMEI_Number}}</td>
                        <td>{{$details->Device_Model}}</td>
                        <td>{{$details->Brand}}</td>
                        <td>{{$details->Problem}}</td>
                        <td>{{$details->Item_description}}</td>
                        <td>{{$details->category}}</td>
                        <td>{{$details->Technician }}</td>
                        <td>{{$details->purchasePrice }}</td>
                        <td>{{$details->saleprice}}</td>
                        <td>{{$details->Discount }}</td>
                        <td>{{$details->Net_value }}</td>
                        <td>{{$details->Net_value - $details->purchasePrice}}</td>

                    </tr>
                @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="11"><b>Total</b></td>
                        {{--
                        <td><b>{{$totalPurchase}}</b></td> --}}
                        <td><b>{{$totalSales}}</b></td>
                        <td><b>{{$totalDiscount}}</b></td>
                        <td><b>{{$totalNet}}</b></td>
                        <td><b>{{$totalProfit}}</b></td>
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
<script>
    jQuery(document).ready(function($) {
        $('#t_invoice_sums').DataTable( //database table name
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
        function printTablefun()
        {

           var divToPrint=document.getElementById("t_invoice_sums");
           newWin= window.open("");
           newWin.document.write(divToPrint.outerHTML);
           newWin.print();
           newWin.close();
        }

        function printtbodyfun()
        {
           var divToPrint=document.getElementById("t_invoice_sums");
           newWin= window.open("");
           newWin.document.write(divToPrint.outerHTML);
           newWin.print();
           newWin.close();
        }
        </script>


</html>
