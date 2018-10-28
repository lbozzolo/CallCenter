<tr id="editarMetodoPagoVenta{!! $metodoPagoVenta->id !!}" class="editarMetodoPagoVenta" style="display: none; background-color: rgb(31, 32, 55);">
    {!! Form::open(['url' => route('ventas.editar.metodo.pago.venta', $metodoPagoVenta->id), 'method' => 'put']) !!}
    <td>{!! $metodoPagoVenta->metodoPago->nombre !!}</td>
    <td class="text-center">--</td>
    <td class="text-center">-</td>
    <td class="text-center">-</td>
    <td class="text-center">-</td>
    <td class="text-center">-</td>
    <td class="text-center">-</td>
    <td>
        {!! Form::text('importe', $metodoPagoVenta->importe, ['class' => 'form-control', 'id' => 'input'.$metodoPagoVenta->id]) !!}
    </td>
    <td class="text-center">-</td>
    <td class="text-center">-</td>
    <td class="text-center">${!! $metodoPagoVenta->IVA !!}</td>
    <td class="text-center">-</td>
    <td class="text-center">${!! $metodoPagoVenta->importe_mas_promocion_mas_IVA !!}</td>
    <td>
        <button type="submit" class="btn btn-success btn-flat" style="color:gray">aceptar</button>
    </td>
    {!! Form::close() !!}
</tr>