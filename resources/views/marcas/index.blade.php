@extends('marcas.base')

@section('titulo')

    <h2>Marcas</h2>

@endsection

@section('contenido')

    <div id="main-content">
        <div class="row">
            <div class="col-md-6">
                <div class="card alert">
                    <div class="card-header pr">
                        <h3>Agregar nueva Marca</h3>
                    </div>
                    <div class="panel-body">
                        @include('marcas.partials.formulario-crear-marca')
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card alert">
                    <div class="card-header pr">
                    <h3>Marcas disponibles</h3>
                    </div>
                    @include('marcas.partials.marcas-listado')
                </div>
            </div>
        </div>
    </div>


@endsection
