
<h3>Roles actuales</h3>

<ul class="list-group">
    @if(isset($role))
        <li class="list-group-item text-center">
            <a href="{{ route('roles.index') }}"  class="btn btn-sm btn-default">Agregar nuevo rol</a>
        </li>
    @endif
    @foreach($roles as $role)
        <li class="list-group-item">
            @if($role->slug != 'superadmin')
                <button type="button" title="Eliminar" class="pull-right nonStyledButton" data-toggle="modal" data-target="#eliminarRol{!! $role->id !!}" style="border: none">
                    <i class="glyphicon glyphicon-trash small text-danger"></i>
                </button>
                <a href="{{ route('roles.edit', $role->id) }}" class="pull-right nonStyledButton"><i class="glyphicon glyphicon-edit small text-info"></i></a>
            @endif
            <a href="{{ route('roles.permissions', $role->id) }}" style="display: block; padding: 10px 20px; margin: 0px">
                <strong>{!! $role->name !!} ({!! $role->slug !!}) - </strong>Nivel {!! $role->level !!}<br>
                <small>{!! $role->description !!}</small>
            </a>
        </li>

        <div class="modal fade" id="eliminarRol{!! $role->id !!}">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title"><i class="fa fa-warning "></i> Eliminar rol</h4>
                    </div>
                    <div class="modal-body">
                        <p class="text-danger">
                            Usted está a punto de eliminar el rol de '{!! $role->name !!}' devinitivamente<br>
                            Al hacerlo puede ocasionar problemas al sistema.
                        </p>
                        <p>¿Desea continuar?</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                        {!! Form::open(['route'  => ['roles.destroy', $role->id], 'method' => 'delete']) !!}
                        {!! Form::hidden('role_id', $role->id) !!}
                        <button type="submit" class="btn btn-danger pull-right">Eliminar de todos modos</button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>

    @endforeach

</ul>