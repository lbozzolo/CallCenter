@if($permiso->slug != 'superadmin')
    <button type="button" title="Eliminar" class="pull-right nonStyledButton" data-toggle="modal" data-target="#eliminarPermiso{!! $permiso->id !!}" style="border: none">
        <i class="glyphicon glyphicon-trash small text-danger"></i>
    </button>
    <a href="{{ route('permissions.edit', $permiso->id) }}" class="pull-right nonStyledButton"><i class="glyphicon glyphicon-edit small text-info"></i></a>
@endif