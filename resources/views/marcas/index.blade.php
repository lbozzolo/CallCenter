@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <h2>
                    Productos
                    <span class="text-muted"> / Marcas</span>
                </h2>

                @include('productos.partials.navbar')

                <div class="col-lg-5">

                    @include('marcas.partials.marcas-listado')

                </div>
                <div class="col-lg-5 col-lg-offset-1">

                    @include('marcas.partials.formulario-crear-marca')

                </div>

            </div>
        </div>
    </div>

@endsection
