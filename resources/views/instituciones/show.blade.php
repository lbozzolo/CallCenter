@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">
                <h2>{!! $institucion->nombre !!}</h2>
                <hr>
                <div class="col-lg-6 col-md-6">
                    <ul class="list-unstyled">
                        <li class="list-group-item">Nombre: {!! $institucion->nombre !!}</li>
                        <li class="list-group-item">Dirección: {!! $institucion->direccion !!}</li>
                        <li class="list-group-item">Teléfono: {!! $institucion->telefono !!}</li>
                        <li class="list-group-item">Email: {!! $institucion->email !!}</li>
                        <li class="list-group-item">URL: {!! $institucion->url !!}</li>
                        <li class="list-group-item">Responsable: {!! $institucion->responsable !!}</li>
                        <li class="list-group-item">Descripción: {!! $institucion->descripcion !!}</li>
                        <li class="list-group-item">Estado: {!! ($institucion->estado)? $institucion->estado->nombre : '' !!}</li>
                        <li class="list-group-item">Fecha de alta: {!! $institucion->fecha_creado !!}</li>
                        <li class="list-group-item">Fecha de última acción: {!! $institucion->fecha_editado !!}</li>
                    </ul>
                    <a href="{{ route('instituciones.edit', $institucion->id) }}" class="btn btn-primary">Editar</a>
                    <a href="{{ URL::previous() }}" class="btn btn-default">Volver</a>
                </div>

            </div>
        </div>
    </div>

@endsection



