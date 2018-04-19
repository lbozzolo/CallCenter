@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <h2>INSTITUCIONES</h2>

                <div class="col-lg-5">

                    @include('instituciones.partials.instituciones-listado')

                </div>
                <div class="col-lg-5 col-lg-offset-1">

                    @include('instituciones.partials.formulario-editar-institucion')

                </div>

            </div>
        </div>
    </div>

@endsection
