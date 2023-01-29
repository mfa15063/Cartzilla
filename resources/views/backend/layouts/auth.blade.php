<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="backend/assets/images/favicon-32x32.png" type="image/png"/>
    <!--plugins-->
    <link href="{{asset(env('PUBLIC_PATH' , '').'backend/assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet"/>
    <link href="{{asset(env('PUBLIC_PATH' , '').'backend/assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet')}}"/>
    <!-- loader-->
    <link href="{{asset(env('PUBLIC_PATH' , '').'backend/assets/css/pace.min.css" rel="stylesheet')}}"/>
    <script src="{{asset(env('PUBLIC_PATH' , '').'backend/assets/js/pace.min.js')}}"></script>
    <!-- Bootstrap CSS -->
    <link href="{{asset(env('PUBLIC_PATH' , '').'backend/assets/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="{{asset(env('PUBLIC_PATH' , '').'backend/assets/css/app.css')}}" rel="stylesheet">
    <link href="{{asset(env('PUBLIC_PATH' , '').'backend/assets/css/icons.css')}}" rel="stylesheet">
    <title>{{env('APP_NAME')}}-@stack('title')</title>
    @yield('styles')
</head>
<body class="bg-login">
@yield('content')


@yield('scripts')
</body>
</html>
