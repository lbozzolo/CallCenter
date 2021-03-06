@extends('updateables.base')

@section('titulo')

    <h2>
        Movimientos
        <span class="text-muted"> / {!! $model->class_name !!} / #{!! $model->id !!}</span>
    </h2>

@endsection

@section('contenido')

    <div class="card">
        <div class="card-body">

            @if($results)

                <div class="overlay col-lg-12 text-center" style="padding: 100px; border: 1px solid lightgrey; border-radius: 5px">
                    Aguarde un momento por favor...<br>
                    <i class="fa fa-refresh fa-spin" style="font-size: 2em"></i>
                </div>
                <div class="table-responsive" id="div-table-updateables" style="display: block">

                    <table class="table table-vertical dataTable" id="table-updateables">

                        <thead>
                        <tr>
                            <th>Fecha y hora</th>
                            <th>Actor</th>
                            <th>Acción</th>
                            <th class="text-center">Identificador</th>
                            <th>Campo</th>
                            <th>Valor anterior</th>
                            <th>Valor actualizado</th>
                            <th class="text-center">Motivo</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($results as $item)


                            <tr>
                                <td>
                                    {!! $item->fecha_creado !!}
                                    {!! $item->hora_created !!} hs
                                </td>
                                <td><a href="{{ route('users.profile', $item->author->id) }}" style="color: cyan">{!! $item->author->fullname !!}</a></td>
                                <td>
                                    <span class="label label-default">{!! $item->actionSpanish($item->action) !!}</span>
                                    @if($item->related_model_id)
                                        {!! ucfirst($item->related_model_type) !!}
                                        <span class="text-warning"># {!! $item->related_model_id !!}</span>
                                    @endif
                                </td>
                                <td class="text-center">
                                    {!! ucfirst($item->updateable_type) !!}
                                    <span class="text-warning"># {!! $item->updateable_id !!}</span>
                                </td>
                                <td>{!! ($item->field)? $item->field : '-' !!}</td>
                                <td class="text-center">
                                    @if($item->field == 'localidad')
                                        {!! \SmartLine\Entities\Localidad::find($item->former_value)->localidad !!}
                                    @elseif($item->field == 'partido')
                                        {!! \SmartLine\Entities\Partido::find($item->former_value)->partido !!}
                                    @elseif($item->field == 'provincia')
                                        {!! \SmartLine\Entities\Provincia::find($item->former_value)->provincia !!}
                                    @else
                                        {!! ($item->former_value)? $item->former_value : '-' !!}
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($item->field == 'localidad')
                                        {!! \SmartLine\Entities\Localidad::find($item->updated_value)->localidad !!}
                                    @elseif($item->field == 'partido')
                                        {!! \SmartLine\Entities\Partido::find($item->updated_value)->partido !!}
                                    @elseif($item->field == 'provincia')
                                        {!! \SmartLine\Entities\Provincia::find($item->updated_value)->provincia !!}
                                    @else
                                        {!! ($item->updated_value)? $item->updated_value : '-' !!}
                                    @endif
                                </td>
                                <td class="text-center">{!! ($item->reason)? $item->reason : '-' !!}</td>
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