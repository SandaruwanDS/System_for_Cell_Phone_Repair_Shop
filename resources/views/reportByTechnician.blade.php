@if($recipts->count() > 0)
<h2>Technician Report</h2>
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

<script>
    // Select wrong element
    // Error as #demo is the `div` element
    $('#t_item_movements').DataTable()

    // Selector too broad.
    // Error as `.display` is applied to both the div and the table
    $('.display').DataTable();
</script>

<title>Technician Report</title>
<style>
    table{
        border-collapse: collapse;
        width: 100%;
    }
    th,td{
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
<form action="" method="get">
    <label for="from_date">From Date:</label>
    <input type="date" name="from_date" id="from_date">

    <label for="to_date">To Date:</label>
    <input type="date" name="to_date" id="to_date">

    <label for="technician">Technician:</label>
    <select class="select form-control" id="technician" name="technician" aria-hidden="true">
        <option value="">Select an item</option>
        @foreach( $technicians as $data)
        <option value="{{ $data->Name }}">
            {{ $data->Name}}</option>
        @endforeach
    </select>

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

                <h2 style="text-align:center;"><b>Technician Report</b></h2><hr/>
            </div>


        <table class="styled-table" class="display" id="t_item_movements" style="background-color: transparent; border:1px solid rgb(7, 7, 7); margin-top:15px;">

            @if($recipts!=null)
            <caption style="font-size: 18px; font-weight: bold;">
                Technician Report &nbsp;&nbsp;&nbsp;&nbsp;From: {{$fromDate}}&nbsp;&nbsp;To: {{$toDate}}
            <caption>
            @endif

            <tr class="styled-table">
                    <th>Job_No</th>
                    <th>IMEI No</th>
                    <th>Date</th>
                    <th>Model</th>
                    <th>Brand</th>
                    <th>Problem</th>
                    <th>Solution</th>
                    <th>Amount</th>
                    <!--<th>Status</th>-->

                </tr>
            <tbody>
            @foreach ( $recipts as $key=>$recipts)
                <tr>

                    <td>{{$recipts->Job_no }}</td>
                    <td>{{$recipts->IMEI_Number }}</td>
                    <td>{{$recipts->Delivery_date }}</td>
                    <td>{{$recipts->Device_Model }}</td>
                    <td>{{$recipts->Brand }}</td>
                    <td>{{$recipts->Problem }}</td>
                    <td>{{$recipts->Item_description}}</td>
                    <td>{{$recipts->Amount }}</td>
                    <!--<td>{{$recipts->Status }}</td>-->

                </tr>
            @endforeach
            </tbody>
            <tfoot>
                <tr>
                    <td colspan="2"><b>Total Number Of Jobs :
                        @if($recipts!=null)
                        {{$jobCount}}
                        @endif
                    </b></td>
                    <td colspan="5" style="text-align: right;"><b>Total :</b></td>
                    <td><b>{{$totalAmount}}</b></td>
                    
                </tr>
            </tfoot>

        </table>

    </div>
</div>

        </div>
    </div>
</div>

</body>




<script>
jQuery(document).ready(function($) {
    $('#t_item_movements').DataTable( //database table name
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
    function validateForm() {
        var fromDate = document.getElementById('from_date').value;
        var toDate = document.getElementById('to_date').value;
        var technician = document.getElementById('technician').value;

        // Add your validation logic here
        if (fromDate === '' || toDate === '' || technician === '') {
            alert('Please fill in all required fields.');
            return false; // Prevent form submission
        }

        // If validation passes, you can submit the form
        return true;
    }
</script>



<script>
    function printTablefun()
    {

       var divToPrint=document.getElementById("t_item_movements");
       newWin= window.open("");
       newWin.document.write(divToPrint.outerHTML);
       newWin.print();
       newWin.close();
    }

    function printtbodyfun()
    {
       var divToPrint=document.getElementById("t_item_movements");
       newWin= window.open("");
       newWin.document.write(divToPrint.outerHTML);
       newWin.print();
       newWin.close();
    }
    </script>





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

</html>
