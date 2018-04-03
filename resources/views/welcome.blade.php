@extends('layout')

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
            padding: 50px 0px 0px 200px
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
            letter-spacing: 10px;
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

@section('body')

@include('partials.navbar')

<div class="row">
    <div class="container">
        <div class="content">
            <h1>Call Center</h1>
            <hr>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
            <div class="col-lg-3 col-md-4 item"><i class="glyphicon glyphicon-tags"></i></div>
            <div class="col-lg-3 col-md-4 item"><i class="glyphicon glyphicon-fire"></i></div>
            <div class="col-lg-3 col-md-4 item"><i class="glyphicon glyphicon-knight"></i></div>
        </div>
        {{--<p style="margin: 10px">
            <small style="color: gray">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.
            </small>
        </p>--}}
    </div>
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

{{--<!DOCTYPE html>
<html>
    <head>
        <title>Call Center</title>

        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">

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
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Call Center</div>
                {!! Form::text('prueba') !!}
            </div>
        </div>
    </body>
</html>--}}
