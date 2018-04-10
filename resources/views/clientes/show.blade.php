@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">
                <h2>{!! $cliente->full_name !!}</h2>
                <hr>

                <div class="col-lg-6 col-md-6">
                    <h3>Datos personales</h3>
                    <ul class="list-unstyled">
                        <li class="list-group-item">Nombre: {!! $cliente->nombre !!}</li>
                        <li class="list-group-item">Apellido: {!! $cliente->apellido !!}</li>
                        <li class="list-group-item">Dirección: {!! $cliente->direccion !!}</li>
                        <li class="list-group-item">Teléfono: {!! $cliente->telefono !!}</li>
                        <li class="list-group-item">Celular: {!! $cliente->celular !!}</li>
                        <li class="list-group-item">Email: {!! $cliente->email !!}</li>
                        <li class="list-group-item">DNI: {!! $cliente->dni !!}</li>
                        <li class="list-group-item">Referencia: {!! $cliente->referencia !!}</li>
                        <li class="list-group-item">Observaciones: {!! $cliente->observaciones !!}</li>
                        <li class="list-group-item">Puntos: {!! $cliente->puntos !!}</li>
                        <li class="list-group-item">Estado: {!! $cliente->estado->nombre !!}</li>
                        <li class="list-group-item">Fecha de alta: {!! $cliente->fecha_creado !!}</li>
                        <li class="list-group-item">Fecha de última acción: {!! $cliente->fecha_editado !!}</li>
                    </ul>
                    <a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-primary">Editar</a>
                    <a href="{{ URL::previous() }}" class="btn btn-default">Salir</a>
                </div>

                <div class="col-lg-6 col-md-6">
                    <h3>Interacciones</h3>
                    <ul>
                        <li><a href="">ventas</a></li>
                        <li><a href="">llamadas</a></li>
                        <li><a href="">reclamos</a></li>
                        <li><a href="">intereses</a></li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

@endsection



