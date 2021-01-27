<!DOCTYPE html>
<html>
<head>
              <meta charset="utf-8">
              <meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Template</title>
              <link rel="stylesheet" type="text/css" href="/css/app.css">


        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">


        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        
          <style>
                  body {
                      font-family: 'Nunito';
                  }
          </style>
</head>
<body class="bg-gray-100 dark:bg-gray-900">
    <div>
     </div>
       
       @include('layout.logo')
            @yield('content')
    
</body>
</html>