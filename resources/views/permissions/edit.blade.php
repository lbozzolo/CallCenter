@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <h2>
                    Roles y permisos
                    <a href="{{ route('roles.index') }}" class="btn btn-default pull-right">ver roles</a>
                </h2>
                <hr>
                <div class="col-lg-5">

                    @include('permissions.partials.permissions-list')

                </div>
                <div class="col-lg-5 col-lg-offset-1">

                    <h3>Editar permiso: {!! $permiso->name !!}</h3>
                    {!! Form::model($permiso, ['method' => 'put', 'url' => route('permissions.update', $permiso->id), 'class' => 'form']) !!}

                    <div class="form-group">
                        {!! Form::label('name', 'Nombre') !!}
                        {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'ej: (Editar usuario)']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('description', 'Descripción') !!}
                        {!! Form::text('description', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('slug', 'Slug (con notación de puntos)') !!}
                        {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'ej: (editar.usuario)']) !!}
                    </div>


                    {!! Form::submit('+ Guardar cambios', ['class' => 'btn btn-primary']) !!}

                    {!! Form::close() !!}

                </div>

            </div>
        </div>
    </div>

@endsection
