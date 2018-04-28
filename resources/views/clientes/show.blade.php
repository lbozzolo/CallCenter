@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">
                <h2>
                    {!! $cliente->full_name !!}
                    <span class="text-muted"> / Datos personales</span>
                </h2>

                @include('clientes.partials.navbar')

                <div class="col-lg-6 col-md-6">

                    <ul class="list-unstyled">
                        <li>
                            <a href="{{ route('clientes.edit', $cliente->id) }}"><i class="fa fa-edit"></i> editar</a>
                        </li>
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
                    {{--<a href="{{ route('clientes.edit', $cliente->id) }}" class="btn btn-primary">Editar</a>
                    <a href="{{ URL::previous() }}" class="btn btn-default">Volver</a>--}}
                </div>

                <div class="col-lg-6 col-md-6">

                    @if($cliente->editar)

                        <h3>Editar datos</h3>
                        @include('clientes.partials.formulario-editar')

                    @endif

                </div>

            </div>
        </div>
    </div>

@endsection



