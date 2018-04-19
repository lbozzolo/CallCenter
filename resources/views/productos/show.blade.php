@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">
                <span>Producto</span>
                <h2>{!! $producto->nombre !!}</h2>
                <hr>


                <div class="col-lg-6 col-md-6">
                    <ul class="list-unstyled">
                        <li class="list-group-item">Nombre: {!! $producto->nombre !!}</li>
                        <li class="list-group-item">Descripción: {!! ($producto->descripcion)? $producto->descripcion : '' !!}</li>
                        <li class="list-group-item">Marca: {!! ($producto->marca)? $producto->marca->nombre : '' !!}</li>
                        <li class="list-group-item">Fecha de inicio: {!! ($producto->fecha_inicio)? $producto->fecha_inicio : '' !!}</li>
                        <li class="list-group-item">Fecha de finalización: {!! ($producto->fecha_finalizacion)? $producto->fecha_finalizacion : '' !!}</li>
                        <li class="list-group-item">Estado: {!! $producto->estado->nombre !!}</li>
                        <li class="list-group-item">Unidad de medida: {!! ($producto->unidadMedida)? $producto->unidadMedida->nombre : '' !!}</li>
                        <li class="list-group-item">Cantidad de medida: {!! ($producto->cantidad_medida)? $producto->cantidad_medida : '' !!}</li>
                        <li class="list-group-item">Stock: {!! ($producto->stock)? $producto->stock : '' !!}</li>
                        <li class="list-group-item">Alerta stock: {!! ($producto->alerta_stock)? $producto->alerta_stock : '' !!}</li>
                        <li class="list-group-item">
                            Categorías:
                            @foreach($producto->categorias as $categoria)
                                <label class="label label-default" style="background-color: white; color: dimgray; border: 1px solid dimgray">{!! $categoria->nombre !!}</label>
                            @endforeach
                        </li>
                        <li class="list-group-item">Precio: {!! ($producto->precio)? "$".$producto->precio : '' !!}</li>
                        <li class="list-group-item">Institución: {!! ($producto->institucion_id)? $producto->institucion->nombre : '<em class="text-muted">(sin datos)</em>' !!}</li>
                        <li class="list-group-item">Fecha de creación: {!! ($producto->fecha_creado)? $producto->fecha_creado : '' !!}</li>
                        <li class="list-group-item">Fecha de última edición: {!! ($producto->fecha_editado)? $producto->fecha_editado : '' !!}</li>
                    </ul>
                    <a href="{{ route('productos.edit', $producto->id) }}" class="btn btn-primary">Editar</a>
                    <a href="{{ route('productos.index') }}" class="btn btn-default">Salir</a>

                    <button type="button" title="ELIMINAR" class="nonStyledButton" data-toggle="modal" data-target="#eliminarProducto" >
                        <i class="fa fa-trash-o text-danger"></i>
                    </button>
                    <div class="modal fade" id="eliminarProducto">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title"><i class="fa fa-warning "></i> Eliminar producto</h4>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        Usted está a punto de elminar al producto<br>
                                        <em class="text-danger">{!! $producto->nombre !!}</em>
                                    </p>
                                    <p>¿Desea continuar?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                                    {!! Form::open(['method' => 'delete', 'url' => route('productos.destroy', $producto->id)]) !!}
                                    <button type="submit" title="ELIMINAR" class="btn btn-danger" data-toggle="modal" data-target="#eliminarProducto{!! $producto->id !!}" >
                                        Eliminar
                                    </button>
                                    {!! Form::close() !!}
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <div class="col-lg-6 col-md-6">
                    <h3>Agregar imagen</h3>

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

                    @if(count($producto->images) > 0)
                        <h3>Fotos</h3>
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
                    @endif

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


