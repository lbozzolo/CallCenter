
{!! Form::model($venta, ['method' => 'put', 'url' => route('ventas.update', $venta->id), 'class' =>'form']) !!}

{{--@if($etapas->count())
    <div class="form-group">
        {!! Form::label('etapa_id', 'Etapa') !!}
        {!! Form::select('etapa_id', $etapas, null, ['class' => 'form-control', 'placeholder' => '']) !!}
    </div>
@endif--}}

    <div class="form-group">
        {!! Form::label('metodo_pago_id', 'Método de pago') !!}
        {!! Form::select('metodo_pago_id', $metodosPago,  null, ['class' => 'form-control', 'id' => 'metodoPago']) !!}
    </div>


    <div id="conTarjeta" style="display:none">

    <div class="form-group" style="display: none" id="conCredito">
        {!! Form::label('marca_id_credito', 'Tarjeta') !!}
        {!! Form::select('marca_id_credito', $marcas->where('tipo', 'credito')->lists('nombre', 'id'), ($venta->datosTarjeta)? $venta->datosTarjeta->marca_id : null, ['id' => 'marcaCredito', 'class' => 'form-control']) !!}
    </div>

    <div class="form-group" style="display: none" id="conDebito">
        {!! Form::label('marca_id_debito', 'Tarjeta') !!}
        {!! Form::select('marca_id_debito', $marcas->where('tipo', 'debito')->lists('nombre', 'id'), ($venta->datosTarjeta)? $venta->datosTarjeta->marca_id : null, ['id' => 'marcaDebito', 'class' => 'form-control', 'placeholder' => '']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('banco_id', 'Banco') !!}
        {!! Form::select('banco_id', $bancos, ($venta->datosTarjeta)? $venta->datosTarjeta->banco_id : null, ['id' => 'banco', 'class' => 'form-control select2 inputConTarjeta', 'placeholder' => '']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('numero_tarjeta', 'Número de tarjeta') !!}
        {!! Form::number('numero_tarjeta', ($venta->datosTarjeta)? $venta->datosTarjeta->numero_tarjeta : null, ['id' => 'numeroTarjeta', 'class' => 'form-control inputConTarjeta', 'placeholder' => 'Ingrese los 16 números de la tarjeta sin espacios ni guiones', 'min' => '1', 'max' => '9999999999999999']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('codigo_seguridad', 'Código de seguridad') !!}
        {!! Form::number('codigo_seguridad', ($venta->datosTarjeta)? $venta->datosTarjeta->codigo_seguridad : null, ['id' => 'codigoSeguridad', 'class' => 'form-control inputConTarjeta', 'min' => '1', 'max' => '9999']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('titular', 'Titular') !!}
        {!! Form::text('titular', ($venta->datosTarjeta)? $venta->datosTarjeta->titular : null, ['id' => 'titular', 'class' => 'form-control inputConTarjeta', 'placeholder' => 'Como figura en la tarjeta']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('fecha_expiracion', 'Fecha de expiración') !!}
        {!! Form::text('fecha_expiracion', ($venta->datosTarjeta)? date('d/m/Y', strtotime($venta->datosTarjeta->fecha_expiracion)) : null, ['class' => 'form-control datepicker inputConTarjeta']) !!}
    </div>

    </div>



@if($venta->promocion)
<div class="form-group">
    {!! Form::label('promocion_id', 'Promoción') !!}
    {!! Form::select('promocion_id', $promociones, null, ['class' => 'form-control']) !!}
</div>
@endif

<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Guardar</button>
<a href="{{ URL::previous() }}" class="btn btn-default">Cancelar</a>

{!! Form::close() !!}
