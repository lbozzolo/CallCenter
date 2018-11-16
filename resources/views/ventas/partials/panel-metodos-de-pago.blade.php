<div class="card">
    <div class="card-header">
        <ul class="list-unstyled list-inline">
            <li><h3>Métodos de pago</h3></li>
            @permission('agregar.metodo.pago.venta')
            <li><button class="nonStyledButton" style="color:cyan" id="botonNuevoMetodo"><i class="fa fa-plus"></i> Agregar</button> </li>
            @endpermission
            <li class="pull-right">
                @if($venta->diferencia < 0)
                    excede monto de venta por<span class="text-danger" style="font-size: 1.2em; cursor: default" title="Diferencia con la suma total de productos"> $ {!! $venta->diferencia !!}</span>
                @else
                    resta abonar<span class="text-success" style="font-size: 1.2em; cursor: default" title="Diferencia con la suma total de productos"> $ {!! $venta->diferencia !!}</span>
                @endif
            </li>
        </ul>
    </div>
    <div class="card-body">

        @permission('agregar.metodo.pago.venta')
        @include('ventas.partials.agregar-metodo-pago')
        @endpermission

        @if(count($venta->metodoPagoVenta) > 0)

        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr style="background-color: gray">
                        <th>Método</th>
                        <th>Tarjeta</th>
                        <th>Banco</th>
                        <th>Nº Tarjeta</th>
                        <th>Código</th>
                        <th>Titular</th>
                        <th>Fecha expiración</th>
                        <th>Importe</th>
                        <th>Interés</th>
                        <th>Descuento</th>
                        <th>IVA (21%)</th>
                        <th>Cuotas</th>
                        <th>Total</th>
                        <th style="width: 100px">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($venta->metodoPagoVenta as $metodoPagoVenta)

                    @if($metodoPagoVenta->metodoPago->isCardMethod())

                        {{--TARJETA DE CRÉDITO O DE DÉBITO--}}
                        <tr id="showMetodoPagoVenta{!! $metodoPagoVenta->id !!}" class="showMetodoPagoVenta">
                            <td>{!! $metodoPagoVenta->metodoPago->nombre !!}</td>
                            <td>{!! $metodoPagoVenta->datosTarjeta->marca->nombre !!}</td>
                            <td>{!! $metodoPagoVenta->datosTarjeta->banco->nombre !!}</td>
                            <td>{!! $metodoPagoVenta->datosTarjeta->card_number !!}</td>
                            <td>{!! $metodoPagoVenta->datosTarjeta->security_number !!}</td>
                            <td>{!! $metodoPagoVenta->datosTarjeta->titular !!}</td>
                            <td>{!! $metodoPagoVenta->datosTarjeta->expiration_date !!}</td>
                            <td>${!! $metodoPagoVenta->importe !!}</td>
                            <td class="text-center">
                                @if($metodoPagoVenta->formaPago)
                                {!! ($metodoPagoVenta->formaPago->interes != 0)? $metodoPagoVenta->formaPago->interes .' %'  : '-' !!}
                                @else
                                    -
                                @endif
                            </td>
                            <td class="text-center">
                                @if($metodoPagoVenta->formaPago)
                                {!! ($metodoPagoVenta->formaPago->descuento != 0)? $metodoPagoVenta->formaPago->descuento .' %'  : '-' !!}
                                @else
                                    -
                                @endif
                            </td>
                            <td>${!! $metodoPagoVenta->IVA !!}</td>
                            <td class="text-center">
                                {!! ($metodoPagoVenta->formaPago)? $metodoPagoVenta->formaPago->cuota_cantidad.' x ' : '-' !!}
                                {!! ($metodoPagoVenta->formaPago)? '$'.$metodoPagoVenta->valor_cuota : '' !!}
                            </td>
                            <td class="text-center">${!! $metodoPagoVenta->importe_mas_promocion_mas_iva !!}</td>
                            <td>
                                @permission('editar.metodo.pago.venta')
                                <button type="button" class="btn btn-primary btn-flat botonEditarMetodoPagoVenta" data-id="{!! $metodoPagoVenta->id !!}"><i class="fa fa-edit"></i></button>
                                @endpermission
                                @permission('quitar.metodo.pago')
                                <button type="button" title="Eliminar método de pago" class="btn btn-danger btn-flat" data-toggle="modal" data-target="#eliminar{!! $metodoPagoVenta->id !!}">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <div class="modal fade col-lg-3 col-lg-offset-9" id="eliminar{!! $metodoPagoVenta->id !!}">
                                    <div class="card">
                                        <div class="card-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Eliminar Método de pago</h4>
                                        </div>
                                        <div class="card-body">
                                            <p class="text-danger">¿Desea eliminar este método de pago?</p>
                                        </div>
                                        <div class="card-footer">

                                            {!! Form::open(['url' => route('ventas.quitar.metodopago', $metodoPagoVenta->id), 'method' => 'delete']) !!}
                                                <div class="form-group">
                                                    {!! Form::text('reason', null, ['class' => 'form-control']) !!}
                                                </div>
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                </div>
                                            {!! Form::close() !!}

                                        </div>
                                    </div>
                                </div>
                                @endpermission
                            </td>
                        </tr>

                        @permission('editar.metodo.pago.venta')
                        @include('ventas.partials.editar-metodo-pago-venta-tarjeta')
                        @endpermission

                    @else

                        {{--EFECTIVO--}}
                        <tr id="showMetodoPagoVenta{!! $metodoPagoVenta->id !!}" class="showMetodoPagoVenta">
                            <td>{!! $metodoPagoVenta->metodoPago->nombre !!}</td>
                            <td class="text-center">--</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td>${!! $metodoPagoVenta->importe !!}</td>
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td class="text-center">${!! $metodoPagoVenta->IVA !!}</td>
                            <td class="text-center">-</td>
                            <td class="text-center">${!! $metodoPagoVenta->importe_mas_promocion_mas_IVA !!}</td>
                            <td>
                                @permission('editar.metodo.pago.venta')
                                <button type="button" class="btn btn-primary btn-flat botonEditarMetodoPagoVenta" data-id="{!! $metodoPagoVenta->id !!}"><i class="fa fa-edit"></i></button>
                                @endpermission
                                @permission('quitar.metodo.pago.venta')
                                <button type="button" title="Eliminar método de pago" class="btn btn-danger btn-flat" data-toggle="modal" data-target="#eliminar{!! $metodoPagoVenta->id !!}">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <div class="modal fade col-lg-3 col-lg-offset-9" id="eliminar{!! $metodoPagoVenta->id !!}">
                                    <div class="card">
                                        <div class="card-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Eliminar Método de pago</h4>
                                        </div>
                                        <div class="card-body">
                                            <p class="text-danger">¿Desea eliminar este método de pago?</p>
                                        </div>
                                        <div class="card-footer">

                                            {!! Form::open(['url' => route('ventas.quitar.metodopago', $metodoPagoVenta->id), 'method' => 'delete']) !!}
                                            <div class="form-group">
                                                {!! Form::text('reason', null, ['class' => 'form-control', 'placeholder' => 'Motivo (obligatorio)']) !!}
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                            </div>
                                            {!! Form::close() !!}

                                        </div>
                                    </div>
                                </div>
                                @endpermission
                            </td>
                        </tr>

                        @permission('editar.metodo.pago.venta')
                        @include('ventas.partials.editar-metodo-pago-venta-efectivo')
                        @endpermission

                    @endif
                @empty
                    <tr>
                        <td colspan="10">
                            <span class="text-left">Todavía no se ha cargado ningún método de pago</span>
                        </td>
                    </tr>
                @endforelse
                </tbody>
                <tfooter>

                    <tr>
                        <td colspan="9">Total</td>
                        <td colspan="3" class="text-center">

                            <span class="text-muted">AJUSTE ACTUAL: $ {!! $venta->ajuste !!}</span>

                        </td>
                        <td>${!! $venta->importe_total !!}</td>
                        <td>

                            @if($venta->ajuste == 0.00)

                                @permission('ajustar.venta')
                                <button type="button" title="Ajustar" class="pull-right btn btn-warning btn-flat" data-toggle="modal" data-target="#ajustar{!! $venta->id !!}" style="border: none">
                                    ajustar
                                </button>
                                <div class="modal fade col-lg-3 col-lg-offset-4 text-left" id="ajustar{!! $venta->id !!}">
                                    <div class="card">
                                        <div class="card-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Ajustar venta</h4>
                                        </div>
                                        <div class="card-body">

                                            <ul class="listado">
                                                <li class="list-group-item">
                                                    Importe a alcanzar:
                                                    <span class="text-warning">${!! $venta->suma_total_productos !!}</span>
                                                </li>
                                                <li class="list-group-item">
                                                    Importe actual:
                                                    <span class="text-warning">${!! $venta->importe_total !!}</span>
                                                </li>
                                            </ul>

                                        </div>
                                        <div class="card-footer">

                                            {!! Form::open(['url' => route('ventas.ajustar', $venta->id), 'method' => 'put']) !!}
                                            <div class="form-group">
                                                {!! Form::hidden('importe_actual', $venta->importe_total) !!}
                                                {!! Form::label('ajuste', 'Ingrese el número que desea fijar como importe final de la venta') !!}
                                                {!! Form::number('ajuste', null, ['class' => 'form-control', 'placeholder' => "Ingrese el número final...( ej: ".$venta->suma_total_productos." )"]) !!}
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Ajustar</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                            </div>
                                            {!! Form::close() !!}

                                        </div>
                                    </div>
                                </div>
                                @endpermission

                            @else

                                @permission('quitar.ajuste.venta')
                                <button type="button" title="Quitar ajuste" class="btn btn-danger btn-flat" data-toggle="modal" data-target="#quitarAjuste{!! $venta->id !!}">quitar ajuste</button><br>

                                <div class="modal fade col-lg-3 col-lg-offset-4 text-left" id="quitarAjuste{!! $venta->id !!}">
                                    <div class="card">
                                        <div class="card-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title">Quitar ajuste de venta</h4>
                                        </div>
                                        <div class="card-body">
                                            <p class="text-danger">¿Desea quitar el ajuste hecho a esta venta?</p>
                                            <span class="text-muted">(Ajuste actual: $ {!! $venta->ajuste !!})</span>
                                        </div>
                                        <div class="card-footer">

                                            {!! Form::open(['url' => route('ventas.quitar.ajuste', $venta->id), 'method' => 'put']) !!}
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-danger">Quitar</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                            </div>
                                            {!! Form::close() !!}

                                        </div>
                                    </div>
                                </div>
                                @endpermission

                            @endif

                        </td>
                    </tr>
                </tfooter>
            </table>
        </div>

        @endif

    </div>
</div>