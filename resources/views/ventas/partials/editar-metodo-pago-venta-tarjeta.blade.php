<tr id="editarMetodoPagoVenta{!! $metodoPagoVenta->id !!}" class="editarMetodoPagoVenta" style="display: none; background-color: rgb(31, 32, 55)">
    {!! Form::open(['url' => route('ventas.editar.metodo.pago.venta', $metodoPagoVenta->id), 'method' => 'put']) !!}
    <td>{!! $metodoPagoVenta->metodoPago->nombre !!}</td>
    <td>{!! $metodoPagoVenta->datosTarjeta->marca->nombre !!}</td>
    <td>{!! $metodoPagoVenta->datosTarjeta->banco->nombre !!}</td>
    <td>{!! $metodoPagoVenta->datosTarjeta->card_number !!}</td>
    <td>{!! $metodoPagoVenta->datosTarjeta->security_number !!}</td>
    <td>{!! $metodoPagoVenta->datosTarjeta->titular !!}</td>
    <td>{!! $metodoPagoVenta->datosTarjeta->expiration_date !!}</td>
    <td>
        {!! Form::text('importe', $metodoPagoVenta->importe, ['class' => 'form-control', 'id' => 'input'.$metodoPagoVenta->id]) !!}
    </td>
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
        <button type="submit" class="btn btn-success btn-flat">aceptar</button>
    </td>
    {!! Form::close() !!}
</tr>