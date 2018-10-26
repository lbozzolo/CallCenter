<div class="card">
    <div class="card-header">
        <ul class="list-unstyled list-inline">
            <li><h3>Métodos de pago</h3></li>
            <li><button class="nonStyledButton" style="color:cyan" id="botonNuevoMetodo"><i class="fa fa-plus"></i> Agregar</button> </li>
            <li class="pull-right">
                @if($venta->diferencia < 0)
                    <span class="text-danger" style="font-size: 1.2em; cursor: default" title="Diferencia con la suma total de productos">$ {!! $venta->diferencia !!}</span>
                @else
                    <span class="text-success" style="font-size: 1.2em; cursor: default" title="Diferencia con la suma total de productos">$ {!! $venta->diferencia !!}</span>
                @endif
            </li>
        </ul>
    </div>
    <div class="card-body">


        @include('ventas.partials.agregar-metodo-pago')


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
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($venta->metodoPagoVenta as $metodoPagoVenta)

                    @if($metodoPagoVenta->metodoPago->isCardMethod())

                        {{--TARJETA DE CRÉDITO O DE DÉBITO--}}
                        <tr>
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
                                <button type="button" title="Eliminar método de pago" class="btn btn-danger btn-flat" data-toggle="modal" data-target="#eliminar{!! $metodoPagoVenta->id !!}" style="border: none">
                                    eliminar
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
                                                    <button type="submit" class="btn btn-danger">Eliminar</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                </div>
                                            {!! Form::close() !!}

                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

                    @else

                        {{--EFECTIVO--}}
                        <tr>
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
                                <button type="button" title="Eliminar método de pago" class="btn btn-danger btn-flat" data-toggle="modal" data-target="#eliminar{!! $metodoPagoVenta->id !!}" style="border: none">
                                    eliminar
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
                                                <button type="submit" class="btn btn-danger">Eliminar</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                            </div>
                                            {!! Form::close() !!}

                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>

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
                    {{--<tr>--}}
                        {{--<td colspan="12">Subtotal</td>--}}
                        {{--<td>${!! $venta->subtotal !!}</td>--}}
                        {{--<td>--}}
                            {{--@if($venta->diferencia < 0)--}}
                                {{--<span class="text-danger" title="Diferencia con la suma total de productos" style="cursor: default">$ {!! $venta->diferencia !!}</span>--}}
                            {{--@else--}}
                                {{--<span class="text-success" title="Diferencia con la suma total de productos" style="cursor: default">$ {!! $venta->diferencia !!}</span>--}}
                            {{--@endif--}}
                        {{--</td>--}}
                    {{--</tr>--}}
                    {{--<tr>--}}
                        {{--<td colspan="12">IVA (21%)</td>--}}
                        {{--<td>${!! $venta->iva !!}</td>--}}
                    {{--</tr>--}}
                    <tr>
                        <td colspan="9">Total</td>
                        <td colspan="3" class="text-center">

                            <span class="text-muted">AJUSTE ACTUAL: $ {!! $venta->ajuste !!}</span>

                        </td>
                        <td>${!! $venta->importe_total !!}</td>
                        <td>

                            @if($venta->ajuste == 0.00)

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
                                            <p class="text-danger">Ingrese el número que desea fijar como importe final de la compra.</p>
                                            <span class="text-muted">(Importe actual: {!! $venta->importe_total !!})</span>
                                        </div>
                                        <div class="card-footer">

                                            {!! Form::open(['url' => route('ventas.ajustar', $venta->id), 'method' => 'put']) !!}
                                            <div class="form-group">
                                                {!! Form::hidden('importe_actual', $venta->importe_total) !!}
                                                {!! Form::number('ajuste') !!}
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-primary">Ajustar</button>
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                            </div>
                                            {!! Form::close() !!}

                                        </div>
                                    </div>
                                </div>

                            @else

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

                            @endif

                        </td>
                    </tr>
                </tfooter>
            </table>
        </div>
    </div>
</div>