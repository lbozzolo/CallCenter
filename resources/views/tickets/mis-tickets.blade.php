@extends('tareas.base')

@section('titulo')

    <h2>Soporte / Mis tickets</h2>

@endsection

@section('contenido')

    <div class="card">
        <div class="card-header">
            <ul class="list-inline">
                <li><h3>Listado de mis tickets</h3></li>
                @permission('crear.ticket')
                <li><a href="{{ route('tickets.create') }}" style="color:cyan">Generar un nuevo ticket</a></li>
                @endpermission
            </ul>
        </div>
        <div class="card-body">

            @permission('listado.ticket')
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Id</th>
                            <th>Nombre</th>
                            <th>Criticidad</th>
                            <th>Estado</th>
                            <th class="text-center">Fecha</th>
                            <th class="text-right">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @forelse($tickets as $ticket)
                        <tr>
                            <td>{!! $ticket->id !!}</td>
                            <td>{!! $ticket->subject !!}</td>
                            <td>
                                @if($ticket->level_id == 1)
                                    <span class="text-success">BAJO</span>
                                @elseif($ticket->level_id == 2)
                                    <span class="text-warning">MEDIO</span>
                                @else
                                    <span class="text-danger">ALTO</span>
                                @endif
                            </td>
                            <td>
                                @if($ticket->estado_id == 1)
                                    <span class="label label-success">abierto</span>
                                @else
                                    <span class="label label-danger">cerrado</span>
                                @endif
                            </td>
                            <td class="text-center">{!! $ticket->fecha_creado !!}</td>
                            <td>
                            @permission('ver.ticket')
                                <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-default btn-sm">detalles</a>
                            @endpermission
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6">Todavía no hay ningún ticket registrado</td>
                        </tr>
                    @endforelse
                    </tbody>
                </table>
            </div>
            @endpermission

        </div>
    </div>

@endsection