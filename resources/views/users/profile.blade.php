@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">
                <h2>PERFIL {!! $user->full_name !!}</h2>
                <hr>
                <div class="col-lg-6 col-md-6">
                    <ul class="list-unstyled">
                        <li class="list-group-item">Nombre: {!! $user->nombre !!}</li>
                        <li class="list-group-item">Apellido: {!! $user->apellido !!}</li>
                        <li class="list-group-item">Email: {!! $user->email !!}</li>
                        <li class="list-group-item">Teléfono: {!! $user->telefono !!}</li>
                        <li class="list-group-item">DNI: {!! $user->dni !!}</li>
                        <li class="list-group-item">Fecha de creación: {!! $user->fecha_creado !!}</li>
                        <li class="list-group-item">
                            <a href="{{ route('users.changePassword', $user->id) }}">Cambiar contraseña</a>
                        </li>
                    </ul>
                    <a href="{{ route('users.edit', Auth::user()->id) }}" class="btn btn-primary">Editar</a>
                    <a href="{{ URL::previous() }}" class="btn btn-default">Volver</a>
                </div>
            </div>
        </div>
    </div>

@endsection



