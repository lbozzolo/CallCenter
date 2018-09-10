@extends('instituciones.base')

@section('titulo')

    <h2>Instituciones</h2>

@endsection

@section('contenido')


    <div class="row">
        <div class="col-md-6">
            <div class="card alert">
                <div class="card-header pr">
                    <h3>Agregar nueva institución</h3>
                </div>
                <div class="panel-body">
                    @include('instituciones.partials.formulario-crear-institucion')
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card alert">
                <div class="card-header pr">
                    <h3>Instituciones disponibles</h3>
                </div>
                    @include('instituciones.partials.instituciones-listado')
            </div>
        </div>
    </div>

@endsection
