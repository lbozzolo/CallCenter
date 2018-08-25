<div class="col-md-9">
    <div class="card alert">
        
            <h4>Editar forma de pago</h4>
        
        <div class="panel-body">

            {!! Form::model($formaEdit, ['url' => route('formas.pago.update', $formaEdit->id), 'method' => 'put']) !!}

            <div class="form-group">
                {!! Form::label('tarjeta_id', 'Tarjeta') !!}
                {!! Form::select('tarjeta_id', $marcasTarjetas, $formaEdit->marca_tarjeta_id, ['class' => 'form-control', 'placeholder' => '']) !!}
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="form-group">
                        {!! Form::label('cuota_cantidad', 'Cuotas') !!}
                        {!! Form::select('cuota_cantidad', $cuotas, null, ['class' => 'form-control']) !!}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        {!! Form::label('interes', 'Interés (%)') !!}
                        {!! Form::number('interes', null, ['class' => 'form-control', 'max' => '100', 'min' => '0']) !!}
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="form-group">
                        {!! Form::label('descuento', 'Descuento (%)') !!}
                        {!! Form::number('descuento', null, ['class' => 'form-control', 'max' => '100', 'min' => '00']) !!}
                    </div>
                </div>
            </div>
            <div class="form-group text-right">
                <button type="submit" class="btn btn-warning">Actualizar Forma de Pago</button>
            </div>

            {!! Form::close() !!}

        </div>
    </div>
</div>