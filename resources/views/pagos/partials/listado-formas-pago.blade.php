@if(isset($formasPagoTotal))
<div class="card">
    <div class="">
        <h4><span style="color: white">Tarjeta - </span>{!! $card->nombre !!}</h4>
        <h4><span style="color: white">Banco - </span>{!! $banco->nombre !!}</h4>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th class="text-center">Cuotas</th>
                    <th class="text-center">Interés</th>
                    <th class="text-center">Descuento</th>
                    <th class="text-right">Usos</th>
                    <th class="text-right">Opciones</th>
                </tr>
                </thead>
                <tbody>
                @foreach($formasPagoTotal as $formasPago)
                    <tr>
                        <td align="center">{!! $formasPago->cuota_cantidad !!}</td>
                        <td align="center">{!! ($formasPago->interes)? $formasPago->interes.'%' : '0' !!}</td>
                        <td align="center">{!! ($formasPago->descuento)? $formasPago->descuento.'%' : '0' !!}</td>
                        <td class="text-right">
                            @permission('ver.forma.de.pago')
                            <button type="button" title="ver usos" class="btn btn-default btn-xs" data-toggle="modal" data-target="#usos{!! $formasPago->id !!}" style="width: 35px" >
                                {!! count($formasPago->ventas) !!}
                            </button>
                            <div class="modal fade col-lg-6 col-lg-offset-3" id="usos{!! $formasPago->id !!}">
                                <div class="card">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title">Listado de usos</h4>
                                    </div>
                                    <div class="modal-body">
                                        @if(count($formasPago->ventas))
                                            <div class="table-responsive">
                                                <table class="table table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Id</th>
                                                            <th>Cliente</th>
                                                            <th>Productos</th>
                                                            <th>Opciones</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($formasPago->ventas as $venta)
                                                        <tr>
                                                            <td>#{!! $venta->id !!}</td>
                                                            <td class="text-left">{!! $venta->cliente->full_name !!}</td>
                                                            <td class="text-left">
                                                                @if($venta->productos)
                                                                    <ul>
                                                                        @foreach($venta->productos as $producto)
                                                                            <li class="text-left">
                                                                                <a href="{{ route('productos.show', $producto->id) }}">{!! $producto->nombre !!}</a>
                                                                            </li>
                                                                        @endforeach
                                                                    </ul>
                                                                @endif
                                                            </td>
                                                            <td><a href="{{ route('ventas.show', $venta->id) }}" class="btn btn-xs btn-default">ver</a></td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        @else
                                            <span>No hay ventas que utilicen esta forma de pago</span>
                                        @endif
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cerrar</button>
                                    </div>
                                </div>
                            </div>
                            @endpermission
                        </td>
                        <td align="center">
                            @permission('editar.forma.de.pago')
                            <a href="{{ route('formas.pago.edit', $formasPago->id) }}" class="btn btn-primary btn-xs"><i class="fa fa-edit"></i></a>
                            @endpermission

                            @permission('eliminar.forma.de.pago')
                            <button type="button" title="ELIMINAR" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#eliminarPago{!! $formasPago->id !!}" {!! (count($formasPago->ventas) > 0)? 'disabled' : '' !!} >
                                <i class="fa fa-trash-o"></i>
                            </button>
                            <div class="modal fade col-lg-3 col-lg-offset-9" id="eliminarPago{!! $formasPago->id !!}">
                                <div class="card">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span></button>
                                        <h4 class="modal-title"><i class="fa fa-warning "></i> Eliminar Forma de pago</h4>
                                    </div>
                                    <div class="modal-body">
                                        <p>¿Desea eliminar forma de pago?</p>
                                    </div>
                                    <div class="modal-footer">
                                        {!! Form::open(['method' => 'delete', 'url' => route('formas.pago.destroy', $formasPago->id)]) !!}
                                        <button type="submit" title="ELIMINAR" class="btn btn-danger" data-toggle="modal" data-target="#eliminarPago{!! $formasPago->id !!}" >
                                            Eliminar
                                        </button>
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                        {!! Form::close() !!}
                                    </div>
                                </div>
                            </div>
                            @endpermission

                            @permission('ver.updateable')
                            <a href="{{ route('updateables.entidad.show', ['entity' => $formasPago->getClass(), 'id' => $formasPago->id]) }}" class="btn btn-updateable btn-xs" title="movimientos"><i class="fa fa-info-circle"></i> </a>
                            @endpermission

                        </td>

                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@else

    @if(!isset($formaEdit))
    <div class="card">
        Seleccione una tarjeta y un banco para ver las formas de pago.
    </div>
    @endif

@endif
