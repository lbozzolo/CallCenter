@extends('permissions.base')

@section('titulo')

    <h2>Permisos</h2>

@endsection

@section('contenido')

    <div class="row">
        <div class="col-lg-6 col-md-6">

            <div class="card card-default">
                <div class="card-heading">
                    <h3 class="card-title">Permisos disponibles</h3>
                </div>
                <div class="card-body">
                    @include('permissions.partials.permissions-list')
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card card-default">
                <div class="card-heading">
                    <h3 class="card-title">Agregar nuevo permiso</h3>
                </div>
                <div class="card-body">

                    {!! Form::open(['method' => 'post', 'url' => route('permissions.create'), 'class' => 'form']) !!}

                    <div class="form-group">
                        {!! Form::label('model', 'Modelo relacionado') !!}
                        {!! Form::select('model',$models, null,['class' => 'form-control select2b']) !!}
                    </div>
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

                    <button type="submit" class="btn btn-primary">+ Agregar permiso</button>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>

    </div>

@endsection
