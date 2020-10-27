<!DOCTYPE html>
<html lang="en">
<head><meta http-equiv="Content-Type" content="text/html; charset=big5">
    
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token 
    <meta name="csrf-token" content="{{ csrf_token() }}"> -->

    <title>Brema | Gestión</title>

    <!-- Scripts 
    <script src="{{ asset('js/app.js') }}" defer></script> -->

    <!-- Fonts -->
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('css/font-awesome.css')}}">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    {{--<link href="{{elixir('css/app,css')}}" rel="stylesheet">--}}

    <style>
        body{
            font-family:'Lato';
        }

        .fa-btn{
            margin-right:;
        }
        
        .fondo {
            background-attachment: fixed;
            background-position: center center;
            background-size: cover;
            background-image: url('img/portada.jpg');
        }
    </style>
</head>
<body class="fondo">
    <div class="container">
       
            <div class="panel-body">
                <h3>Brema SpA</h3>
            </div>
        
        
        <main class="py-5">
            @yield('content')
        </main>
    </div>
</body>
</html>
