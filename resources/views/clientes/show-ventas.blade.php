@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <div class="row">
                    <div class="col-lg-12">
                        <h2>
                            {!! $cliente->full_name !!}
                            <span class="text-muted"> / Datos personales</span>
                        </h2>
                        @include('clientes.partials.navbar')
                    </div>
                </div>


                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="panel">
                            <div class="panel-heading">
                                <h3>
                                    <label class="label estadoVentas" data-estado="{!! $venta->estado->slug !!}">{!! ($venta->estado)? $venta->estado->nombre : '' !!}</label>
                                    Venta #{!! $venta->id !!}
                                    <small class="text-muted"> / operador: {!! $venta->user->full_name !!}</small>
                                </h3>
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
                                                    <li class="list-group-item">
                                                        Productos:
                                                        <ul>
                                                            @foreach($venta->productos as $producto)
                                                                <li>
                                                                    {!! $producto->nombre !!}<br>
                                                                    <small class="text-muted">{!! $producto->descripcion !!}</small>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    </li>
                                                    <li class="list-group-item">Estado:{!! $venta->estado->nombre !!}</li>
                                                    <li class="list-group-item">Método de pago: {!! ($venta->metodoPago)? $venta->metodoPago->nombre : '' !!}</li>
                                                    <li class="list-group-item">Forma de pago: {!! ($venta->formaPago)? $venta->formaPago->nombre : '' !!}</li>
                                                    <li class="list-group-item">Etapa: {!! ($venta->etapa)? $venta->etapa->nombre : '<small class="text-muted">Este producto no se vende en etapas</small>' !!}</li>
                                                    <li class="list-group-item">Promoción: {!! ($venta->promocion)? $venta->promocion->nombre : '' !!}</li>
                                                    <li class="list-group-item">Fecha de alta: {!! $venta->fecha_creado !!}</li>
                                                    <li class="list-group-item">Fecha de última acción: {!! $venta->fecha_editado !!}</li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="panel panel-default">
                                            <div class="panel-heading">
                                                <h3 class="panel-title">Editar información</h3>
                                            </div>
                                            <div class="panel-body">
                                                <p>Marcar esta venta como...</p>
                                                {!! Form::open(['method' => 'put', 'url' => route('ventas.update.status', $venta->id)]) !!}


                                                <div class="form-group">
                                                    <div class="input-group input-group">
                                                        {!! Form::select('estado_id', $estados, $venta->estado_id, ['class' => 'form-control']) !!}
                                                        <span class="input-group-btn">
                                                {!! Form::submit('Aplicar', ['class' => 'btn btn-info btn-flag']) !!}
                                                    </span>
                                                    </div>
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

