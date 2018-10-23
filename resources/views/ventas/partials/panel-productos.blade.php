<div class="card">
    <div class="card-header">
        <ul class="list-unstyled list-inline">
            <li><h3>Productos</h3></li>
            <li>
                <button class="nonStyledButton" style="color:cyan" id="botonNuevoProducto"><i class="fa fa-plus"></i> Agregar</button>
                <button class="btn btn-default" id="botonNuevoProductoCancelar" style="display: none">Cancelar</button>
            </li>
        </ul>
    </div>
    <div class="card-body">

        @include('ventas.partials.busqueda-productos')

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr style="background-color: gray">
                    <th>Producto</th>
                    <th>Marca</th>
                    <th>Descripción</th>
                    <th>Categorías</th>
                    <th>Medida</th>
                    <th>Precio</th>
                    <th class="text-center">Opciones</th>
                </tr>
                </thead>
                <tbody>
                    @foreach($venta->productos as $producto)
                        <tr>
                            <td>{!! ucwords($producto->nombre) !!}</td>
                            <td>{!! ucWords($producto->marca->nombre) !!}</td>
                            <td>{!! ($producto->descripcion)? $producto->descripcion : '' !!}</td>
                            <td>
                                @foreach($producto->categorias as $categoria)
                                    <label class="label label-default" style="background-color: white; color: dimgray; border: 1px solid dimgray">{!! $categoria->nombre !!}</label>
                                @endforeach
                            </td>
                            <td>
                                {!! ($producto->cantidad_medida)? $producto->cantidad_medida : '' !!}
                                {!! ($producto->unidadMedida)? $producto->unidadMedida->nombre : '' !!}
                            </td>
                            <td>${!! $producto->precio !!}</td>
                            <td class="text-center" style="width: 130px">

                                @if($producto->prospecto != '' && $producto->prospecto != null)
                                    <button type="button" class="btn btn-default btn-flat btn-sm" data-target="#verProspecto{{ $producto->id }}" data-toggle="modal" title="Prospecto (Componenetes)"><i class="fa fa-file-text-o"></i> </button>
                                @endif
                                @permission('editar.venta')
                                    <button type="button" class="btn btn-warning btn-flat btn-sm" data-target="#editarObservaciones{{ $producto->id }}" data-toggle="modal" title="Modos de Uso (observaciones)"><i class="fa fa-book"></i> </button>
                                @endpermission
                                @permission('quitar.producto.venta')
                                    <button type="button" class="btn btn-danger btn-flat btn-sm" data-toggle="modal" data-target="#quitarProducto{{ $producto->id }}" title="Quitar Producto"><i class="fa fa-trash-o"></i> </button>
                                @endpermission

                                @permission('editar.venta')
                                <div class="modal fade text-left col-lg-6 col-lg-offset-3" id="editarObservaciones{{ $producto->id }}">
                                    <div class="card">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Editar Observaciones / Modos de uso</h4>
                                        </div>
                                        {!! Form::model($venta, ['method' => 'put', 'url' => route('ventas.editar.modos', $producto->id)]) !!}
                                        <div class="modal-body">

                                            {!! Form::hidden('venta_id', $venta->id) !!}
                                            {!! Form::textarea('observaciones', $producto->pivot->observaciones, ['class' => 'form-control', 'rows' => '9']) !!}

                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-primary">Guardar</button>
                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                        </div>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                                @endpermission
                                @if($producto->prospecto != '' && $producto->prospecto != null)


                                    <div class="modal fade text-left col-lg-6 col-lg-offset-3" id="verProspecto{{ $producto->id }}">
                                        <div class="card">
                                            <div class="modal-header">
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                                <h4 class="modal-title">Prospecto</h4>
                                            </div>
                                            <div class="modal-body">
                                                <div class="noticia" style="max-height:600px; overflow: scroll">
                                                    {!! $producto->prospecto !!}
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                            </div>
                                        </div>
                                    </div>

                                @endif
                                @permission('quitar.producto.venta')
                                <div class="modal fade text-left col-lg-3 col-lg-offset-9" id="quitarProducto{{ $producto->id }}">
                                    <div class="card">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title text-danger"><i class="fa fa-exclamation-triangle"></i> Quitar producto</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>¿Está seguro que desea quitar el producto "{!! $producto->nombre !!}" de esta venta?</p>
                                        </div>
                                        <div class="modal-footer">
                                            {!! Form::open(['method' => 'DELETE', 'url' => route('ventas.quitar.producto')]) !!}
                                            {!! Form::hidden('producto_id', $producto->id) !!}
                                            {!! Form::hidden('venta_id', $venta->id) !!}
                                            <button type="submit" class="btn btn-danger pull-left">Quitar</button>
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                                @endpermission
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="5">Subtotal</td>
                        <td>${!! $venta->suma_subtotal_productos !!}</td>
                    </tr>
                    <tr>
                        <td colspan="5">IVA (21%)</td>
                        <td>${!! $venta->suma_productos_IVA !!}</td>
                    </tr>
                    <tr>
                        <td colspan="5">Total</td>
                        <td>${!! $venta->suma_total_productos !!}</td>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
</div>