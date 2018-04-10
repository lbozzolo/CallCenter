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

    <div class="row">
        <div class="container">
            <div class="content">
                <h1>Bienvenido a Call Center</h1>
                <hr>
                <p class="lead">Para poder operar en el sistema primero debe ser habilitado por un superior</p>
            </div>
        </div>
    </div>

@endsection

