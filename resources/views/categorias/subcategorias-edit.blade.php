@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <h2>
                    SUBCATEGORÍAS
                    <a href="{{ route('categorias.index') }}" class="btn btn-default pull-right">categorías</a>
                </h2>
                <hr>
                <div class="col-lg-5">

                    @include('categorias.partials.subcategorias-listado')

                </div>
                <div class="col-lg-5 col-lg-offset-1">

                    <h3>Editar subcategoría: {!! $categoria->nombre !!}</h3>

                    {!! Form::model($categoria, ['method' => 'put', 'url' => route('categorias.update', $categoria->id), 'class' => 'form']) !!}

                    <div class="form-group">
                        {!! Form::label('nombre', 'Nombre') !!}
                        {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('slug', 'Slug') !!}
                        {!! Form::text('slug', null, ['class' => 'form-control']) !!}
                    </div>

                    <div class="form-group">
                        {!! Form::label('parent_id', 'Categoría a la que pertence (sólo si corresponde)') !!}
                        {!! Form::select('parent_id', $parents,  null, ['class' => 'form-control', 'placeholder' => '']) !!}
                    </div>

                    {!! Form::submit('+ Guardar cambios', ['class' => 'btn btn-primary']) !!}

                    {!! Form::close() !!}

                </div>

            </div>
        </div>
    </div>

@endsection
