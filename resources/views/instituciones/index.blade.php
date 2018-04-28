@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <h2>Instituciones</h2>

{{--
                @include('productos.partials.navbar')
--}}

                <div class="col-lg-5">

                    @include('instituciones.partials.instituciones-listado')

                </div>
                <div class="col-lg-5 col-lg-offset-1">

                    @include('instituciones.partials.formulario-crear-institucion')

                </div>

            </div>
        </div>
    </div>

@endsection
