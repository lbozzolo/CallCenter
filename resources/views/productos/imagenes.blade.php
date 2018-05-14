@extends('base')

@section('css')
    <style type="text/css">

        .list-group-item {
            display: list-item;
        }

    </style>
@endsection

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">
                <h2>
                    Administrar imágenes
                    <small class="text-muted"> / producto: {!! $producto->nombre !!}</small>
                </h2>
                <hr>
                <div class="col-lg-6 col-md-6">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h3 class="panel-title">Imágenes</h3>
                        </div>
                        <div class="panel-body">

                            @if(count($producto->images) > 0)
                                <ul class="list-inline">
                                    @foreach($producto->images as $imagen)
                                    <li>
                                        <span style="display: inline-block">
                                            <a href="" data-toggle="modal" data-target="#modalVerImage{!! $imagen->id !!}">
                                            <img src="{{ route('imagenes.ver', $imagen->path) }}" class="img-responsive" style="{!! ($imagen->principal == 0)? 'opacity: 0.5;' : '' !!} height: 80px">
                                            </a>
                                        </span>
                                        <div class="modal fade" id="modalVerImage{!! $imagen->id !!}">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <img src="{{ route('imagenes.ver', $imagen->path) }}" class="img-responsive" style="margin: 0px auto">
                                                    </div>
                                                    <div class="modal-footer">

                                                        @if($imagen->principal == 0)
                                                            <a href="{{ route('imagenes.principal', $imagen->id) }}" class="btn btn-primary" title="Marcar como principal">Marcar como principal</a>
                                                        @else
                                                            <a href="#" class="btn btn-primary" disabled title="Marcar como principal">Marcar como principal</a>
                                                        @endif
                                                        <button class="btn btn-danger" title="Eliminar foto" data-toggle="modal" data-target="#modalDeleteImage{!! $imagen->id !!}">Eliminar</button>
                                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                        <div class="modal fade text-left" id="modalDeleteImage{!! $imagen->id !!}">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                            <span aria-hidden="true">&times;</span></button>
                                                                        <h4 class="modal-title">Eliminar imagen</h4>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <p class="text-red">¿Está seguro que desea eliminar la imagen?</p>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                                                                        {!! Form::open(['method' => 'DELETE', 'url' => route('imagenes.delete', $imagen->id)]) !!}
                                                                        {!! Form::submit('Eliminar de todos modos', ['class' => 'btn btn-danger']) !!}
                                                                        {!! Form::close() !!}
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    @endforeach
                                </ul>
                            @else

                                <span class="text-muted">Este producto todavía no tiene imágenes.</span>

                            @endif

                        </div>
                    </div>



                </div>

                <div class="col-lg-6 col-md-6">

                    <div class="panel panel-default">
                        <div class="panel-heading">
                           <h3 class="panel-title">Subir imágenes</h3>
                        </div>
                        <div class="panel-body">

                            <div class="formularioFoto">


                                {!! Form::open(['url' => route('imagenes.store', ['id' => $producto->id, 'model' => 'producto']), 'method' => 'post', 'class' => 'form', 'enctype' => 'multipart/form-data']) !!}

                                <div class="form-group">
                                    <div class="input-group input-group-sm">
                                        {!! Form::file('img', ['class' => 'form-control', 'id' => 'inputImagen']) !!}
                                        <span class="input-group-btn">
                                {!! Form::submit('Subir', ['class' => 'btn btn-info btn-flag']) !!}
                                </span>
                                    </div>
                                </div>
                                <div class="form-group" id="titleDescription" style="display:none">
                                    <label for="title"><small class="text-muted">Agregue una descripción de la foto</small></label>
                                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                                </div>

                                {!! Form::close() !!}

                            </div>

                        </div>

                    </div>
                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-default">Cancelar</a>

                </div>


            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>

        $('#inputImagen').change(function() {
            $('#titleDescription').fadeIn();
        });

    </script>

@endsection