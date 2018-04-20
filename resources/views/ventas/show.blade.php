@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">
                <h2>Venta #{!! $venta->id !!}</h2>
                <hr>

                <div class="col-lg-6 col-md-6">
                    <h3>Información general</h3>
                    <ul class="list-unstyled">
                        <li class="list-group-item">Operador: {!! $venta->user->full_name !!}</li>
                        <li class="list-group-item">Cliente: {!! $venta->cliente->full_name !!}</li>
                        <li class="list-group-item">
                            Producto: {!! $venta->producto->nombre !!}<br>
                            <small class="text-muted">{!! $venta->producto->descripcion !!}</small>
                        </li>
                        <li class="list-group-item">Estado: {!! ($venta->estado)? $venta->estado->nombre : '' !!}</li>
                        <li class="list-group-item">Método de pago: {!! ($venta->metodoPago)? $venta->metodoPago->nombre : '' !!}</li>
                        <li class="list-group-item">Forma de pago: {!! ($venta->formaPago)? $venta->formaPago->nombre : '' !!}</li>
                        <li class="list-group-item">Etapa: {!! ($venta->etapa)? $venta->etapa->nombre : '' !!}</li>
                        <li class="list-group-item">Promoción: {!! ($venta->promocion)? $venta->promocion->nombre : '' !!}</li>
                        <li class="list-group-item">Fecha de alta: {!! $venta->fecha_creado !!}</li>
                        <li class="list-group-item">Fecha de última acción: {!! $venta->fecha_editado !!}</li>
                    </ul>
                    <a href="{{ route('ventas.edit', $venta->id) }}" class="btn btn-primary">Editar</a>
                    <a href="{{ URL::previous() }}" class="btn btn-default">Volver</a>
                </div>

                <div class="col-lg-6 col-md-6">

                </div>

            </div>
        </div>
    </div>

@endsection



