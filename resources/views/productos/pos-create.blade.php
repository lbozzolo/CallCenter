@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <div class="row">
                    <div class="col-lg-12">
                        <h2>
                            Productos
                            <span class="text-muted"> / {!! $producto->nombre !!}</span>
                        </h2>

                        @include('productos.partials.navbar')
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3">
                        <div class="panel panel-primary">
                            <div class="panel-heading">
                                <h2 class="panel-title">¿Desea configurar etapas o agregar imágenes a este producto?</h2>
                            </div>
                            <div class="panel-body">

                                <ul class="list-unstyled">
                                    <li><a href="{{ route('productos.etapas', $producto->id) }}">Configurar etapas</a> </li>
                                    <li><a href="{{ route('productos.imagenes', $producto->id) }}">Administrar imágenes</a></li>
                                </ul>
                                <a href="{{ route('productos.index') }}" class="btn btn-default">Ahora no</a>
                            </div>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>

@endsection


