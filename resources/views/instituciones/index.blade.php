@extends('base')


@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <div class="row">
                    <div class="col-lg-8 p-r-0 title-margin-right">
                        <div class="page-header">
                            <div class="page-title">
                                <h1>Instituciones</h1>
                            </div>
                        </div>
                    </div>
                </div>
            <div id="main-content">
                <div class="row">
                    <div class="col-md-5">
                        <div class="card alert">
                            <div class="card-header pr">
                                <h4>Agregar nueva institución</h4>
                            </div>
                            <div class="panel-body">
                                @include('instituciones.partials.formulario-crear-institucion')
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card alert">
                                <div class="card-header pr">
                                <h4>Instituciones disponibles</h3>
                                </div>
                                @include('instituciones.partials.instituciones-listado')
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                        <div class="col-lg-11">
                            <div class="footer">
                                <p>Smartline @ 2018 - Desarrollado por <a href="http://www.bamdig.com/" target="_new" class="page-refresh">Bamdig.com</a></p>
                            </div>
                        </div>
                    </div>
            </div>
        </div>
  </div>


@endsection
