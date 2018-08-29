@extends('marcas.base')

@section('titulo')

    <h2>Marcas</h2>

@endsection

@section('contenido')

    <div class="card alert">

        <h3>Editar marca: {!! $marca->nombre !!}</h3>

        {!! Form::model($marca, ['method' => 'put', 'url' => route('marcas.update', $marca->id), 'class' => 'form']) !!}

            <div class="form-group">
                {!! Form::label('nombre', 'Nombre') !!}
                {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
            </div>
            <div class="form-group">
                {!! Form::label('descripcion', 'Descripción') !!}
                {!! Form::text('descripcion', null, ['class' => 'form-control']) !!}
            </div>

            <button type="submit" class="btn btn-primary">Guardar cambios</button>
            <a href="{{ route('marcas.index') }}" class="btn btn-default">Cancelar</a>

        {!! Form::close() !!}

    </div>
    
@endsection
