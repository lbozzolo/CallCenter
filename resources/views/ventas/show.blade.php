@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">
                <h2>
                    VENTAS
                    <small class="text-muted"> / {!! $venta->estado_plural !!}</small>
                </h2>

                @include('ventas.partials.navbar')

                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <h3>
                            <label class="label estadoVentas" data-estado="{!! $venta->estado->slug !!}">{!! ($venta->estado)? $venta->estado->nombre : '' !!}</label>
                            Venta #{!! $venta->id !!}
                            <small class="text-muted"> / operador: {!! $venta->user->full_name !!}</small>
                        </h3>

                    </div>
                </div>



                <div class="col-lg-6 col-md-6">
                    <h3>Información general</h3>
                    <ul class="list-unstyled">
                        <li class="list-group-item">Operador: {!! $venta->user->full_name !!}</li>
                        <li class="list-group-item">Cliente: {!! $venta->cliente->full_name !!}</li>
                        <li class="list-group-item">
                            Producto: {!! $venta->producto->nombre !!}<br>
                            <small class="text-muted">{!! $venta->producto->descripcion !!}</small>
                        </li>
                        <li class="list-group-item">Estado:{!! $venta->estado->nombre !!}</li>
                        <li class="list-group-item">Método de pago: {!! ($venta->metodoPago)? $venta->metodoPago->nombre : '' !!}</li>
                        <li class="list-group-item">Forma de pago: {!! ($venta->formaPago)? $venta->formaPago->nombre : '' !!}</li>
                        <li class="list-group-item">Etapa: {!! ($venta->etapa)? $venta->etapa->nombre : '' !!}</li>
                        <li class="list-group-item">Promoción: {!! ($venta->promocion)? $venta->promocion->nombre : '' !!}</li>
                        <li class="list-group-item">Fecha de alta: {!! $venta->fecha_creado !!}</li>
                        <li class="list-group-item">Fecha de última acción: {!! $venta->fecha_editado !!}</li>
                    </ul>

                </div>

                <div class="col-lg-6 col-md-6">

                    <h3>Editar información</h3>

                    <p>Marcar esta venta como...</p>
                    {!! Form::open(['method' => 'put', 'url' => route('ventas.update.status', $venta->id)]) !!}


                        <div class="form-group">
                            <div class="input-group input-group">
                                {!! Form::select('estado_id', $estados, $venta->estado_id, ['class' => 'form-control']) !!}
                                <span class="input-group-btn">
                                    {!! Form::submit('Aplicar', ['class' => 'btn btn-primary btn-flag']) !!}
                                </span>
                            </div>
                        </div>

                    {!! Form::close() !!}

                    <p>Editar métodos y formas de pago</p>

                    @include('ventas.partials.formulario-editar')

                </div>

            </div>
        </div>
    </div>

@endsection

@section('js')

    <script src="{{ asset('js/estados-ventas.js') }}"></script>

@endsection

