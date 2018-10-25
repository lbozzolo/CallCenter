@extends('roles.base')

@section('titulo')

    <h2>
        Roles
        <span class="text-muted"> / Asignar permisos a {!! strtoupper($role->name)!!}</span>
    </h2>

@endsection

@section('contenido')

    {!! Form::model($role, ['method' => 'put', 'url' => route('roles.assign.permissions', $role->id), 'class' => 'form']) !!}

        <div class="card">
            <span>Asignar permisos a {!! strtoupper($role->name)!!}</span>
            <button type="submit" class="btn btn-primary">Guardar Cambios</button>
        </div>

        @include('permissions.partials.assign-permissions')

    {!! Form::close() !!}

@endsection
