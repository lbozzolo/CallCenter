@extends('tickets.base')

@section('titulo')

    <h2>Soporte</h2>

@endsection

@section('contenido')

    @permission('listado.ticket')
    <div class="card">
        <div class="card-header">
            <h3>Listado de tickets</h3>
        </div>
        <div class="card-body">

            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Autor</th>
                            <th>Asunto</th>
                            <th>Criticidad</th>
                            <th>Estado</th>
                            <th>Módulo</th>
                            <th>Fecha</th>
                            <th class="text-right">Opciones</th>
                        </tr>
                    </thead>
                    <tbody>
                    @foreach($tickets as $ticket)
                        <tr>
                            <td>{!! $ticket->id !!}</td>
                            <td>{!! $ticket->author->fullname !!}</td>
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
                            <td>{!! $ticket->modulo($ticket->modulo) !!}</td>
                            <td>{!! $ticket->fecha_creado !!}</td>
                            <td>
                                @permission('ver.ticket')
                                <a href="{{ route('tickets.show', $ticket->id) }}" class="btn btn-default btn-sm">detalles</a>
                                @endpermission
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
    @endpermission

@endsection

