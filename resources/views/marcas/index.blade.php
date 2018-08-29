

@extends('productos.base')

@section('titulo')

    <h2>Marcas</h2>

@endsection

@section('contenido')

    <div class="row">
        <div class="container">
            <div class="content">

                
            <div id="main-content">
                <div class="row">
                    <div class="col-md-5">
                        <div class="card alert">
                            <div class="card-header pr">
                                <h4>Agregar nueva Marca</h4>
                            </div>
                            <div class="panel-body">
                                @include('marcas.partials.formulario-crear-marca')
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="card alert">
                                <div class="card-header pr">
                                <h4>Marcas disponibles</h3>
                                </div>
                                @include('marcas.partials.marcas-listado')
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
