<div class="card">
    <div class="card-header">
        <h3>Listado de asignaciones actuales</h3>
        <hr>
    </div>
    <div class="card-body">
        <div class="table-responsive" id="div-table-asignaciones-actuales">

            {!! Form::open(['url' => route('asignaciones.seleccion.operador'), 'method' => 'post']) !!}
            <button type="submit" class="btn btn-primary pull-right" style="margin-bottom: 5px">Aceptar datos seleccionados</button>
            <table class="table table-vertical dataTable" id="table-asignaciones-actuales">

                <thead>
                <tr>
                    <th>Id</th>
                    <th>Reasignada por...</th>
                    <th>Reasignada a...</th>
                    <th>Dato</th>
                    <th>Motivo</th>
                    <th class="text-right">Seleccionar</th>
                </tr>
                </thead>
                <tbody>

                @foreach($reasignaciones as $asignacion)

                    <tr>
                        <td>{!! $asignacion->id !!}</td>
                        <td>{!! $asignacion->supervisor->full_name !!}</td>
                        <td>{!! $asignacion->operador->full_name !!}</td>
                        <td>{!! $asignacion->cliente->full_name !!}</td>
                        <td>
                            <span class="label label-default">{!! $asignacion->motivo->motivo !!}</span>
                        </td>
                        <td>

                            @if(isset($datosModificar))
                                {!! Form::checkbox('clientes[]', $asignacion->cliente->id,  (in_array($asignacion->cliente->id, $datosModificar))? true : false, ['style' => 'font-size: 2em']) !!}
                            @else
                                {!! Form::checkbox('clientes[]', $asignacion->cliente->id,  false, ['style' => 'font-size: 2em']) !!}
                            @endif
                            {{--@permission('eliminar.asignacion')--}}
                            {{--<button type="button" title="BORRAR ASINGACION" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#borrarAsignacion{!! $asignacion->id !!}" >borrar</button>--}}
                            {{--<div class="modal fade col-lg-3 col-md-4 col-sm-6 col-lg-offset-9 col-md-offset-8 col-sm-offset-6" id="borrarAsignacion{!! $asignacion->id !!}">--}}

                                {{--<div class="card alert text-left">--}}
                                    {{--<div class="card-header">--}}
                                        {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close">--}}
                                            {{--<span aria-hidden="true">&times;</span></button>--}}
                                        {{--<h4 class="card-title">Borrar asignación</h4>--}}
                                    {{--</div>--}}
                                    {{--<div class="card-body">--}}

                                        {{--<p>¿Desea borrar la asignación seleccionada?</p>--}}

                                    {{--</div>--}}
                                    {{--<div class="card-footer" style="margin-top: 20px">--}}

                                        {{--{!! Form::open(['url' => route('asignaciones.destroy', $asignacion->id), 'method' => 'delete']) !!}--}}
                                        {{--<div class="form-group">--}}
                                            {{--<button type="submit" class="btn btn-danger">Borrar</button>--}}
                                            {{--<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>--}}
                                        {{--</div>--}}
                                        {{--{!! Form::close() !!}--}}
                                    {{--</div>--}}
                                {{--</div>--}}

                            {{--</div>--}}
                            {{--@endpermission--}}

                        </td>
                    </tr>

                @endforeach

                </tbody>
            </table>
        {!! Form::close() !!}
        </div>
    </div>
</div>