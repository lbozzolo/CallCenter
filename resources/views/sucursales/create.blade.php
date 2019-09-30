@extends('clientes.base')

@section('titulo')

    <h2>Sucursales / <span class="text-muted">Agregar nueva sucursal</span> </h2>

@endsection

@section('contenido')

    {!! Form::open(['method' => 'post', 'url' => route('sucursales.store'), 'class' =>'form']) !!}

    <div class="col-lg-6 col-md-6">

        <div class="card card-default">
            <div class="card-heading">
                <h4 class="card-title">Agregar sucursal</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            {!! Form::label('nombre', 'Nombre') !!}
                            {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                        </div>
                        <div class="form-group">
                            {!! Form::label('direccion', 'Dirección') !!}
                            {!! Form::text('direccion', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            {!! Form::label('telefono', 'Teléfono') !!}
                            {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
                        </div>
                    </div>

                    <div class="col-lg-6 col-md-6">
                        <div class="form-group">
                            {!! Form::label('estado', 'Estado') !!}
                            {!! Form::select('estado_id', [1 => 'Activa', 0 => 'Inactiva'], null, ['class' => 'form-control select2']) !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <button type="submit" class="btn btn-primary">Agregar</button>
        <a href="{{ route('sucursales.index') }}" class="btn btn-default">Cancelar</a>

    </div>

    {!! Form::close() !!}

@endsection
