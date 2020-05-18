<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>FinancePH</title>
        
        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
        
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="http://demo.itsolutionstuff.com/plugin/croppie.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>

         <link rel="stylesheet" href="http://demo.itsolutionstuff.com/plugin/croppie.css">
         <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Nunito', sans-serif;
                font-weight: 200;
                height: 100vh;
                margin: 0;
            }

            
        </style>
    </head>
    <body>
        @include('layouts.header')
        <div class="container">
            @yield('content')
        </div>
        <script src="/js/sweetalert.min.js"></script>
    </body>
    @include('modal.create')
    @include('modal.login')

    
</html>
