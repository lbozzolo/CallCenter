@extends('asignaciones.base')

@section('titulo')

    <h2>Asignaciones de Tareas</h2>
    <br>

@endsection

@section('contenido')


    <div class="nav-tabs-custom">
        <ul class="nav nav-tabs">
            <li class="active"><a href="#tab_1" data-toggle="tab">Asignar</a></li>
            <li><a href="#tab_2" data-toggle="tab">Asignaciones actuales</a></li>
            <li><a href="#tab_3" data-toggle="tab">Asignaciones históricas</a></li>
        </ul>
        <div class="tab-content">
            <div class="tab-pane active card" id="tab_1" style="margin-top: 0px">

                @if(!isset($datos))

                    @include('asignaciones.partials.listado-clientes')

                @else

                    @include('asignaciones.partials.listado-operadores')

                @endif

            </div>
            <div class="tab-pane card" id="tab_2" style="margin-top: 0px">

                @include('asignaciones.partials.listado-asignaciones-actuales')

            </div>
            <div class="tab-pane card" id="tab_3" style="margin-top: 0px">

                @include('asignaciones.partials.listado-historico')

            </div>
        </div>
    </div>


@endsection