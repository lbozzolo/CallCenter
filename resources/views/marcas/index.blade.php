@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <div class="row">
                    <div class="col-lg-12">
                        <h2>Productos<span class="text-muted"> / Marcas</span></h2>
                        @include('productos.partials.navbar')
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Marcas disponibles</h3>
                            </div>
                            <div class="panel-body">
                                @include('marcas.partials.marcas-listado')
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Agregar nueva marca</h3>
                            </div>
                            <div class="panel-body">
                                @include('marcas.partials.formulario-crear-marca')
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection
