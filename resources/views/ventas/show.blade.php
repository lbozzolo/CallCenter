@extends('ventas.base')

@section('titulo')

    <h2>VENTAS<small class="text-muted"> / {!! $venta->estado_plural !!}</small></h2>

@endsection

@section('contenido')

        <div class="panel">
            <div class="panel-heading">
                <div class="row">
                    <div class="col-lg-9 col-md-12">
                        <h3>
                            <label class="label estadoVentas" data-estado="{!! $venta->estado->slug !!}">{!! ($venta->estado)? $venta->estado->nombre : '' !!}</label>
                            Venta #{!! $venta->id !!}
                            <small class="text-muted"> / operador: {!! $venta->user->full_name !!}</small>
                        </h3>
                    </div>
                    <div class="col-lg-3 col-md-12 text-right">
                        Importe
                        <span class="text-primary" style="font-size: 2.5em">${!! $venta->importe_total !!}</span>
                    </div>
                </div>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Información general</h3>
                            </div>
                            <div class="panel-body">
                                <ul class="list-unstyled">
                                    <li class="list-group-item">Operador: {!! $venta->user->full_name !!}</li>
                                    <li class="list-group-item">Cliente: {!! $venta->cliente->full_name !!}</li>
                                    <li class="list-group-item">Estado:{!! $venta->estado->nombre !!}</li>
                                    <li class="list-group-item">Fecha de venta: {!! $venta->fecha_creado !!}</li>
                                    <li class="list-group-item">Fecha de última acción: {!! $venta->fecha_editado !!}</li>
                                </ul>
                            </div>
                        </div>

                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Productos</h3>
                            </div>
                            <div class="panel-body">
                                <ul class="list-unstyled">

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
                                                (p/cuota: <span class=" text-primary">${!! $venta->valor_cuota !!}</span>)
                                            </small>
                                        </div>
                                        @endif
                                    </li>

                                </ul>
                            </div>
                        </div>

                    </div>

                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Editar venta</h3>
                            </div>
                            <div class="panel-body">
                                <p>Marcar esta venta como...</p>

                                {!! Form::open(['method' => 'put', 'url' => route('ventas.update.status', $venta->id)]) !!}
                                    <div class="form-group">
                                        <div class="input-group input-group">
                                            {!! Form::select('estado_id', $estados, $venta->estado_id, ['class' => 'form-control', 'id' => 'selectEstados']) !!}
                                            <span class="input-group-btn">
                                                {!! Form::submit('Aplicar', ['class' => 'btn btn-info btn-flag']) !!}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        {!! Form::label('motivo', 'Motivo') !!}
                                        {!! Form::text('motivo', null, ['id' => 'cancelacion', 'class' => 'form-control', 'placeholder' => 'De ser necesario, describa aquí el motivo del cambio de estado']) !!}
                                        <small class="text-warning">* El motivo es obligatorio sólo en el caso de cancelar la venta</small>
                                    </div>
                                {!! Form::close() !!}

                                <div class="panel panel-info">
                                    <div class="panel-heading">
                                        Editar métodos y formas de pago
                                    </div>
                                    <div class="panel-body">
                                        @include('ventas.partials.formulario-editar')
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


@endsection

@section('js')

    <script src="{{ asset('js/estados-ventas.js') }}"></script>

    <script>

        $('.select2').select2();
        $('.datepicker').datepicker({
            format: 'd/mm/yyyy'
        });

        if($('#metodoPago option:selected').html() === 'Tarjeta de crédito'){
            $('#conTarjeta').show();
            $('#conCredito').show();
            $('.select2').select2();
        }

        if($('#metodoPago option:selected').html() === 'Tarjeta de débito'){
            $('#conTarjeta').show();
            $('#conDebito').show();
            $('.select2').select2();
        }

        $('#metodoPago').change(function () {

            if($('#metodoPago option:selected').html() === 'Tarjeta de crédito' || $('#metodoPago option:selected').html() === 'Tarjeta de débito'){

                $('#conTarjeta').show();
                $('.select2').select2();

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

