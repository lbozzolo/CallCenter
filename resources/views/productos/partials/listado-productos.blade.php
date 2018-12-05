<div class="overlay col-lg-12 text-center" style="padding: 100px; border: 1px solid lightgrey; border-radius: 5px">
    Aguarde un momento por favor...<br>
    <i class="fa fa-refresh fa-spin" style="font-size: 2em"></i>
</div>
<div class="table-responsive" id="div-table-productos" style="display: none;">

    <table class="table table-vertical dataTable" id="table-productos">

        <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Marca</th>
            <th>Precio</th>
            <th style="width: 400px">Descripcion</th>
            <th style="width: 200px">Categorías</th>
            <th>Stock</th>
            <th>Estado</th>
            <th class="text-right" style="width: 100px">Opciones</th>
        </tr>
        </thead>
        <tbody>

        @foreach($productos as $producto)

            <tr>
                <td>{!! $producto->id !!}</td>
                <td>
                    @permission('ver.producto')
                    <a href="{{ route('productos.show', $producto->id) }}" title="Info">{!! $producto->nombre !!}</a>
                    @endpermission
                </td>
                <td>{!! ($producto->marca)? $producto->marca->nombre : '' !!}</td>
                <td>${!! $producto->precio !!}</td>
                <td>{!! $producto->descripcion !!}</td>
                <td>
                @foreach($producto->categorias as $categoria)
                    <label class="label label-default" style="background-color: white; color: dimgray; border: 1px solid dimgray">{!! $categoria->nombre !!}</label>
                @endforeach
                </td>
                <td>
                    @if($producto->alerta_stock >= $producto->stock)
                        <span style="color: red" title="producto con bajo stock">{!! $producto->stock !!}</span>
                    @else
                        {!! $producto->stock !!}
                    @endif
                </td>
                <td>
                    @if($producto->estado->slug == 'activo')
                        <label class="label label-success">{!! $producto->estado->nombre !!}</label>
                    @elseif($producto->estado->slug == 'inactivo')
                        <label class="label label-default">{!! $producto->estado->nombre !!}</label>
                    @endif
                </td>
                <td class="text-center">


                    @permission('cambiar.estado.producto')
                    <button type="button" {{ ($producto->estado && $producto->estado->slug == 'activo')? 'title=DESACTIVAR' : 'title=ACTIVAR' }} class="btn btn-xs btn-default" data-toggle="modal" data-target="#disableProducto{!! $producto->id !!}" >
                        @if($producto->estado && $producto->estado->slug == 'activo')
                            <i class="fa fa-lock text-primary"></i>
                        @else
                            <i class="fa fa-unlock text-primary"></i>
                        @endif
                    </button>
                    <div class="modal fade col-lg-4 col-lg-offset-8" id="disableProducto{!! $producto->id !!}">
                        <div class="card alert text-left">
                            <div class="card-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title"><i class="fa fa-warning "></i>
                                    {!! ($producto->estado->slug == 'activo')? 'Desactivar producto' : 'Activar producto' !!}
                                </h4>
                            </div>
                            <div class="card-body">
                                <p>
                                    Usted está a punto de
                                    {!! ($producto->estado->slug == 'activo')? 'desactivar' : 'activar' !!}
                                    el producto<br>
                                    <em class="text-danger">{!! $producto->nombre !!}</em>
                                </p>
                                <p>¿Desea continuar?</p>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('productos.change.state', $producto->id) }}" class="btn btn-danger" title="DESACTIVAR">Aceptar</a>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                    @endpermission

                    @permission('editar.producto')
                    <a href="{{ route('productos.edit', ['id' => $producto->id]) }}" class="btn btn-primary btn-xs" title="Editar"><i class="glyphicon glyphicon-edit"></i> </a>
                    @endpermission

                    @permission('eliminar.producto')
                    <button type="button" title="ELIMINAR" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#eliminarProducto{!! $producto->id !!}" >
                        <i class="fa fa-trash-o"></i>
                    </button>
                    <div class="modal fade col-lg-4 col-lg-offset-8" id="eliminarProducto{!! $producto->id !!}">

                        <div class="card alert text-left">
                            <div class="card-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="card-title"><i class="fa fa-warning "></i> Eliminar producto</h4>
                            </div>
                            <div class="card-body">
                                <p>
                                    Usted está a punto de elminar al producto<br>
                                    <em class="text-danger">{!! $producto->nombre !!}</em>
                                </p>
                                <p>¿Desea continuar?</p>
                            </div>
                            <div class="card-footer">
                                {!! Form::open(['method' => 'delete', 'url' => route('productos.destroy', $producto->id)]) !!}
                                <button type="submit" title="ELIMINAR" class="btn btn-danger" data-toggle="modal" data-target="#eliminarProducto{!! $producto->id !!}" >
                                    Eliminar
                                </button>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                {!! Form::close() !!}
                            </div>
                        </div>

                    </div>
                    @endpermission

                    @permission('ver.updateable')
                    <a href="{{ route('updateables.entidad.show', ['entity' => $producto->getClass(), 'id' => $producto->id]) }}" class="btn btn-updateable btn-xs" title="movimientos"><i class="fa fa-info-circle"></i> </a>
                    @endpermission

                </td>
            </tr>

        @endforeach

        </tbody>
    </table>



</div>
