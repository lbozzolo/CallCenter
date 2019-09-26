<div class="overlay col-lg-12 text-center" style="padding: 100px; border: 1px solid lightgrey; border-radius: 5px">
    Aguarde un momento por favor...<br>
    <i class="fa fa-refresh fa-spin" style="font-size: 2em"></i>
</div>
<div class="table-responsive" id="div-table-reclamos" style="display: none">

    <table class="table table-vertical dataTable" id="table-sucursales">

        <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th>Dirección</th>
            <th>Teléfono</th>
            <th>Estado</th>
            <th class="text-right">Opciones</th>
        </tr>
        </thead>
        <tbody>

        @foreach($sucursales as $sucursal)

            <tr>
                <td>{!! $sucursal->id !!}</td>
                <td>{!! $sucursal->nombre !!}</td>
                <td>{!! $sucursal->direccion !!}</td>
                <td>{!! $sucursal->telefono !!}</td>
                <td>
                    @if($sucursal->estado == 0)
                        <span class="label label-danger">inactiva</span>
                    @elseif($sucursal->estado == 1)
                        <span class="label label-success">activa</span>
                    @endif
                </td>
                <td class="text-center">

                    <a href="{{ route('sucursales.edit', ['id' => $sucursal->id]) }}" class="btn btn-primary btn-xs" title="Editar"><i class="glyphicon glyphicon-edit"></i> </a>

                    <button type="button" title="ELIMINAR" class="btn btn-danger btn-xs" data-toggle="modal" data-target="#eliminarSucursal{!! $sucursal->id !!}" >
                        <i class="fa fa-trash-o"></i>
                    </button>
                    <div class="modal fade col-lg-4 col-lg-offset-4" id="eliminarSucursal{!! $sucursal->id !!}">

                            <div class="card card-alert">
                                <div class="card-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title"><i class="fa fa-warning "></i> Eliminar sucursal</h4>
                                </div>
                                <div class="card-body">
                                    <p>
                                        Usted está a punto de elminar esta sucursal<br>
                                        <em class="text-danger">{!! $sucursal->nombre !!}</em>
                                    </p>
                                    <p>¿Desea continuar?</p>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                                    <a href="{!! route('sucursales.destroy', $sucursal->id) !!}" class="btn btn-danger">Eliminar</a>
                                </div>
                            </div>

                    </div>

                    <a href="{{ route('updateables.entidad.show', ['entity' => $sucursal->getClass(), 'id' => $sucursal->id]) }}" class="btn btn-updateable btn-xs" title="movimientos"><i class="fa fa-info-circle"></i> </a>

                </td>
            </tr>

        @endforeach

        </tbody>
    </table>



</div>
