@extends('base')

@section('content')

<div class="row">
    <div class="container">
        <div class="content">

            <div class="row">
                <div class="col-lg-8 p-r-0 title-margin-right">
                    <div class="page-header">
                        <div class="page-title">
                            <h1><font color="#ffffff">Categorías</font></h1>
                        </div>
                    </div>
                </div>
            </div>


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

                <button type="submit" class="btn btn-warning">Editar Categoria</button>

                {!! Form::close() !!}
</div></div>
            </div>

        </div>
    </div>
</div>

@endsection


