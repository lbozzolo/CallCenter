<tr id="editarMetodoPagoVenta{!! $metodoPagoVenta->id !!}" class="editarMetodoPagoVenta" style="display: none; background-color: #262c3f">
    {!! Form::open(['url' => route('ventas.editar.metodo.pago.venta', $metodoPagoVenta->id), 'method' => 'put']) !!}
    <td style="border-left: 2px solid cyan">{!! $metodoPagoVenta->metodoPago->nombre !!}</td>
    <td class="text-center">--</td>
    <td class="text-center">-</td>
    <td class="text-center">-</td>
    <td class="text-center">-</td>
    <td class="text-center">-</td>
    <td class="text-center">-</td>
    {{--<td>--}}
        {{--{!! Form::text('importe', $metodoPagoVenta->importe, ['class' => 'form-control', 'id' => 'input'.$metodoPagoVenta->id]) !!}--}}
    {{--</td>--}}
    <td class="text-center">-</td>
    <td class="text-center">-</td>
    {{--<td class="text-center">${!! $metodoPagoVenta->IVA !!}</td>--}}
    <td class="text-center">-</td>
    {{--<td class="text-center">${!! $metodoPagoVenta->importe_mas_promocion_mas_IVA !!}</td>--}}
    <td>
        {!! Form::text('importe', $metodoPagoVenta->importe, ['id' => 'input'.$metodoPagoVenta->id]) !!}
    </td>
    <td>
        <button type="submit" class="btn btn-success btn-flat" title="Aceptar"><i class="fa fa-check"></i> </button>
        <button type="button" class="btn btn-default btn-flat botonCancelarEdicionMetodoPago" title="Cancelar"><i class="fa fa-close"></i> </button>
    </td>
    {!! Form::close() !!}
</tr>