<div class="card">
    <div class="card-header">
        <h3>Listado de asignaciones actuales</h3>
        <hr>
    </div>
    <div class="card-body">
        <div class="table-responsive" id="div-table-asignaciones-actuales">

            <table class="table table-vertical dataTable" id="table-asignaciones-actuales">

                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Supervisor</th>
                        <th>Operador</th>
                        <th>Dato</th>
                        <th>Opciones</th>
                    </tr>
                </thead>
                <tbody>

                @foreach($asignaciones as $asignacion)

                        <tr>
                            <td>{!! $asignacion->id !!}</td>
                            <td>{!! $asignacion->supervisor->full_name !!}</td>
                            <td>{!! $asignacion->operador->full_name !!}</td>
                            <td>{!! $asignacion->cliente->full_name !!}</td>
                            <td>

                                <button type="button" title="BORRAR ASINGACION" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#borrarAsignacion{!! $asignacion->id !!}" >borrar</button>
                                <div class="modal fade col-lg-3 col-md-4 col-sm-6 col-lg-offset-9 col-md-offset-8 col-sm-offset-6" id="borrarAsignacion{!! $asignacion->id !!}">

                                    <div class="card alert text-left">
                                        <div class="card-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="card-title">Borrar asignación</h4>
                                        </div>
                                        <div class="card-body">

                                            <p>¿Desea borrar la asignación seleccionada?</p>

                                        </div>
                                        <div class="card-footer" style="margin-top: 20px">

                                            {!! Form::open(['url' => route('asignaciones.destroy', $asignacion->id), 'method' => 'delete']) !!}
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-danger">Borrar</button>
                                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                                </div>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>

                                </div>

                            </td>
                        </tr>

                @endforeach

                </tbody>
            </table>

        </div>
    </div>
</div>