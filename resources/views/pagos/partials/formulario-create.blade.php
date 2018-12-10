<div class="card alert">
    <div class="card-header">
        <h4>Nueva forma de pago</h4>
    </div>

    <div class="card-body">

        {!! Form::open(['url' => route('formas.pago.store'), 'method' => 'post']) !!}

        <div class="basic-form">
                <div class="form-group">
                    {!! Form::label('tarjeta_id', 'Tarjeta') !!}
                    {{--<small><a href="" class="pull-right" style="color:cyan">+ tarjetas</a></small>--}}
                    {!! Form::select('tarjeta_id', $marcasTarjetas, null, ['class' => 'form-control  select2', 'placeholder' => '', 'style' => 'color: white']) !!}
                </div>
            </div>
            <div class="basic-form">
                <div class="form-group">
                    {!! Form::label('banco_id', 'Banco') !!}
                    {{--<small><a href="" class="pull-right" style="color:cyan">+ bancos</a></small>--}}
                    {!! Form::select('banco_id', $bancos, null, ['class' => 'form-control  select2', 'placeholder' => '', 'style' => 'color: white']) !!}
                </div>
            </div>
            <div class="basic-form">
                <div class="form-group">
                    {!! Form::label('cuota_cantidad', 'Cuotas') !!}
                    {!! Form::select('cuota_cantidad', $cuotas, null, ['class' => 'form-control  select2', 'style' => 'color: white']) !!}
                </div>
            </div>

        <div class="form-group">
            <div class="radio">
                <label>
                    <input type="radio" name="interes_descuento" id="optionsRadios1" value="interes" checked="">
                    Interés
                </label>
            </div>
            <div class="radio">
                <label>
                    <input type="radio" name="interes_descuento" id="optionsRadios2" value="descuento">
                    Descuento
                </label>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('valor', 'Valor') !!}
            {!! Form::number('valor', null, ['class' => 'form-control', 'max' => '100', 'min' => '00']) !!}
        </div>

            <button type="submit" class="btn btn-primary">Agregar</button>

        {!! Form::close() !!}

    </div>

</div>