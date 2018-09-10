@extends('categorias.base')

@section('titulo')

    <h2>Categorías</h2>

@endsection

@section('contenido')

<div class="row">
    <div class="container">
        <div class="content">

            <div class="row">
                <div class="col-md-10">
                    <div class="card alert">
                    <h3>Editar categoría: {!! $categoria->nombre !!}</h3>

                    {!! Form::model($categoria, ['method' => 'put', 'url' => route('categorias.update', $categoria->id), 'class' => 'form']) !!}

                    <div class="form-group">
                        {!! Form::label('nombre', 'Nombre') !!}
                        {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('slug', 'Slug') !!}
                        {!! Form::text('slug', null, ['class' => 'form-control']) !!}
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    <a href="{{ route('categorias.index') }}" class="btn btn-default">Cancelar</a>

                    {!! Form::close() !!}
                </div>
        </div>
    </div>
</div>

@endsection


