
{!! Form::model($venta, ['method' => 'put', 'url' => route('clientes.editar.tarjeta', $venta->cliente->id), 'class' =>'form']) !!}

    <div class="form-group">
        {!! Form::label('metodo_pago_id', 'Método de pago') !!}
        {!! Form::select('metodo_pago_id', $metodosPago,  null, ['class' => 'form-control select2b', 'id' => 'metodoPago']) !!}
    </div>

    <div id="conTarjeta" style="display:none" >

        <div class="row">
            <div class="col-lg-6">

                <div class="form-group" style="display: none" id="conCredito">
                    {!! Form::label('marca_id_credito', 'Tarjeta') !!}
                    {!! Form::select('marca_id_credito', $marcas->where('tipo', 'credito')->lists('nombre', 'id'), ($venta->datosTarjeta)? $venta->datosTarjeta->marca_id : null, ['id' => 'marcaCredito', 'class' => 'form-control select2b']) !!}
                </div>

                <div class="form-group" style="display: none" id="conDebito">
                    {!! Form::label('marca_id_debito', 'Tarjeta') !!}
                    {!! Form::select('marca_id_debito', $marcas->where('tipo', 'debito')->lists('nombre', 'id'), ($venta->datosTarjeta)? $venta->datosTarjeta->marca_id : null, ['id' => 'marcaDebito', 'class' => 'form-control select2b', 'placeholder' => '']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('banco_id', 'Banco') !!}
                    {!! Form::select('banco_id', $bancos, ($venta->datosTarjeta)? $venta->datosTarjeta->banco_id : null, ['id' => 'banco', 'class' => 'form-control select2b inputConTarjeta', 'placeholder' => '']) !!}
                </div>

                @if($venta->datosTarjeta)
                    <div class="form-group">
                        {!! Form::label('cuotas', 'Cuotas') !!}
                        {!! Form::select('cuotas', $cuotas, ($venta->datosTarjeta->formaPago)? $venta->datosTarjeta->formaPago->cuota_cantidad : null, ['class' => 'form-control select2b', 'placeholder' => '']) !!}
                    </div>
                @else
                    <div class="form-group">
                        {!! Form::label('cuotas', 'Cuotas') !!}
                        {!! Form::select('cuotas', $cuotas, '', ['class' => 'form-control select2b', 'placeholder' => '']) !!}
                    </div>
                @endif

                @if($venta->promocion)
                    <div class="form-group">
                        {!! Form::label('promocion_id', 'Promoción') !!}
                        {!! Form::select('promocion_id', $promociones, null, ['class' => 'form-control select2b']) !!}
                    </div>
                @endif

            </div>

            <div class="col-lg-6">

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
        </div>


    </div>

<button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o"></i> Guardar</button>

{!! Form::close() !!}
