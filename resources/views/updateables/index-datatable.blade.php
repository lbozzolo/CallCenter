@extends('updateables.base')

@section('titulo')

    <h2>
        Movimientos /
        <span class="text-warning">  {!! $entidad !!}</span>
    </h2>

@endsection

@section('contenido')

    <div class="card">
        <div class="card-body">

            <div class="card-header">
                <div class="row">

                    @include('updateables.partials.entidades')

                </div>
            </div>

            @if($results)

            <div class="overlay col-lg-12 text-center" style="padding: 100px; border: 1px solid lightgrey; border-radius: 5px">
                Aguarde un momento por favor...<br>
                <i class="fa fa-refresh fa-spin" style="font-size: 2em"></i>
            </div>
            <div class="table-responsive" id="div-table-updateables" style="display: block">

                <table class="table table-vertical dataTable" id="table-updateables">

                    <thead>
                        <tr>
                            <th>Actor</th>
                            <th class="text-center">Identificador</th>
                            <th>Modelo</th>
                            <th>Acción</th>
                            <th>Campo</th>
                            <th>Valor anterior</th>
                            <th>Valor actualizado</th>
                            <th class="text-center">Motivo</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                        </tr>
                    </thead>
                    <tbody>

                    @foreach($results as $item)

                        <tr>
                            <td><a href="{{ route('users.profile', $item->author->id) }}" style="color: cyan">{!! $item->author->fullname !!}</a></td>
                            <td class="text-center">{!! $item->updateable_id !!}</td>
                            <td>{!! ($item->updateable_type)? $item->updateable_type : '-' !!}</td>
                            <td>{!! ($item->action)? $item->action : '-' !!}</td>
                            <td>{!! ($item->field)? $item->field : '-' !!}</td>
                            <td class="text-center">{!! ($item->former_value)? $item->former_value : '-' !!}</td>
                            <td class="text-center">{!! ($item->updated_value)? $item->updated_value : '-' !!}</td>
                            <td class="text-center">{!! ($item->reason)? $item->reason : '-' !!}</td>
                            <td>{!! $item->fecha_creado !!}</td>
                            <td>{!! $item->hora_created !!} hs</td>
                        </tr>

                    @endforeach

                    </tbody>
                </table>


            </div>

            @else

                <p>No hay resultados</p>

            @endif

        </div>
    </div>

@endsection

@section('js')

    <script>

        $(document).ready(function() {
            $('#table-updateables').DataTable({
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
            $("#div-table-updateables").show();
            $(".overlay").hide();

        });

    </script>

@endsection