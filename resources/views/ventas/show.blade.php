@extends('ventas.base')

@section('titulo')

    <h2>Ventas<span class="text-muted"> / Datos</span> </h2>

@endsection


@section('contenido')

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-lg-9 col-md-12">
                        <h3>
                            <label class="label estadoVentas" data-estado="{!! $venta->estado->slug !!}">{!! ($venta->estado)? $venta->estado->nombre : '' !!}</label>
                            Venta #{!! $venta->id !!}
                            <small class="text-muted"> / operador: {!! $venta->user->full_name !!}</small>
                        </h3>
                    </div>
                    <div class="col-lg-3 col-md-12 text-right">
                        <span class="text-primary" style="font-size: 2.5em">${!! $venta->importe_total !!}</span>
                        @if($venta->has_cuotas)
                            <div class="text-muted">
                                {!! $venta->has_cuotas->cuota_cantidad !!} cuotas de <span class=" text-primary">${!! $venta->valor_cuota !!}</span>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="row">

            <div class="col-lg-6">

                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Información general</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled listado">
                                <li class="list-group-item">Operador: {!! $venta->user->full_name !!}</li>
                                <li class="list-group-item">Cliente: {!! $venta->cliente->full_name !!}</li>
                                <li class="list-group-item">Estado:{!! $venta->estado->nombre !!}</li>
                                <li class="list-group-item">Fecha de venta: {!! $venta->fecha_creado !!}</li>
                                <li class="list-group-item">Fecha de última acción: {!! $venta->fecha_editado !!}</li>
                                <li class="list-group-item">Número de guía: {!! $venta->numero_guia !!}</li>
                            </ul>
                        </div>
                        @permission('ver.reclamos.venta')
                        @if($venta->reclamos->count())

                            <span style="padding: 10px 5px;"><a href="{!! route('ventas.reclamos', $venta->id) !!}" style="color: cyan">Reclamos ( {!! $venta->reclamos->count() !!} )</a></span>

                        @else

                            <span style="padding: 10px 5px; color: cyan">Reclamos ( 0 )</span>

                        @endif
                        @endpermission
                    </div>

                    @if($venta->metodoPago)
                        @if($venta->metodoPago->slug == 'credito' || $venta->metodoPago->slug == 'debito')
                        <div class="card card-default">
                            <div class="card-header">
                                <h3 class="card-title">Datos de la tarjeta</h3>
                            </div>
                            <div class="card-body">
                                <ul class="list-unstyled listado">
                                    <li class="list-group-item">Método de pago: {!! ($venta->metodoPago)? $venta->metodoPago->nombre : '' !!}</li>
                                    <li class="list-group-item">Tarjeta: {!! ($venta->datosTarjeta)? $venta->datosTarjeta->marca->nombre : '' !!}</li>
                                    <li class="list-group-item">Banco: {!! ($venta->datosTarjeta)? $venta->datosTarjeta->banco->nombre : '' !!}</li>
                                    <li class="list-group-item">Cuotas: {!! ($venta->datosTarjeta)? $venta->datosTarjeta->formaPago->cuota_cantidad : '' !!}</li>
                                    <li class="list-group-item">Número de tarjeta: {!! ($venta->datosTarjeta)? $venta->datosTarjeta->card_number : '' !!}</li>
                                    <li class="list-group-item">Código de seguridad: {!! ($venta->datosTarjeta)? $venta->datosTarjeta->security_number : '' !!}</li>
                                    <li class="list-group-item">Titular: {!! ($venta->datosTarjeta)? $venta->datosTarjeta->titular : '' !!}</li>
                                    <li class="list-group-item">Fecha de expiración: {!! ($venta->datosTarjeta)? $venta->datosTarjeta->expiration_date : '' !!}</li>
                                </ul>
                            </div>
                        </div>
                        @endif
                    @endif

                </div>


                <div class="col-12">
                    <div class="card card-default">
                        <div class="card-header">
                            <h3 class="card-title">Productos</h3>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled listado">

                            @foreach($venta->productos as $producto)

                                <li class="list-group-item">
                                    <span class="pull-right">${!! $producto->precio !!}</span>
                                    Producto: {!! $producto->nombre !!}<br>
                                    <small class="text-muted">{!! $producto->descripcion !!}</small>
                                </li>

                            @endforeach

                                <li class="list-group-item">
                                    <div >Subtotal<strong class="pull-right">${!! $venta->total_venta !!}</strong></div>
                                    @if($venta->interes_venta)
                                        <div>Intereses ({!! $venta->datosTarjeta->formaPago->interes !!}%)<strong class="pull-right">+${!! $venta->interes_venta !!}</strong></div>
                                    @endif
                                    @if($venta->descuento_venta)
                                        <div>Descuentos ({!! $venta->datosTarjeta->formaPago->descuento !!}%)<strong class="pull-right">-${!! $venta->descuento_venta !!}</strong></div>
                                    @endif
                                        <div>IVA (21%) <strong class="pull-right" style="border-top: 1px solid lightgray">+${!! $venta->IVA !!}</strong> </div>
                                </li>
                                <li class="list-group-item">
                                    <div class="text-right"><span class="text-primary" style="font-size: 1.5em">${!! $venta->importe_total !!}</span></div>
                                    @if($venta->has_cuotas)
                                    <div class="text-right">
                                        <small class="text-muted">
                                            {!! $venta->has_cuotas->cuota_cantidad !!} cuotas de <span class=" text-primary">${!! $venta->valor_cuota !!}</span>
                                        </small>
                                    </div>
                                    @endif
                                </li>

                            </ul>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-6">
                @permission('editar.venta')
                        <div class="col-12">
                            <div class="card card-default">
                                <div class="card-header">
                                    <h3 class="card-title">Editar venta</h3>
                                </div>
                                <div class="card-body">
                                    <p>Marcar esta venta como...</p>

                                    {!! Form::open(['method' => 'put', 'url' => route('ventas.update.status', $venta->id)]) !!}
                                        <div class="form-group">
                                            <div class="input-group input-group">
                                                {!! Form::select('estado_id', $estados, $venta->estado_id, ['class' => 'form-control select2', 'id' => 'selectEstados']) !!}
                                                <span class="input-group-btn">
                                                    <button type="submit" class="btn btn-primary btn-flag">Aplicar</button>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            {!! Form::label('motivo', 'Motivo') !!}
                                            {!! Form::text('motivo', null, ['id' => 'cancelacion', 'class' => 'form-control', 'placeholder' => 'De ser necesario, describa aquí el motivo del cambio de estado']) !!}
                                            <small class="text-warning">* El motivo es obligatorio sólo en el caso de cancelar la venta</small>
                                        </div>
                                    {!! Form::close() !!}

                                    <div class="card card-info">
                                        <div class="card-heading">
                                            Editar métodos y formas de pago
                                        </div>
                                        <div class="card-body">
                                            @include('ventas.partials.formulario-editar')
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                @endpermission
            </div>
        </div>

@endsection

@section('js')

    <script src="{{ asset('js/estados-ventas.js') }}"></script>

    <script>

        /*$('.select2').select2();*/
        $('.datepicker').datepicker({
            format: 'd/mm/yyyy'
        });

        if($('#metodoPago option:selected').html() === 'Tarjeta de crédito'){
            $('#conTarjeta').show();
            $('#conCredito').show();
            //$('.select2').select2();
        }

        if($('#metodoPago option:selected').html() === 'Tarjeta de débito'){
            $('#conTarjeta').show();
            $('#conDebito').show();
            //$('.select2').select2();
        }

        $('#metodoPago').change(function () {

            if($('#metodoPago option:selected').html() === 'Tarjeta de crédito' || $('#metodoPago option:selected').html() === 'Tarjeta de débito'){

                $('#conTarjeta').show();
                //$('.select2').select2();

                if($('#metodoPago option:selected').html() === 'Tarjeta de crédito'){
                    $('#marcaDebito').val('');
                    $('#conDebito').hide();
                    $('#conCredito').show();
                }
                if($('#metodoPago option:selected').html() === 'Tarjeta de débito'){
                    $('#marcaCredito').val('');
                    $('#conCredito').hide();
                    $('#conDebito').show();
                }

            }else{

                $('#conTarjeta').hide();
                $('.inputConTarjeta').val('');
                $('#marcaCredito').val('');
                $('#conCredito').hide();
                $('#marcaDebito').val('');
                $('#conDebito').hide();

            }

        });


    </script>

@endsection

