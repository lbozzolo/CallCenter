@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <h2>PERMISOS</h2>

                @include('roles.partials.navbar')

                <div class="col-lg-5">

                    @include('permissions.partials.permissions-list')

                </div>
                <div class="col-lg-5 col-lg-offset-1">

                    <h3>Agregar nuevo permiso</h3>
                    {!! Form::open(['method' => 'post', 'url' => route('permissions.create'), 'class' => 'form']) !!}

                    <div class="form-group">
                        {!! Form::label('model', 'Modelo relacionado') !!}
                        {!! Form::select('model',$models, null,['class' => 'form-control']) !!}
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


                    {!! Form::submit('+ Agregar permiso', ['class' => 'btn btn-primary']) !!}

                    {!! Form::close() !!}

                </div>

            </div>
        </div>
    </div>

@endsection
