<div class="card">
    <div class="card-header">
        <h3>Listado de datos a asignar</h3>
        <hr>
    </div>
    <div class="card-body">

        <div class="overlay col-lg-12 text-center" style="padding: 100px; border: 1px solid lightgrey; border-radius: 5px">
            Aguarde un momento por favor...<br>
            <i class="fa fa-refresh fa-spin" style="font-size: 2em"></i>
        </div>
        <div class="table-responsive" id="div-table-clientes" style="display: none;">

            {!! Form::open(['url' => route('asignaciones.seleccion.supervisor'), 'method' => 'post']) !!}

            <button type="submit" class="btn btn-primary pull-right" style="margin-bottom: 5px">Aceptar datos seleccionados</button>
            <table class="table table-vertical dataTable" id="table-clientes">

                <thead>
                <tr>
                    <th>Id</th>
                    <th>Nombre</th>
                    <th>DNI</th>
                    <th>Asignado por...</th>
                    <th>Asignado a...</th>
                    <th>Última acción</th>
                    <th class="text-center">Reclamos</th>
                    <th>Seleccionar</th>
                </tr>
                </thead>
                <tbody>

                @foreach($clientes as $cliente)

                    @if($cliente->asignacion_actual)
                    <tr style="background-color:gray">
                    @else
                    <tr>
                    @endif
                        <td>{!! $cliente->id !!}</td>
                        <td>
                            {!! $cliente->full_name !!}
                        </td>
                        <td>{!! ($cliente->dni)? $cliente->dni : "<span class='label label-danger'>sin dni</span><i class='fa fa-exclamation-circle'></i>" !!}</td>
                        <td>{!! ($cliente->asignacion_actual)? $cliente->asignacion_actual->supervisor->fullname : '<small class="text-muted">sin asignar</small>' !!}</td>
                        <td>{!! ($cliente->asignacion_actual)? $cliente->asignacion_actual->operador->fullname : '<small class="text-muted">sin asignar</small>' !!}</td>
                        <td>{!! ($cliente->ultima_accion)? $cliente->ultima_accion : '--' !!}</td>
                        <td class="text-center">{!! count($cliente->reclamos) !!}</td>
                        <td>
                            @if($cliente->asignacionActual() && $cliente->asignacionActual()->motivo_id != null)
                                <em style="color: darkred">a reasignar</em>
                            @else
                                @if(isset($datosModificar))
                                    {!! Form::checkbox('clientes[]', $cliente->id,  (in_array($cliente->id, $datosModificar))? true : false, ['style' => 'font-size: 2em']) !!}
                                @else
                                    {!! Form::checkbox('clientes[]', $cliente->id,  false, ['style' => 'font-size: 2em']) !!}
                                @endif
                            @endif
                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>

            {!! Form::close() !!}


        </div>


    </div>
</div>

