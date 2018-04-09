<div class="modal fade" id="eliminarPermiso{!! $permiso->id !!}">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title"><i class="fa fa-warning "></i> Eliminar permiso</h4>
            </div>
            <div class="modal-body">
                <p class="text-danger">
                    Usted está a punto de eliminar el permiso '{!! $permiso->name !!}' devinitivamente<br>
                    Al hacerlo puede ocasionar problemas al sistema.
                </p>
                <p>¿Desea continuar?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                {!! Form::open(['route'  => ['permissions.destroy', $permiso->id], 'method' => 'delete']) !!}
                <button type="submit" class="btn btn-danger pull-right">Eliminar de todos modos</button>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>