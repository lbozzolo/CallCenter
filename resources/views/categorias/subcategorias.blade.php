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

<div class="col-lg-6">
    <div class="card alert">
        <div class="card-header pr">
            <h3 class="panel-title">Subacategorías actuales</h3>
        </div>
        <div class="panel-body">
            @include('categorias.partials.subcategorias-listado')
        </div>
    </div>
</div>
<div class="col-lg-6">
    <div class="card alert">
        <div class="card-header pr">
            <h3 class="panel-title">Agregar nueva subcategoria</h3>
        </div>
        <div class="panel-body">
            @include('categorias.partials.formulario-crear-subcategoria')
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="footer">
            <p>Smartline @ 2018 - Desarrollado por <a href="http://www.bamdig.com/" target="_new" class="page-refresh">Bamdig.com</a></p>
        </div>
    </div>
</div>
@endsection
