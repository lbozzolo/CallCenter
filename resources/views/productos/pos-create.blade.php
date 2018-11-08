@extends('productos.base')

@section('titulo')

    <h2>
        Productos
        <span class="text-muted"> / {!! $producto->nombre !!}</span>
    </h2>

@endsection

@section('contenido')

    <div class="row">
        <div class="container">
            <div class="content">

                @permission('editar.producto')
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12 col-lg-offset-3 col-md-offset-3 col-sm-offset-3">
                        <div class="card card-primary">
                            <div class="card-header">
                                <p>¿Desea configurar etapas o agregar imágenes a este producto?</p>
                            </div>
                            <div class="card-body">

                                <ul class="list-unstyled listado">
                                    <li class="list-group-item"><a href="{{ route('productos.etapas', $producto->id) }}" style="color: cyan">Configurar etapas</a> </li>
                                    <li class="list-group-item"><a href="{{ route('productos.imagenes', $producto->id) }}" style="color: cyan">Administrar imágenes</a></li>
                                </ul>

                            </div>
                            <div class="card-footer" style="padding-top: 20px">
                                <a href="{{ route('productos.index') }}" class="btn btn-default">Ahora no</a>
                            </div>
                        </div>
                    </div>
                </div>
                @endpermission

            </div>
        </div>
    </div>

@endsection


