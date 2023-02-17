<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Cuadito | Invoice</title>
        <style>
            body {
                font-family: Arial, Helvetica, sans-serif;
                font-size: 12px;
                font-weight: normal;
            }

            table {
                border-collapse: collapse;
            }

            th, td {
                border: 1px solid black;
                padding: 3px;
            }

            @page {
                margin: 100px 25px;
            }

            /* header {
                position: fixed;
                top: -80px;
                left: 0px;
                right: 0px;
                height: 50px;
                text-align: center;
                font-weight: bold;
            } */

            .column {
                float: left;
                width: 50%;
            }

            /* Clear floats after the columns */
            .row:after {
                content: "";
                display: table;
                clear: both;
            }

            table.customTable {
                width: 100%;
                background-color: #FFFFFF;
                border-collapse: collapse;
                border-width: 2px;
                border-color: orange;
                border-style: solid;
                color: #000000;
                text-align: center
            }
            
            table.customTable td, table.customTable th {
                border-width: 2px;
                border-color: orange;
                border-style: solid;
                padding: 5px;
            }
            
            table.customTable thead {
                background-color: orange;
            }

            table.detailsTable {
                width: 100%;
                background-color: #FFFFFF;
                border-collapse: collapse;
                border-width: 2px;
                border-color: #7EA8F8;
                border-style: solid;
                color: #000000;
            }
            
            table.detailsTable td, table.detailsTable th {
                border-width: 2px;
                border-color: #7EA8F8;
                border-style: solid;
                padding: 5px;
            }
            
            table.detailsTable thead {
                background-color: #7EA8F8;
            }
        </style>
    </head>
    <body>
        <header>
            <h1>{{ $payment->invoice_id }} / {{ $payment->created_at->format('Y-m-d') }}</h1>
            <p>Invoice has been paid at {{ $payment->paid_at?->format('Y-m-d') }}</p>
        </header>

    
    <!-- HTML Code: Place this code in the document's body (between the <body> tags) where the table should appear -->
        <table class="detailsTable">
        <thead>
            <tr>
            <th colspan="2" style="text-align: left;">Transaction Details</th>
            
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Payment Date</td>
                <td>{{ $payment->created_at->format('Y-m-d') }}</td>
            </tr>
            <tr>
                <td>Invoice #</td>
                <td>{{ $payment->invoice_id }}</td>
            </tr>
            <tr>
                <td>Plan</td>
                <td>{{ $plan->name }} Plan</td>
            </tr>
            
        </tbody>
        </table>

        <table class="detailsTable" style="margin-top: 20px;">
            <thead>
                <tr>
                    <th colspan="2" style="text-align: left;">Seller Information</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Company</td>
                    <td>1mcdigital.ph</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>20 Derby, Manila, Metro Manila</td>
                </tr>
                <tr>
                    <td>Country</td>
                    <td>Philippines</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>inquiries@1mcdigital.ph</td>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td>+639473299876</td>
                </tr>
            </tbody>
        </table>

        <table class="detailsTable" style="margin-top: 20px;">
            <thead>
                <tr>
                    <th colspan="2" style="text-align: left;">Buyer Information</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Name</td>
                    <td>{{ $client->name }}</td>
                </tr>
                <tr>
                    <td>Address</td>
                    <td>{{ $client->address }}</td>
                </tr>
                <tr>
                    <td>Email</td>
                    <td>{{ $client->email }}</td>
                </tr>
                <tr>
                    <td>Phone Number</td>
                    <td>{{ $client->contact_number }}</td>
                </tr>
            </tbody>
        </table>

    
    <!-- HTML Code: Place this code in the document's body (between the <body> tags) where the table should appear -->
        <table class="customTable" style="margin-top: 20px;">
        <thead>
            <tr>
                <th>#</th>
                <th>Product</th>
                <th>Quantity (Period)</th>
                <th>Unit Price</th>
                <th>Discount(%)</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>{{ $plan->name }}</td>
                <td>1 month</td>
                <td>Php {{$payment->amount}}</td>
                <td>Php 0</td>
                <td>Php {{$payment->total_amount}}</td>
            </tr>
            <tr>
                <td colspan="5" style="text-align: right">VAT(%)</td>
                <td>Php 0</td>
            </tr>

            <tr>
                <td colspan="5" style="text-align: right">TOTAL</td>
                <td>Php {{ $payment->total_amount }}</td>
            </tr>
        </tbody>
        </table>
        <!-- Generated at CSSPortal.com -->


        <script type="text/php">
            if (isset($pdf)) {
                $text = "page {PAGE_NUM} of {PAGE_COUNT}";
                $size = 8;
                $font = $fontMetrics->getFont("Arial");
                $width = $fontMetrics->get_text_width($text, $font, $size) / 2;
                $x = ($pdf->get_width() - $width);
                $y = $pdf->get_height() - 25;
                $pdf->page_text($x, $y, $text, $font, $size);
            }
        </script>
    </body>
</html>
