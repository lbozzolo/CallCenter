@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <h2>
                    ROLES Y PERMISOS
                    <a href="{{ route('permissions.index') }}" class="btn btn-default pull-right">ver permisos</a>
                </h2>
                <hr>
                <div class="col-lg-5">

                    @include('roles.partials.roles-list')

                </div>
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

                    {!! Form::submit('Guardar cambios', ['class' => 'btn btn-primary']) !!}

                    {!! Form::close() !!}

                </div>

            </div>
        </div>
    </div>

@endsection
