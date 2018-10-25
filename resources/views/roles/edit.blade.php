@extends('roles.base')

@section('titulo')

    <h2>Roles</h2>

@endsection

@section('contenido')


    <div class="col-lg-5 col-lg-offset-1">

        <h3>Editar rol: {!! $role->name !!}</h3>
        {!! Form::model($role, ['method' => 'put', 'url' => route('roles.update', $role->id), 'class' => 'form']) !!}

        <div class="form-group">
            {!! Form::label('name', 'Nombre') !!}
            {!! Form::text('name', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('description', 'Descripción') !!}
            {!! Form::text('description', null, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('slug', 'Slug') !!}
            {!! Form::text('slug', $role->slug, ['class' => 'form-control']) !!}
        </div>

        <div class="form-group">
            {!! Form::label('level', 'Nivel (de 1 a 10)') !!}
            {!! Form::number('level', $role->level, ['class' => 'form-control', 'min' => '1', 'max' => '10']) !!}
        </div>

        <button type="submit" class="btn btn-primary">Guardar Cambios</button>

        {!! Form::close() !!}

    </div>

@endsection
