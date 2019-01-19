<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="stylesheet" href="{{ asset('css/resources.css') }}">
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
    <!-- Latest compiled and minified CSS -->
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    
    <link rel="stylesheet" href="{{ asset('adminLTE/font-awesome/css/font-awesome.min.css') }}">    
    <link rel="stylesheet" href="{{ asset('adminLTE/Ionicons/css/ionicons.min.css') }}">
    <link rel="stylesheet" href="{{ asset('adminLTE/css/AdminLTE.min.css') }}">    
    <link rel="stylesheet" href="{{ asset('adminLTE/css/skins/skin-blue.min.css') }}"> --}}


    {{-- <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic"> --}}


</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('partials.header')
        @include('partials.sidebar')

        <div class="content-wrapper">
            @if (session()->has('success'))
                <div class="alert alert-success alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session()->get('success') }}
                </div>   
            @endif             
            @if(session()->has('danger'))
                <div class="alert alert-warning alert-dismissible" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    {{ session()->get('danger') }}
                </div>   
            @endif
                
            

            @yield('content')

        </div>
        @include('partials.footer')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
    {{-- <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="{{ asset('adminLTE/js/adminlte.min.js') }}"></script> --}}
</body>
</html>
