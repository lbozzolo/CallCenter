@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <h2>SUBCATEGORÍAS</h2>

                @include('productos.partials.navbar')

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
