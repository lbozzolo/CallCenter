@extends('base')

@section('header')
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
@endsection

@section('css')

    <style>
        html, body {
            height: 100%;
        }

        body {
            margin: 0;
            padding: 0;
            width: 100%;
            display: table;
            font-weight: 100;
            font-family: 'Open Sans';
        }

        .container {
            /*text-align: center;*/
            display: table-cell;
            vertical-align: middle;
            padding: 50px 0px 0px 200px;
        }

        /*.content {
            text-align: center;
            display: inline-block;
        }
*/
        h1{
            color: darkslategray;
            font-size: 4em;
            font-family: 'Raleway';
            /*letter-spacing: 10px;*/
        }

        .item {
            background-color: lightgrey;
            height: 150px;
            margin: 5px;
            text-align: center;
        }

        .item i{
            font-size: 5em;
            color: gray;
            margin-top: 20%;
        }
    </style>

@endsection

@section('content')

{{--
@include('partials.navbar')
--}}

<div class="row" style="background-color: darkslategray; color: white; margin-top: -30px">
    <div class="container">
        <div class="content">

            <div class="col-lg-5 col-md-5">
                <h1 style="color: #b3f0ff">SmartLine</h1>
                <hr>
                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.</p>
            </div>
            <div class="col-lg-7 col-md-7">
                <img src="{{ route('imagenes.ver', 'callcenter.png') }}" width="100%">
            </div>

        </div>
    </div>
</div>
<div class="row">
    <div class="panel">
        <div class="panel-body" style="width: 80%; margin: 0px auto">
            <div class="col-lg-4 col-md-4 text-center">
                <img src="{{ route('imagenes.ver', 'icono1.png') }}" width="100px" >
                <p style="padding: 20px 100px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</p>
            </div>
            <div class="col-lg-4 col-md-4 text-center">
                <img src="{{ route('imagenes.ver', 'icono2.png') }}" width="100px">
                <p style="padding: 20px 100px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</p>
            </div>
            <div class="col-lg-4 col-md-4 text-center">
                <img src="{{ route('imagenes.ver', 'icono3.png') }}" width="100px" >
                <p style="padding: 20px 100px">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod.</p>
            </div>
        </div>
    </div>

    {{--<div class="col-lg-3 col-md-4 item"><i class="glyphicon glyphicon-tags"></i></div>
    <div class="col-lg-3 col-md-4 item"><i class="glyphicon glyphicon-fire"></i></div>
    <div class="col-lg-3 col-md-4 item"><i class="glyphicon glyphicon-knight"></i></div>--}}
</div>

@endsection

@section('js')

    <script>

        $('#datepicker').datepicker();

        $('#select2').select2({
            placeholder: 'Select an option'
        });

    </script>

@endsection

