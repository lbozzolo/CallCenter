@extends('tickets.base')

@section('titulo')

    <h2>Soporte / Listado de tickets</h2>

@endsection

@section('contenido')

    @permission('listado.ticket')
    <div class="card">
        <div class="card-body">

            <div class="overlay col-lg-12 text-center" style="padding: 100px; border: 1px solid lightgrey; border-radius: 5px">
                Aguarde un momento por favor...<br>
                <i class="fa fa-refresh fa-spin" style="font-size: 2em"></i>
            </div>

            <div class="table-responsive" id="div-table-tickets">
                <table class="table" id="table-tickets">
                    <thead>
                        <tr style="background-color: #404a6b">
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

@section('js')

    <script src="{{ asset('js/sin_foto.js') }}"></script>
    <script>

        $(document).ready(function() {
            $('#table-tickets').DataTable({
                "language": {
                    "lengthMenu": "Mostrar _MENU_ registros por página",
                    "zeroRecords": "No se encontraron resultados",
                    "info": "Mostrando _PAGE_ de _PAGES_",
                    "emptyTable": "Sin datos disponibles",
                    "infoEmpty": "Sin registros",
                    "infoFiltered": "(filtrado de _MAX_ registros totales)",
                    "search": "<i class='fa fa-search'></i> buscar",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                }
            });
            $("#div-table-tickets").show();
            $(".overlay").hide();



        });



    </script>

@endsection

