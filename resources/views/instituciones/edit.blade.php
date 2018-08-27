@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-center">
                        <br><br>
                    </div>
                </div>

                
                <div class="col-lg-10 p-r-0 title-margin-right">

                    @include('instituciones.partials.formulario-editar-institucion')

                </div>

            </div>
        </div>
        
    </div>

@endsection
