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
                <h1><font color="#ffffff">Categorías</font></h1>
            </div>
        </div>
    </div>
</div>

@endsection

@section('contenido')

    <div class="col-lg-6">
    <div class="card alert">
        <div class="card-header pr">
                <h3 class="panel-title">Categorías actuales</h3>
            </div>
            <div class="panel-body">
                @include('categorias.partials.categorias-listado')
            </div>
        </div>
    </div>
    <div class="col-lg-6">
    <div class="card alert">
        <div class="card-header pr">
                <h3 class="panel-title">Agregar nueva categoria</h3>
            </div>
            <div class="panel-body">
                @include('categorias.partials.formulario-crear-categoria')
            </div>
        </div>
    </div>

@endsection
