@extends('asignaciones.base')

@section('titulo')

    <h2>Mis tareas</h2>

@endsection

@section('contenido')

    @permission('ver.mis.asignaciones')
    <div class="card">
        <div class="card-header">
            <ul class="list-unstyled list-inline">
                <li>
                    <h3>Tareas anteriores</h3>
                </li>
                <li>
                    <a href="{{ route('asignaciones.mis.tareas') }}" style="color: cyan">ver actuales</a>
                </li>
            </ul>

        </div>
        <div class="card-body">

            <div class="table-responsive" id="div-table-asignaciones-historicas">

                <table class="table table-vertical dataTable" id="table-asignaciones-historicas">

                    @if($asignaciones->count())
                    <thead>
                        <tr>
                            <th>Asignado por...</th>
                            <th>Dato asignado</th>
                            <th>Fecha</th>
                        </tr>
                    </thead>
                    @endif
                    <tbody>

                    @forelse($asignaciones as $asignacion)

                        <tr>
                            <td style="color: gray">{!! $asignacion->supervisor->full_name !!}</td>
                            <td style="color: gray">{!! $asignacion->cliente->full_name !!}</td>
                            <td style="color: gray">{!! $asignacion->fecha_creado !!}</td>
                        </tr>

                    @empty

                        <tr>
                            <p><span class="text-warning"> No hay datos para mostrar.</span></p>
                        </tr>

                    @endforelse

                    </tbody>
                </table>

            </div>

        </div>
    </div>
    @endpermission

@endsection