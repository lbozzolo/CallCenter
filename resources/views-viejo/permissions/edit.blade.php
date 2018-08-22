@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <div class="row">
                    <div class="col-lg-12">
                        <h2>Permisos</h2>
                        @include('roles.partials.navbar')
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6">
                        @include('permissions.partials.permissions-list')
                    </div>
                    <div class="col-lg-6">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h3 class="panel-title">Editar permiso: {!! $permiso->name !!}</h3>
                            </div>
                            <div class="panel-body">
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

            </div>
        </div>
    </div>

@endsection
