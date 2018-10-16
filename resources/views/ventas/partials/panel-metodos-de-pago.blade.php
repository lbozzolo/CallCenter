<div class="card">
    <div class="card-header">
        <ul class="list-unstyled list-inline">
            <li><h3>Métodos de pago</h3></li>
            <li><button class="btn btn-primary"><i class="fa fa-plus"></i> Agregar</button> </li>
        </ul>
    </div>
    <div class="card-body">
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
                        <th>Cuotas</th>
                        <th>Interés</th>
                        <th>Descuento</th>
                        <th>Valor cuota</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($venta->metodoPagoVenta as $metodoPagoVenta)

                    @if($metodoPagoVenta->metodoPago->isCardMethod())

                        <tr>
                            <td>{!! $metodoPagoVenta->metodoPago->nombre !!}</td>
                            <td>{!! $metodoPagoVenta->datosTarjeta->marca->nombre !!}</td>
                            <td>{!! $metodoPagoVenta->datosTarjeta->banco->nombre !!}</td>
                            <td>{!! $metodoPagoVenta->datosTarjeta->card_number !!}</td>
                            <td>{!! $metodoPagoVenta->datosTarjeta->security_number !!}</td>
                            <td>{!! $metodoPagoVenta->datosTarjeta->titular !!}</td>
                            <td>{!! $metodoPagoVenta->datosTarjeta->expiration_date !!}</td>
                            <td>${!! $metodoPagoVenta->importe !!}</td>
                            <td class="text-center">{!! $metodoPagoVenta->datosTarjeta->formaPago->cuota_cantidad !!}</td>
                            <td class="text-center">
                                {!! ($metodoPagoVenta->datosTarjeta->formaPago->interes != 0)? $metodoPagoVenta->datosTarjeta->formaPago->interes .' %'  : '-' !!}
                            </td>
                            <td class="text-center">
                                {!! ($metodoPagoVenta->datosTarjeta->formaPago->descuento != 0)? $metodoPagoVenta->datosTarjeta->formaPago->descuento .' %'  : '-' !!}
                            </td>
                            <td class="text-center">{!! ($metodoPagoVenta->valor_cuota)? '$'.$metodoPagoVenta->valor_cuota : '-' !!}</td>
                            <td class="text-center">${!! $metodoPagoVenta->importe_total !!}</td>
                        </tr>

                    @else

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
                            <td class="text-center">-</td>
                            <td class="text-center">-</td>
                            <td class="text-center">${!! $metodoPagoVenta->importe_total !!}</td>
                        </tr>

                    @endif
                @empty
                    <tr>
                        <td colspan="9">
                            <span class="text-left">Todavía no se ha cargado ningún método de pago</span>
                        </td>
                    </tr>
                @endforelse
                </tbody>
                <tfooter>
                    <tr>
                        <td colspan="12">Subtotal</td>
                        <td>${!! $venta->subtotal !!}</td>
                    </tr>
                    <tr>
                        <td colspan="12">IVA (21%)</td>
                        <td>${!! $venta->iva !!}</td>
                    </tr>
                    <tr>
                        <td colspan="10">Total</td>
                        <td colspan="2">
                            {!! Form::open(['url' => route('ventas.ajustar', $venta->id), 'method' => 'put']) !!}
                                <div class="form-group">
                                    <div class="input-group input-group">
                                        {!! Form::number('ajuste') !!}
                                        <span class="input-group-btn">
                                            <button type="submit" class="btn btn-primary btn-xs btn-flag">Ajuste</button>
                                        </span>
                                    </div>
                                </div>
                            {!! Form::close() !!}
                        </td>
                        <td>${!! $venta->importe_total !!}</td>
                    </tr>
                </tfooter>
            </table>
        </div>
    </div>
</div>