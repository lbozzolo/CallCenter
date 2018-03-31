@extends('layout')

@section('header')
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
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

@endsection

@section('body')

<div class="row">
    <div class="container">
        <div class="content">
            <div class="title">Call Center</div>
            {!! Form::text('prueba', null, ['id' => 'datepicker']) !!}<br>
            {!! Form::select('seleccion', ['1' => 'valor1', '2' => 'valor2', '3' => 'valor3'], null, ['class' => 'form-control', 'id' => 'select2']) !!}
        </div>
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
