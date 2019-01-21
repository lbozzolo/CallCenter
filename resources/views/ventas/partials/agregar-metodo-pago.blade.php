<div class="panel " id="nuevoMetodo" style="display:none;">
    <div class="panel-heading">
        <h4 class="panel-title" style="color:white">Nuevo método de pago</h4>
    </div>
    <div class="panel-body">
        {!! Form::open(['url' => route('ventas.agregar.metodo.de.pago', $venta->id), 'method' => 'post', 'class' => 'form']) !!}
        <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
                <div class="form-group">
                    {!! Form::label('metodo_pago', 'Método de pago') !!}
                    {!! Form::select('metodo_pago', $metodosPago, null, ['class' => 'form-control select2b', 'placeholder' => '', 'id' => 'selectMetodo']) !!}
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="selectTarjetaCredito" style="display: none">
                <div class="form-group">
                    {!! Form::label('datos_tarjeta_id', 'Tarjeta') !!}
                    @if($venta->cliente->hasCard('credito'))
                        <select name="datos_tarjeta_id" class="form-control select2b" id="selectCredito">
                            @foreach($tarjetas as $tarjeta)
                                @if($tarjeta->marca->tipo == 'credito')
                                    <option value="{!! $tarjeta->id !!}">{!! $tarjeta->marca->nombre !!} ( {!! $tarjeta->titular !!})</option>
                                @endif
                            @endforeach
                        </select>
                    @else
                        <br><span class="text-danger">No hay ninguna tarjeta de crédito cargada a este cliente.</span>
                    @endif
                </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12" id="selectTarjetaDebito" style="display: none">
                <div class="form-group">
                    {!! Form::label('datos_tarjeta_id', 'Tarjeta') !!}
                    @if($venta->cliente->hasCard('debito'))
                        <select name="datos_tarjeta_id" class="form-control select2b" id="selectDebito">
                            @foreach($tarjetas as $tarjeta)
                                @if($tarjeta->marca->tipo == 'debito')
                                    <option value="{!! $tarjeta->id !!}">{!! $tarjeta->marca->nombre !!} ( {!! $tarjeta->titular !!})</option>
                                @endif
                            @endforeach
                        </select>
                    @else
                        <br><span class="text-danger">No hay ninguna tarjeta de débito cargada a este cliente.</span>
                    @endif
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                <div class="form-group">
                    {!! Form::label('importe', 'Importe') !!}
                    {!! Form::text('importe', null, ['min' => 1, 'class' => 'form-control', 'id' => 'inputImporte']) !!}
                </div>
            </div>
            <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12" id="selectCuotas" style="display:none">
                <div class="form-group">

                    {!! Form::label('cuotas', 'Plan') !!}
                    <p class="bg-warning" style="padding: 7px 10px" id="plan-de-cuotas">{!! ($venta->plan_cuotas)? $venta->plan_cuotas.' CUOTA(S)' : 'Seleccione Plan' !!}</p>
                    {{--{!! Form::select('cuotas', [1 => '1', 2=> '2', 3 => '3', 6 => '6', 12 => '12', 18 => '18', 24 => '24', 36 => '36', 48 => '48', 50 => '50'], null, ['class' => 'form-control select2b', 'id' => 'cuotas']) !!}--}}
                </div>
            </div>

            <div class="col-lg-12 form-group">
                <button type="submit" class="btn btn-primary btn-sm">Agregar</button>
                <button type="button" id="cancelarAgregarMetodoPago" class="btn btn-default btn-sm">Cancelar</button>
            </div>

            {!! Form::close() !!}
        </div>
    </div>
</div>