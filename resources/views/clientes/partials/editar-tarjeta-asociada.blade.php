<tr id="editarTarjetaAsociada{!! $tarjeta->id !!}" class="editarTarjetaAsociada" style="display: none; background-color: #262c3f">
    {!! Form::open(['method' => 'put', 'url' => route('clientes.update.tarjeta', $tarjeta->id), 'class' =>'form']) !!}

    {!! Form::hidden('cliente_id', $cliente->id) !!}
    <td style="border-left: 2px solid cyan">
        {!! Form::select('marca_id', $marcas, $tarjeta->marca->id, ['id' => 'marcaCredito', 'class' => 'form-control select2b']) !!}
    </td>
    <td>
        {!! Form::select('banco_id', $bancos, $tarjeta->banco->id, ['id' => 'banco', 'class' => 'form-control select2b inputConTarjeta', 'placeholder' => '']) !!}
    </td>
    <td>
        {!! Form::number('numero_tarjeta', $tarjeta->card_number, ['id' => 'numeroTarjeta', 'class' => 'form-control inputConTarjeta', 'placeholder' => 'Ingrese los 16 números de la tarjeta sin espacios ni guiones', 'min' => '1', 'max' => '9999999999999999']) !!}
    </td>
    <td>
        {!! Form::number('codigo_seguridad', $tarjeta->security_number, ['id' => 'codigoSeguridad', 'class' => 'form-control inputConTarjeta', 'min' => '1', 'max' => '9999']) !!}
    </td>
    <td>
        {!! Form::text('titular', $tarjeta->titular, ['id' => 'titular', 'class' => 'form-control inputConTarjeta', 'placeholder' => 'Como figura en la tarjeta']) !!}
    </td>
    <td>
        {!! Form::text('fecha_expiracion', $tarjeta->expiration_date, ['class' => 'form-control datepicker inputConTarjeta', 'id' => 'fechaExpiracion']) !!}
    </td>
    <td>
        <button type="submit" class="btn btn-success btn-flat" title="Aceptar"><i class="fa fa-check"></i> </button>
        <button type="button" class="btn btn-default btn-flat botonCancelarEdicionTarjetaAsociada" title="Cancelar"><i class="fa fa-close"></i> </button>
    </td>
    {!! Form::close() !!}
</tr>