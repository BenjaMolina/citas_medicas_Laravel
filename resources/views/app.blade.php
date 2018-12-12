<!doctype html>
<html lang="{{ app()->getLocale() }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <link rel="stylesheet" href="{{ asset('css/all.css') }}">

    {{--
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    --}}

    {{--
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.0/css/ionicons.min.css"> --}}

    {{--
    <link rel="stylesheet" href="{{ asset('adminLTE/css/AdminLTE.min.css') }}"> --}}

    {{--
    <link rel="stylesheet" href="{{ asset('adminLTE/css/skins/skin-blue.min.css') }}"> --}}


    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">


</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
        @include('partials.header')
        @include('partials.sidebar')

        <div class="content-wrapper">
            @include('partials.content_header')
            <section class="content container-fluid">
                @yield('content')
            </section>
        </div>
        @include('partials.footer')
    </div>
</body>

<script src="{{ asset('js/app.js') }}"></script>
{{-- <script src="{{ asset('adminLTE/js/adminlte.min.js') }}"></script> --}}

</html>
