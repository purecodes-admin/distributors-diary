<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- fonts --}}

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;700&display=swap" rel="stylesheet">

    {{-- tailwind css --}}
    <link rel="stylesheet" type="text/css" href="/css/app.css">


    <title>Document</title>

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

    </style>
</head>

<body>
    <h1 style="color:blue; text-align:center">Bill Invoice</h1><br><br>
    <div>
        <div>
            <h3 style="color:blue">Company: Peshawar Distribution System</h3>
            <h4 style="color:blue">Address: Spinzer IT Plaza, Abdara Road Peshawar.</h4>
            <h5 style="color:blue">Website: www.peshawardistribution.com</h5>
        </div>
        <div>
            <h3 style="color:blue">Invoice</h3>
            <table style="border: 1px solid #ddd; border-collapse: collapse;">
                <tr>
                    {{-- <th style="border: 1px solid #ddd; color:blue; padding:2px;">User Name</th> --}}
                    <th style="border: 1px solid #ddd; color:white; padding:2px; background:blue; padding:2px;">Bill
                    </th>
                    <th style="border: 1px solid #ddd; color:white; padding:2px; background:blue; padding:2px;">Date
                    </th>
                    <th style="border: 1px solid #ddd; color:white; padding:2px; background:blue; padding:2px;">Due Date
                    </th>
                </tr>
                @foreach ($data as $user)
                    <tr>
                        {{-- <td style="border: 1px solid #ddd; color:gray; padding:2px;">{{ $user->user->name }}</td> --}}
                        <td style="border: 1px solid #ddd; color:gray; padding:2px;">{{ $user->payment }}</td>
                        <td style="border: 1px solid #ddd; color:gray; padding:2px;">{{ date('d/m/y') }}</td>
                        <td style="border: 1px solid #ddd; color:gray; padding:2px;">1-04-2021</td>
                    </tr>
                @endforeach
            </table>
            <br><br><br>

            <button
                style="color:white; background:blue; padding-left: 200px; padding-right: 200px;border:none; border-radius:2px;">Bill
                To:</button>
            <table style="border: 1px solid #ddd; border-collapse: collapse;">
                <tr>
                    <th style="border: 1px solid #ddd; color:white; padding:2px; background:blue; padding:2px;">Name
                    </th>
                    <th style="border: 1px solid #ddd; color:white; padding:2px; background:blue; padding:2px;">Email
                    </th>
                    <th style="border: 1px solid #ddd; color:white; padding:2px; background:blue; padding:2px;">Phone
                    </th>
                </tr>
                @foreach ($data as $user)
                    <tr>
                        <td style="border: 1px solid #ddd; color:gray; padding:2px;">{{ $user->user->name }}</td>
                        <td style="border: 1px solid #ddd; color:gray; padding:2px;">{{ $user->user->email }}</td>
                        <td style="border: 1px solid #ddd; color:gray; padding:2px;">{{ $user->user->contact }}</td>
                    </tr>
                @endforeach
            </table><br>
            <br>
            <br>
            <br>



            <table style="border: 1px solid #ddd; border-collapse: collapse; width:100%;">
                <tr>
                    <th style="border: 1px solid #ddd; color:white; padding:2px; background:blue;">Discription</th>
                    <th style="border: 1px solid #ddd; color:white; padding:2px; background:blue;">Tax</th>
                    <th style="border: 1px solid #ddd; color:white; padding:2px; background:blue;">Amount</th>
                </tr>
                @foreach ($data as $user)
                    <tr>
                        <td style="border: 1px solid #ddd; color:gray; padding:2px;">You are Using This Software So this
                            is your Monthly Bill Invoice.</td>
                        <td style="border: 1px solid #ddd; color:gray; padding:2px;">0</td>
                        <td style="border: 1px solid #ddd; color:gray; padding:2px;">{{ $user->payment }}</td>
                    </tr>
                @endforeach
            </table>




        </div>
    </div>

</body>

</html>
