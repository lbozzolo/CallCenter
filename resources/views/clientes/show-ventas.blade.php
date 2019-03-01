@extends('clientes.base')

@section('titulo')

    <h2>
        {!! $cliente->full_name !!}
        <span class="text-muted"> / Datos personales</span>
    </h2>

@endsection

@section('contenido')


    <div class="card">
        <h3>
            <label class="label estadoVentas" data-estado="{!! $venta->estado->slug !!}">{!! ($venta->estado)? $venta->estado->nombre : '' !!}</label>
            Compra #{!! $venta->id !!}
            <small class="text-muted"> / operador: {!! $venta->user->full_name !!}</small>
        </h3>
    </div>

    <div class="row">
        <div class="col-lg-6">
            <div class="card card-default">
                <div class="card-heading">
                    <h3 class="card-title">Información general</h3>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled listado">
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
                        <li class="list-group-item">Etapa: {!! ($venta->etapa)? $venta->etapa->nombre : '<small class="text-muted">Este producto no se vende en etapas</small>' !!}</li>
                        <li class="list-group-item">Promoción: {!! ($venta->promocion)? $venta->promocion->nombre : '' !!}</li>
                        <li class="list-group-item">Fecha de alta: {!! $venta->fecha_creado !!}</li>
                        <li class="list-group-item">Fecha de última acción: {!! $venta->fecha_editado !!}</li>
                    </ul>
                </div>
            </div>
        </div>

        @permission('editar.venta')
        <div class="col-lg-6">

            <div class="card">
                <p>Marcar esta venta como...</p>
                {!! Form::open(['method' => 'put', 'url' => route('ventas.update.status', $venta->id)]) !!}

                    <div class="form-group">
                        <div class="input-group input-group">
                            {!! Form::select('estado_id', $estados, $venta->estado_id, ['class' => 'form-control select2b']) !!}
                            <span class="input-group-btn">
                                <button type="submit" class="btn btn-primary btn-flag">Aplicar</button>
                            </span>
                        </div>
                    </div>

                {!! Form::close() !!}
            </div>
            <div class="card">

                <div class="card-body">
                    @include('ventas.partials.formulario-editar')
                </div>
            </div>

        </div>
        @endpermission

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

