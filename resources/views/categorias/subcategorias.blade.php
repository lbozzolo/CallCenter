@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <h2>
                    SUBCATEGORÍAS
                    <a href="{{ route('categorias.index') }}" class="btn btn-default pull-right">categorías</a>
                </h2>
                <hr>
                <div class="col-lg-5">

                    @include('categorias.partials.subcategorias-listado')

                </div>
                <div class="col-lg-5 col-lg-offset-1">

                    @include('categorias.partials.formulario-crear-subcategoria')

                </div>

            </div>
        </div>
    </div>

@endsection
