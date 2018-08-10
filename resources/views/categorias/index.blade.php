@extends('productos.base')

@section('titulo')

    <h2>Productos<span class="text-muted"> / Categorías</span></h2>

@endsection

@section('contenido')

    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Categorías actuales</h3>
            </div>
            <div class="panel-body">
                @include('categorias.partials.categorias-listado')
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Agregar nueva categoria</h3>
            </div>
            <div class="panel-body">
                @include('categorias.partials.formulario-crear-categoria')
            </div>
        </div>
    </div>

@endsection
