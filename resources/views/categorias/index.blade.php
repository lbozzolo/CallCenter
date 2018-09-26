@extends('categorias.base')



@section('titulo')

    <h2>Categorías</h2>

@endsection

@section('contenido')

    <div class="col-lg-6">
        <div class="card alert">
            <div class="card-header pr">
                <h3 class="card-title">Categorías actuales</h3>
            </div>
            <div class="card-body">
                @include('categorias.partials.categorias-listado')
            </div>
        </div>
    </div>
    <div class="col-lg-6">
        <div class="card alert">
            <h3 class="card-title">Agregar nueva categoria</h3>
            <div class="card-body">
                @include('categorias.partials.formulario-crear-categoria')
            </div>
        </div>
    </div>

@endsection
