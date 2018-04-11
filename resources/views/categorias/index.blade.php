@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <h2>
                    CATEGORÍAS
                    <a href="{{ route('subcategorias.index') }}" class="btn btn-default pull-right">subcategorías</a>
                </h2>
                <hr>
                <div class="col-lg-5">

                    @include('categorias.partials.categorias-listado')

                </div>
                <div class="col-lg-5 col-lg-offset-1">

                    @include('categorias.partials.formulario-crear-categoria')

                </div>

            </div>
        </div>
    </div>

@endsection
