<base href="{{ asset('') }}">
<meta charset="UTF-8">
<title>SmartLine</title>

@yield('header')

<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/plugins/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/dataTables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/rowReorder.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/fontawesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">


{{--Fonts--}}
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

<script src="{{ asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>

{{-- ===================== Template ===================== --}}
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!-- ================= Favicon ================== -->
<!-- Standard -->
<link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
<!-- Retina iPad Touch Icon-->
<link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
<!-- Retina iPhone Touch Icon-->
<link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
<!-- Standard iPad Touch Icon-->
<link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
<!-- Standard iPhone Touch Icon-->
<link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">
<!-- Styles -->
<link href="{{ asset('template/css/lib/chartist/chartist.min.css') }}" rel="stylesheet">
<link href="{{ asset('template/css/lib/font-awesome.min.css') }}" rel="stylesheet">
<link href="{{ asset('template/css/lib/themify-icons.css') }}" rel="stylesheet">
<link href="{{ asset('template/css/lib/owl.carousel.min.css') }}" rel="stylesheet" />
<link href="{{ asset('template/css/lib/owl.theme.default.min.css') }}" rel="stylesheet" />
<link href="{{ asset('template/css/lib/weather-icons.css') }}" rel="stylesheet" />
<link href="{{ asset('template/css/lib/menubar/sidebar.css') }}" rel="stylesheet">
<link href="{{ asset('template/css/lib/bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset('template/css/lib/unix.css') }}" rel="stylesheet">
<link href="{{ asset('template/css/style.css') }}" rel="stylesheet">
<link href="{{ asset('css/styles-template.css') }}" rel="stylesheet" type="text/css">

@yield('css')