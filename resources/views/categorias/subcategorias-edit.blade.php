@extends('productos.base')
@section('css')
<style type="text/css">

input::-webkit-calendar-picker-indicator{
    display: none;
}

.datepicker-days  {
    background: white !important;
}
.datepicker-switch{
    background: gray !important;
    color: white !important;
}
.prev, .next{
    background: lightgrey !important;
    color: white !important;
}
.day, .month, .year{
    color: gray !important;
}
.active{
    color: white !important;
}
.old{
    color: lightgray !important;
}
input, .select2{
    background-color: #404a6b !important;
}

</style>
@endsection
@section('titulo')

<div class="row">
    <div class="col-lg-8 p-r-0 title-margin-right">
        <div class="page-header">
            <div class="page-title">
                <h1><font color="#ffffff">Subcategorias</font></h1>
            </div>
        </div>
    </div>
</div>

@endsection

@section('contenido')


<div id="main-content">
    <div class="row">
        <div class="col-md-12">
            <div class="card alert">

                <h3>Editar Subcategoría: {!! $categoria->nombre !!}</h3>

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
                    {!! Form::select('parent_id', $parents,  null, ['class' => 'form-control select2', 'placeholder' => '']) !!}
                </div>

                <button type="submit" class="btn btn-warning">Editar Subcategoria</button>
                {!! Form::close() !!}

            </div>
        </div>
    </div>
</div>


@endsection

