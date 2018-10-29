<div class="panel" id="nuevaTarjeta" style="display:none;">
    <div class="panel-heading">
        <h4 class="panel-title" style="color:white">Nueva Tarjeta</h4>
    </div>
    <div class="panel-body">


        {!! Form::open(['method' => 'post', 'url' => route('clientes.agregar.tarjeta', $cliente->id), 'class' =>'form']) !!}


        <div id="conTarjeta">

            <div class="row">
                <div class="col-lg-6">

                    {!! Form::hidden('cliente_id', $cliente->id) !!}

                    <div class="form-group" id="conCredito">
                        {!! Form::label('marca_id', 'Tarjeta') !!}
                        {!! Form::select('marca_id', $marcas, null, ['id' => 'marcaCredito', 'class' => 'form-control select2b']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('banco_id', 'Banco') !!}
                        {!! Form::select('banco_id', $bancos, null, ['id' => 'banco', 'class' => 'form-control select2b inputConTarjeta', 'placeholder' => '']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('numero_tarjeta', 'Número de tarjeta') !!}
                        {!! Form::number('numero_tarjeta', null, ['id' => 'numeroTarjeta', 'class' => 'form-control inputConTarjeta', 'placeholder' => 'Ingrese los 16 números de la tarjeta sin espacios ni guiones', 'min' => '1', 'max' => '9999999999999999']) !!}
                    </div>

                </div>

                <div class="col-lg-6">

                    <div class="form-group">
                        {!! Form::label('codigo_seguridad', 'Código de seguridad') !!}
                        {!! Form::number('codigo_seguridad', null, ['id' => 'codigoSeguridad', 'class' => 'form-control inputConTarjeta', 'min' => '1', 'max' => '9999']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('titular', 'Titular') !!}
                        {!! Form::text('titular', null, ['id' => 'titular', 'class' => 'form-control inputConTarjeta', 'placeholder' => 'Como figura en la tarjeta']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('fecha_expiracion', 'Fecha de expiración') !!}
                        {!! Form::text('fecha_expiracion', null, ['class' => 'form-control datepicker inputConTarjeta', 'id' => 'fechaExpiracion']) !!}
                    </div>

                </div>
            </div>


        </div>

        <button type="submit" class="btn btn-primary btn-sm">Agregar</button>
        <button type="button" id="cancelarAsociarTarjeta" class="btn btn-default btn-sm">Cancelar</button>

        {!! Form::close() !!}


    </div>
</div>