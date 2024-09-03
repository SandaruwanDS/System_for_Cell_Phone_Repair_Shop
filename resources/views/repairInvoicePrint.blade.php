<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>invoice</title>


    <!-- Favicon -->
    {{-- <link rel="icon" href="./images/favicon.png" type="image/x-icon" /> --}}

    <!-- Invoice styling -->
    <style>
        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        a {
            color: #5D6975;
            text-decoration: underline;
        }

        body {
            position: relative;
            width: 17cm;
            height: 29.7cm;

            margin: 0 auto;
            color: #001028;
            background: #FFFFFF;
            font-family: Arial, sans-serif;
            font-size: 16px;
            font-family: Arial;
        }

        .subhead {
            font-size: 17px;
        }

        header {
            padding: 10px 0;
            margin-bottom: 10px;
        }

        #logo {
            text-align: center;
            margin-bottom: 10px;
        }

        #logo img {
            width: 90px;
        }

        .border {
            border-top: 1px solid #5e6163;
            border-bottom: 1px solid #5e6163;
            text-align: center;
            color: #5e6163;
            margin: 0 0 20px 0;
            line-height: 1.4em;
        }

        h1 {

            color: #5e6163;
            font-size: 2.5em;
            margin-bottom: 5px;
            font-weight: normal;
            text-align: center;

            /* background: url(assets/pdf/dimension.png); */
        }

        #project {
            float: left;
        }

        #project span {
            /* color: #2f3030; */
            text-align: left;
            width: 60px;
            margin-right: 10px;
            display: inline-block;
            font-size: 16px;
        }

        #company {
            float: right;
            text-align: left;
        }

        #project div,
        #company div {
            white-space: nowrap;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            border-spacing: 0;
            margin-bottom: 20px;

        }

        table tr:nth-child(2n-1) td {
            background: #F5F5F5;
        }

        table th,
        table td {
            text-align: center;
        }

        table th {
            padding: 5px 20px;
            color: #5D6975;
            border-bottom: 1px solid #C1CED9;
            white-space: nowrap;
            font-weight: normal;
        }

        table .service,
        table .desc {
            text-align: left;
        }

        table td {
            padding: 5px;
            text-align: left;
        }

        table td.service,
        table td.desc {
            vertical-align: top;
        }

        table td.unit,
        table td.total {
            font-size: 1.2em;
        }

        .qty {
            font-size: 1.1em;
        }

        table td.grand {
            border-top: 1px solid #494d52;
            border-bottom: 1px solid #494d52;
            ;
        }

        #notices .notice {
            color: #5D6975;
            font-size: 1.1em;
        }

        footer {
            color: #5D6975;
            width: 100%;
            height: 30px;
            position: absolute;
            bottom: 0;
            border-top: 1px solid #C1CED9;
            padding: 8px 0;
            text-align: center;
        }

    </style>


    <style>
        /* body {
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            text-align: center;
            color: #777;
        } */

        body h1 {
            font-weight: 300;
            margin-bottom: 0px;
            padding-bottom: 0px;
            color: #000;
        }

        body h3 {
            font-weight: 300;
            margin-top: 10px;
            margin-bottom: 20px;
            font-style: italic;
            color: #555;
        }

        body a {
            color: #06f;
        }

        .invoice-box {
            max-width: 800px;
            margin: auto;
            padding: 10px;
            border: 1px solid #eee;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.15);
            font-size: 16px;
            line-height: 24px;
            font-family: 'Helvetica Neue', 'Helvetica', Helvetica, Arial, sans-serif;
            color: #555;
        }

        .tr_details {
            max-width: 800px;
            border-bottom: none;
            line-height: 1px;
            color: #222121;
        }

        .invoice-box table {
            width: 100%;
            line-height: inherit;
            text-align: left;
            border-collapse: collapse;
        }

        .invoice-box table td {
            padding: 5px;
            vertical-align: top;
        }


        .invoice-box table tr.top table td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.top table td.title {
            font-size: 45px;
            line-height: 45px;
            color: #333;
        }

        .invoice-box table tr.information table td {
            padding-bottom: 40px;
        }

        .invoice-box table tr.heading td {
            background: #eee;
            border-bottom: 1px solid #ddd;
            font-weight: bold;
        }

        .invoice-box table tr.details td {
            padding-bottom: 20px;
        }

        .invoice-box table tr.item td {
            border-bottom: 1px solid #eee;
        }

        .invoice-box table tr.item.last td {
            border-bottom: none;
        }

        .invoice-box table tr.total td:nth-child(2) {
            border-top: 2px solid #eee;
            font-weight: bold;
        }

        @media only screen and (max-width: 600px) {
            .invoice-box table tr.top table td {
                width: 100%;
                display: block;
                text-align: center;
            }

            .invoice-box table tr.information table td {
                width: 100%;
                display: block;
                text-align: center;
            }
        }

    </style>

</head>

<body>
    <header class="clearfix">
        {{-- <div id="logo">
            <img src=" {{'data:image/png;base64,'.base64_encode(file_get_contents(public_path('assets/pdf/logo.png')))}}
        " alt="logo" style="width: 30px; height: 30px">
        </div> --}}

        <div class="border">
            @foreach ($companyData as $comData)
            <h1>{{ $comData->name}}</h1>
            <div class="subhead" style="text-align: center; font-size: 20px; color: #3d3d3d; font-weight: bold;">
                REPAIRING CENTER</div>
            <div class="subhead">Address : {{ $comData->address}}</div>
            <div class="subhead">Phone : {{ $comData->co_number}} , {{ $comData->fax_number}}</div>
            {{-- <div class="subhead">Fax : {{ $comData->co_number}}
        </div> --}}
        <div class="subhead">Email : <a href="mailto:{{ $comData->email}}">{{ $comData->email}}</a></div>
        @endforeach
        <br>
        </div>

        <div id="company" class="clearfix">
            @foreach ($pawnSumData as $sumData)
            <div>Date :&nbsp;{{ $sumData->Invoice_date}}</div>
            <div>Invoice No :&nbsp;{{ $sumData->Invoice_no}}</div>
            <div>Job No :&nbsp;{{ $sumData->Job_no}}</div>

            @endforeach
        </div>

        <div id="project">
            @foreach ($pawnSumData as $sumData)
            <div><span>Name &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;{{ $sumData->Customer_Name}}</span></div>
            <div><span>Tel &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;{{ $sumData->Customer_Phone}}</span>
            </div>
            <div><span>Email &nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;</span> <a
                    href="mailto:{{ $sumData->Email}}">{{ $sumData->Email}}</a></div>
            <div><span>Address :&nbsp;{{ $sumData->Address_1}}</span></div>
            <div><span>NIC &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;{{ $sumData->NIC}}</span></div>
            <br>
            <div><span>Brand &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;{{ $sumData->Brand}}</span></div>
            <div><span>Device Model :&nbsp;{{ $sumData->Device_Model}}</span></div>
            <div><span>IMEI No &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;:&nbsp;{{ $sumData->IMEI_Number}}</span></div>
            @endforeach
        </div>
    </header>

    <div class="invoice-box">
        <table>
            <tr class="heading">
                <td>Category</td>
                <td>Code</td>
                <td>Description</td>
                <td>QTY</td>
                <td>Unit Price</td>
                
                @php
                    // Initialize the variable
                    $discount = 0; 
                    $advance = 0;
                @endphp

                @foreach($pawnDetailsData as $DetailsData)
                    // Add the discount to the variable
                    @php
                        $discount += $DetailsData['Discount']; 
                    @endphp
                @endforeach
                
                @foreach($pawnSumData as $sumData)
                    @php
                        $advance += $sumData['Advance']; // Add the discount to the variable
                    @endphp
                @endforeach

                @if ($discount != null)
                <td>Discount</td>
                @else
                <td>&nbsp;</td>
                @endif
                
                <td>Net Value</td>
            </tr>

            @foreach($pawnDetailsData as $DetailsData)
            <tr class="item">
                <td>{{$DetailsData['Item_category']}}</td>
                <td>{{$DetailsData['Item_code']}}</td>
                <td>{{$DetailsData['Item_description']}}</td>
                <td>{{$DetailsData['QTY']}}</td>
                <td>{{$DetailsData['Unit_price']}}</td>
                @if ($discount != null)
                <td>{{$DetailsData['Discount']}}</td>
                @else
                <td>&nbsp;</td>
                @endif
                <td>{{$DetailsData['Net_value']}}</td>

            </tr>
            @endforeach
            
            @if ($advance != null)
                @foreach($pawnSumData as $sumData)
                    <tr class="item">
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td>Advance </td>
                        <td></td>
                        <td>- {{$sumData['Advance']}}</td>
                    </tr>
                @endforeach
            @endif

            <tr class="total">
                <td style="border-top: 2px solid #1a1a1a; border-top-style: solid;"></td>
                <td style="border-top: 2px solid #1a1a1a; border-top-style: solid;"></td>
                <td style="border-top: 2px solid #1a1a1a; border-top-style: solid;"></td>
                <td style="border-top: 2px solid #1a1a1a; border-top-style: solid;"></td>
                <td style="border-top: 2px solid #1a1a1a; border-top-style: solid;"></td>
                <td style="border-top: 2px solid #1a1a1a; border-top-style: solid;"><b>Total :</b></td>
                <td style="border-top: 2px solid #1a1a1a; border-top-style: solid;">
                    <b> @foreach($pawnSumData as $sumData)
                        {{$sumData['Amount']}}
                        @endforeach 
                    </b>
                </td>
            </tr>
        </table>
    </div>
    <br>
    <div class="border">
    <div class="clearfix">THANK YOU & COME AGAIN !</div>
    </div>
</body>

</html>
