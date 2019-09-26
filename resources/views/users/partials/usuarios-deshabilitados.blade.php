<div class="overlay col-lg-12 text-center" style="padding: 100px; border: 1px solid lightgrey; border-radius: 5px">
    Aguarde un momento por favor...<br>
    <i class="fa fa-refresh fa-spin" style="font-size: 2em"></i>
</div>
<div class="table-responsive" id="div-table-disable-users" style="display: none">

    <table class="table table-vertical dataTable" id="table-disable-users">
        <thead>
        <tr>
            <th>Id</th>
            <th>Nombre</th>
            <th class="text-center">Roles</th>
            <th>Email</th>
            {{--<th>Teléfono</th>--}}
            {{--<th>DNI</th>--}}
            <th>Sucursales</th>
            <th class="text-center">Opciones</th>
        </tr>
        </thead>
        <tbody>

        @foreach($disableUsers as $user)

            <tr>
                <td>{!! $user->id !!}</td>
                <td>{!! $user->full_name !!}</td>
                <td class="text-center">@include('users.partials.labels-roles')</td>
                <td>{!! $user->email !!}</td>
                <td>
                    <ul>
                        @forelse($user->sucursales as $sucursal)
                            <li><span class="label label-default">{!! $sucursal->nombre !!}</span></li>
                        @empty
                            <small class="text-muted">Ninguna</small>
                        @endforelse
                    </ul>
                </td>
                {{--<td>{!! $user->telefono !!}</td>--}}
                {{--<td>{!! $user->dni !!}</td>--}}
                <td class="text-center">

                @permission('cambiar.estado.usuario')
                    <button type="button" title="HABILITAR" class="btn btn-primary btn-xs" data-toggle="modal" data-target="#enableUser{!! $user->id !!}" >
                        <i class="fa fa-toggle-off"></i>
                    </button>
                    <div class="modal fade col-lg-3 col-lg-offset-9 text-left" id="enableUser{!! $user->id !!}">
                        <div class="card">
                            <div class="card-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Habilitar usuario</h4>
                            </div>
                            <div class="card-body">
                                <p>¿Desea habilitar el usuario '{!! $user->full_name !!}'?</p>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('users.change.state', $user->id) }}" class="btn btn-primary" title="DESHABILITAR">Habilitar</a>
                                <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>
                @endpermission

                @permission('ver.updateable')
                    <a href="{{ route('updateables.entidad.show', ['entity' => $user->getClass(), 'id' => $user->id]) }}" class="btn btn-updateable btn-xs" title="movimientos"><i class="fa fa-info-circle"></i> </a>
                @endpermission

                </td>
            </tr>

        @endforeach

        </tbody>
    </table>



</div>
