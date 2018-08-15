@extends('base')

@section('header')
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css" integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">

    <style>
    
        .altura
        {
            min-height: 3em;
            border-radius: 2%;
            margin: 2% 0;
        }
        .spanblanco
        {
            background-color:rgba(255,255,255,0.3); 
            border-radius:10%;
            font-weight: bold;
        }
        .botonIr
        {
            background-color: rgba(255,255,255,0.7);
            color: #000;
            font-size:2em;
            padding:1% 10%;
            border: 1px solid black;
            border-radius:5%;
            float: right;
            margin-right:5%;
        }
        @media only screen and (max-width: 680px)
        {
            .botonIr
            {
                float: left;
                margin-right:0;
            }
            .contenedor
            {
                padding: 5;
            }
        }

        @media only screen and (min-width: 681px)
        {
            .barra
            {
                display: none;
            }
            .rowContenedor
             {
                 margin-bottom:2%;
             }
        }

    
    </style>
@endsection

@section('css')
@endsection

@section('content')

<section style="background: url('/img/fondohome.jpg'); background-size: cover; width: 100%; height: auto;">
<div class="container contenedor" style="padding:3%">

    <div class="row altura" style="background-color: rgba(255,255,255,0.7); padding:2%">
        <div class="col-md-3">
            <span class="spanblanco">
                <div class="row rowContenedor" style="margin-left:1%;">
                    <i class="fas fa-users fa-2x"></i>
                    <h2 style="display:inline;">Clientes</h2>
                    <hr class="barra" style="border-bottom: 1px solid #ccc">
                </div>
            </span>
        </div>
        <div class="col-md-6">
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Error sunt esse, praesentium ea ad eaque neque vel dolorum natus corrupti aliquid expedita aperiam dolorem accusantium distinctio vitae. Eum, voluptatibus ullam!
            </p>
        </div>
        <div class="col-md-3">
            <a href="{{ route('clientes.index') }}"><button class="botonIr">Ir</button></a>
        </div>
    </div>
    <div class="row altura" style="background-color: rgba(255,255,255,0.7); padding:2%">
        <div class="col-md-3">
            <span class="spanblanco">
                <div class="row rowContenedor" style="margin-left:1%;">
                    <i class="fas fa-shopping-cart fa-2x"></i>
                    <h2 style="display:inline;">Productos</h2>
                    <hr class="barra" style="border-bottom: 1px solid #ccc">
                </div>
                <hr class="barra" style="border-bottom: 1px solid #ccc">
            </span>
        </div>
        <div class="col-md-6">
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Error sunt esse, praesentium ea ad eaque neque vel dolorum natus corrupti aliquid expedita aperiam dolorem accusantium distinctio vitae. Eum, voluptatibus ullam!
            </p>
        </div>
        <div class="col-md-3">
            <a href="{{ route('productos.index') }}"><button class="botonIr">Ir</button></a>
        </div>
    </div>
    <div class="row altura" style="background-color: rgba(255,255,255,0.7); padding:2%">
        <div class="col-md-3">
            <span class="spanblanco">
                <div class="row rowContenedor" style="margin-left:1%;">
                    <i class="fas fa-headset fa-2x"></i>
                    <h2 style="display:inline;">Llamadas</h2>
                    <hr class="barra" style="border-bottom: 1px solid #ccc">
                </div>
                <hr class="barra" style="border-bottom: 1px solid #ccc">
            </span>
        </div>
        <div class="col-md-6">
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Error sunt esse, praesentium ea ad eaque neque vel dolorum natus corrupti aliquid expedita aperiam dolorem accusantium distinctio vitae. Eum, voluptatibus ullam!
            </p>
        </div>
        <div class="col-md-3">
            <a href="{{ route('llamadas.index') }}"><button class="botonIr">Ir</button></a>
        </div>
    </div>
    <div class="row altura" style="background-color: rgba(255,255,255,0.7); padding:2%">
        <div class="col-md-3">
            <span class="spanblanco">
                <div class="row rowContenedor" style="margin-left:1%;">
                    <i class="fas fa-hand-holding-usd fa-2x"></i>
                    <h2 style="display:inline;">Ventas</h2>
                    <hr class="barra" style="border-bottom: 1px solid #ccc">
                </div>
                <hr class="barra" style="border-bottom: 1px solid #ccc">
            </span>
        </div>
        <div class="col-md-6">
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Error sunt esse, praesentium ea ad eaque neque vel dolorum natus corrupti aliquid expedita aperiam dolorem accusantium distinctio vitae. Eum, voluptatibus ullam!
            </p>
        </div>
        <div class="col-md-3">
            <a href="{{ route('ventas.index') }}"><button class="botonIr">Ir</button></a>
        </div>
    </div>
    <div class="row altura" style="background-color: rgba(255,255,255,0.7); padding:2%">
        <div class="col-md-3">
            <span class="spanblanco">
                <div class="row rowContenedor" style="margin-left:1%;">
                    <i class="fas fa-exclamation fa-2x"></i>
                    <h2 style="display:inline;">Reclamos</h2>
                    <hr class="barra" style="border-bottom: 1px solid #ccc">
                </div>
                <hr class="barra" style="border-bottom: 1px solid #ccc">
            </span>
        </div>
        <div class="col-md-6">
            <p>
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Error sunt esse, praesentium ea ad eaque neque vel dolorum natus corrupti aliquid expedita aperiam dolorem accusantium distinctio vitae. Eum, voluptatibus ullam!
            </p>
        </div>
        <div class="col-md-3">
            <a href="{{ route('reclamos.index') }}"><button class="botonIr">Ir</button></a>
        </div>
    </div>
   
</div>
</section>


@endsection

@section('js')

    <script>

        $('#datepicker').datepicker();

        $('#select2').select2({
            placeholder: 'Select an option'
        });

    </script>

@endsection

