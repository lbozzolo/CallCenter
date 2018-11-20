@extends('reclamos.base')

@section('titulo')

    <h2>Reclamos <span class="text-muted">/ Ingresar-reclamo</span> </h2>

@endsection


@section('contenido')

    <div class="card card-default">
        <div class="card-header">
            <ul class="list-inline">
                <li><h3>Datos de la venta #{!! $venta->id !!}</h3></li>
                @permission('ver.reclamos.venta')
                <li>
                    <span style="padding: 10px 5px;"><a href="{!! route('ventas.reclamos', $venta->id) !!}" style="color: cyan">ver reclamos ( {!! $venta->reclamos->count() !!} )</a></span>
                </li>
                @endpermission
            </ul>
        </div>
        <div class="card-body">
            <ul class="list-unstyled listado">
                <li class="list-group-item">Operador: {!! $venta->user->full_name !!}</li>
                <li class="list-group-item">
                    Cliente: {!! $venta->cliente->full_name !!}
                    <a href="{{ route('clientes.show', $venta->cliente->id) }}" class="btn btn-default btn-xs pull-right">ver</a>
                </li>
                <li class="list-group-item">Fecha de venta: {!! $venta->fecha_creado !!}</li>
                <li class="list-group-item">Fecha de última acción: {!! $venta->fecha_editado !!}</li>
                <li class="list-group-item">Número de guía: {!! ($venta->numero_guia)? $venta->numero_guia : '<small class="text-muted">sin número de guía</small>' !!}</li>

            </ul>
        </div>
    </div>
    <div class="card card-default">
        <div class="card-header">
            <h3>Ingrese un nuevo reclamo a esta venta</h3>
        </div>
        <div class="card-body">

            {!! Form::open(['url' => route('reclamos.store', $venta->id), 'method' => 'POST', 'class' => 'form']) !!}

            <div class="form-group">
                {!! Form::label('titulo', 'Título') !!}
                {!! Form::text('titulo', null, ['class' => 'form-control']) !!}
            </div>

            <div class="form-group">
                {!! Form::label('descripcion', 'Descripción') !!}
                {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'rows' => '10']) !!}
            </div>

            <dic class="form-group">
                <button type="submit" class="btn btn-primary">Crear reclamo</button>
            </dic>

            {!! Form::close() !!}

        </div>
    </div>

@endsection

