@extends('roles.base')

@section('titulo')

    <h2>Roles</h2>

@endsection

@section('contenido')

    <div class="row">
        <div class="col-lg-6">

            <div class="card card-default">
                <div class="card-heading">
                    <h3 class="card-title">Roles actuales</h3>
                </div>
                <div class="card-body">
                    @include('roles.partials.roles-list')
                </div>
            </div>

        </div>
        <div class="col-lg-6">

            <div class="card card-default">
                <div class="card-heading">
                    <h3 class="card-title">Agregar nuevo rol</h3>
                </div>
                <div class="card-body">

                    {!! Form::open(['method' => 'post', 'url' => route('roles.create'), 'class' => 'form']) !!}

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
                        {!! Form::text('slug', null, ['class' => 'form-control']) !!}
                    </div>
                    {{--<div class="form-group">--}}
                        {{--{!! Form::label('level', 'Nivel (de 1 a 10)') !!}--}}
                        {{--{!! Form::number('level',null, ['class' => 'form-control', 'min' => '1', 'max' => '10']) !!}--}}
                    {{--</div>--}}
                    <button type="submit" class="btn btn-primary">Agregar Rol</button>

                    {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>

@endsection
