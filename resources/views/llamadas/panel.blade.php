@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <div class="row">
                    <div class="col-lg-12">
                        <h2>Llamadas<span class="text-muted"> / realizar llamada</span></h2>
                        @include('llamadas.partials.navbar')
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        <div class="panel panel-default">
                            <div class="panel-body">

                                <nav class="navbar navbar-default">
                                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
                                        <div class="row">
                                            <ul class="nav navbar-nav col-lg-12">
                                                <li class="col-lg-4 text-center"><a href="{{ route('llamadas.seleccion.cliente') }}">1. Cambiar cliente <span class="glyphicon glyphicon-user"></span> </a></li>
                                                <li class="col-lg-4 text-center"><a href="{{ route('llamadas.seleccion.producto', $cliente->id) }}">2. Cambiar producto <i class="fa fa-briefcase"></i> </a> </li>
                                                <li class="col-lg-4 text-center active"><a href="">3. Panel de llamada <i class="fa fa-phone-square"></i> </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </nav>

                                <div class="row">

                                    <div class="col-lg-12">
                                        @include('llamadas.partials.panel-cliente')
                                    </div>

                                    <div class="col-lg-6 col-md-6 col-sm-6">
                                        @include('llamadas.partials.panel-producto')
                                    </div>

                                    <div class="col-lg-4 col-md-4 col-sm-6">

                                        @include('llamadas.partials.panel-cierre-venta')

                                    </div>

                                    <div class="col-lg-2 col-md-2 col-sm-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h4 class="panel-title">Acciones</h4>
                                            </div>
                                            <div class="panel-body">
                                                Contenido...
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection

