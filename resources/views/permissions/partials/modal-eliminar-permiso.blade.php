<div class="modal fade col-lg-4 col-lg-offset-4" id="eliminarPermiso{!! $permiso->id !!}">
    <div class="card">
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
            {!! Form::open(['route'  => ['permissions.destroy', $permiso->id], 'method' => 'delete']) !!}
                <button type="submit" class="btn btn-danger">Eliminar de todos modos</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
            {!! Form::close() !!}
        </div>
    </div>
</div>