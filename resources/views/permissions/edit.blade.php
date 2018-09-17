@extends('permissions.base')

@section('titulo')

    <h2>Permisos</h2>

@endsection

@section('contenido')

    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                @include('permissions.partials.permissions-list')
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-default">
                <div class="card-heading">
                    <h3 class="card-title">Editar permiso: {!! $permiso->name !!}</h3>
                </div>
                <div class="card-body">
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

                    <button type="submit" class="btn btn-primary">+ Guardar cambios</button>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection
