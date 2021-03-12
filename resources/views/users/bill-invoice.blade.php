<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- fonts --}}

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;700&display=swap" rel="stylesheet">


    <title>Document</title>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

    </style>
</head>

<body style="font-size:12px; padding-top:5px; padding-bottom:20px; padding-left:30px; padding-right:30px;">

    <div>
        <table style="width:100%;">
            <tr>
                <td>
                    <h2 style=" color:#3B4E87; font-weight:normal;">Company:{{ config('app.name') }} </h2>
                </td>
                <td>
                    <h1 style="color:#7A8DC5; ">INVOICE</h1>
                </td>

            </tr>
            <tr>
                <td style="color:#000000">Address: {{ config('app.address') }}</td>
                <td style="font-weight:bold;">
                    DATE:
                    <span
                        style="margin-left:50px; padding-left:6px; padding-right:6px; border: 1px solid #ddd; color:gray;">
                        {{ date('d/m/y') }} </span>
                </td>
            </tr>


            <tr>
                <td style="color:#000000">Website: {{ config('app.url') }} </td>

                <td style="  font-weight:bold;">
                    INVOICE#: <span
                        style="margin-left:26px; padding-left:6px; padding-right:6px; border: 1px solid #ddd; color:gray;">[123456]</span>
                </td>
            </tr>
            <tr>
                <td style="color:#000000">Phone: [{{ config('app.phone') }}]</td>

                <td style="font-weight:bold;">CUSTOMER ID:<span
                        style="margin-left:6px; padding-left:6px; padding-right:6px; border: 1px solid #ddd; color:gray;">
                        {{ $data->id }}</span></td>
            </tr>
            <tr>
                <td style="color:#000000">Fax: [{{ config('app.fax') }}]</td>

                <td style="font-weight:bold;">DUE DATE:
                    <span
                        style="margin-left:26px; padding-left:6px; padding-right:6px; border: 1px solid #ddd; color:gray;">1-04-2021</span>
                </td>
            </tr>

        </table><br><br><br>



        <div
            style="color:white; background:#3B4E87; padding-left:3px; padding-top:5px; padding-bottom:5px; font-weight:bold; font-size:14px; text-align:left; width:30%;">
            Bill
            To:</div>
        <table>
            <tr>
                <td style=" color:#000000; padding:3px;">{{ $data->name }}</td>
            </tr>
            <tr>
                <td style=" color:#000000; padding:3px;">{{ $data->email }}</td>
            </tr>
            <tr>
                <td style=" color:#000000; padding:3px;">{{ $data->contact }}
                </td>
            </tr>
        </table><br><br> <br><br>



        <table style="border: 1px solid #0000; border-collapse: collapse; width:100%; margin-bottom:40px;">
            <tr>
                <th style="border: 1px solid #ddd; color:white; padding:2px; background:#3B4E87;">Discription
                </th>
                <th style="border: 1px solid #ddd; color:white; padding:2px; background:#3B4E87;">Tax</th>
                <th style="border: 1px solid #ddd; color:white; padding:2px; background:#3B4E87;">Amount</th>
            </tr>
            <tr>
                <td style="border: 1px solid #ddd; color:#000000; padding:2px;">You are Using This Software So
                    this
                    is your Monthly Bill Invoice.</td>
                <td style="border: 1px solid #ddd; color:#000000; padding:2px; text-align:right;">0</td>
                <td style="border: 1px solid #ddd; color:#000000; padding:2px; text-align:right;">
                    {{ $data->payment }}
                </td>
            </tr>
            <tr>
                <td style="border: 1px solid #ddd; color:gray; padding:10px;"></td>
                <td style="border: 1px solid #ddd; color:gray; padding:10px;"></td>
                <td style="border: 1px solid #ddd; color:gray; padding:10px;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid #ddd; color:gray; padding:10px;"></td>
                <td style="border: 1px solid #ddd; color:gray; padding:10px;"></td>
                <td style="border: 1px solid #ddd; color:gray; padding:10px;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid #ddd; color:gray; padding:10px;"></td>
                <td style="border: 1px solid #ddd; color:gray; padding:10px;"></td>
                <td style="border: 1px solid #ddd; color:gray; padding:10px;"></td>
            </tr>
            <tr>
                <td style="border: 1px solid #ddd; color:gray; padding:10px;"></td>
                <td style="border: 1px solid #ddd; color:gray; padding:10px;"></td>
                <td style="border: 1px solid #ddd; color:gray; padding:10px;"></td>
            </tr>
        </table>




        <table style="width:100%; margin-bottom:20px;">
            <tr>
                <td></td>
                <td style="text-align: right; font-weight:bold;">Sub
                    Total:<span
                        style="margin-left:50px; padding-left:6px; padding-right:6px color:gray;">{{ $data->payment }}</span>
                </td>
            </tr>
            <tr>
                <td></td>
                <td style="text-align: right; font-weight:bold;">Taxable:<span
                        style="margin-left:69px; padding-left:6px; padding-right:6px color:gray;">
                        0 </span></td>
            </tr>
            <tr>
                <td>
                </td>
                <td style="text-align: right; font-weight:bold;">TOTAL:<span
                        style="margin-left:47px; padding-left:6px; padding-right:6px color:gray; border:1px solid black;">
                        {{ $data->payment }} </span> </td>
            </tr>
        </table>


        <div
            style="padding-bottom:60px; border: 1px solid #ddd; border-collapse: collapse; width:50%; margin-bottom:20px;">
            <div style="border: 1px solid #ddd; color:white; padding:2px; background:#3B4E87;">Other Comments
            </div>

            <p style=" color:#000000; padding:1px; margin-left:2px;">1. Total payment due in 30 days.
            </p>

            <p style="color:#000000; padding:1px; margin-left:2px;">2. Please include the invoice number
                in you check.
            </p>
        </div>

        <p style="font-weight: normal; text-align:center">If you have any questions about this invoice, please
            contact
            <br>
            [{{ config('app.phone') }}, {{ config('mail.from.address') }}]
        </p>
        <h4 style="text-align:center">Thanks You! For Your Bussiness!</h4>

    </div>

</body>

</html>
