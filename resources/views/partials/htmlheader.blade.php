<base href="{{ asset('') }}">
<meta charset="UTF-8">
<title>CallCenter</title>

@yield('header')

<meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
<link href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css">
<link href="{{ asset('plugins/select2/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/css/styles.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('/plugins/datepicker/datepicker3.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/dataTables.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('css/rowReorder.bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('plugins/fontawesome/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css">


{{--Fonts--}}
<link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">

<script src="{{ asset('plugins/jQuery/jQuery-2.1.4.min.js') }}"></script>

@yield('css')