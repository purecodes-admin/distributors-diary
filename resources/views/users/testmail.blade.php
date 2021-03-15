<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;400;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
        }

    </style>

    <title>Document</title>
</head>

<body style="background-color: #EDF2F7;">
    <div style="padding:30px; text-align:center;">
        <div
            style="background-color: white; text-align:center; width:80%; padding-bottom:40px; padding-top: 20px; padding-left:10px; padding-right:10px; margin-left:70px; border-radius:20px;">
            <h3 style="color: #3D4852;">Hello! {{ $invoice->distributor->name }}</h3>
            <p style="color:#A982A9;">Your invoice has been generated.</p>
            <p style="color:#A982A9;">Please find attached file for your invoice at your Top Right.</p>
            <p style="color:#A982A9;">Please get in touch if you have any questions.</p>
            <p style="color:#3D4852;">Thank You!</p>
            <p style="color:#A982A9;">Regards,</p>
            <p style="color:#A982A9;">PureCodes</p>
        </div>
    </div>
</body>

</html>
