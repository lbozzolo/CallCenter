<div class="overlay col-lg-12 text-center" style="padding: 100px; border: 1px solid lightgrey; border-radius: 5px">
    Aguarde un momento por favor...<br>
    <i class="fa fa-refresh fa-spin" style="font-size: 2em"></i>
</div>
<div class="table-responsive" id="div-table-enable-users" style="display: none">

    <table class="table table-vertical dataTable" id="table-enable-users">

        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th class="text-center">Roles</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>DNI</th>
                <th>Estado</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>

        @foreach($users as $user)

            <tr>
                <td>{!! $user->id !!}</td>
                <td>
                    <a href="{{ route('users.profile', $user->id) }}">{!! $user->full_name !!}</a>
                </td>
                <td class="text-center">@include('users.partials.labels-roles')</td>
                <td>{!! $user->email !!}</td>
                <td>{!! $user->telefono !!}</td>
                <td>{!! $user->dni !!}</td>
                <td>{!! $user->estado->nombre !!}</td>
                <td class="text-center">

                    <button type="button" title="DESHABILITAR" class="nonStyledButton" data-toggle="modal" data-target="#disableUser{!! $user->id !!}" >
                        <i class="fa fa-toggle-on text-danger"></i>
                    </button>
                    <div class="modal fade" id="disableUser{!! $user->id !!}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title"><i class="fa fa-warning "></i> Deshabilitar usuario</h4>
                                </div>
                                <div class="modal-body">
                                    <p>
                                        Usted está a punto de deshabilitar al usuario<br>
                                        <em class="text-danger">{!! $user->full_name !!}</em>
                                    </p>
                                    <p>¿Desea continuar?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                                    <a href="{{ route('users.change.state', $user->id) }}" class="btn btn-danger" title="DESHABILITAR">Deshabilitar</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <a href="{{ route('users.edit', ['id' => $user->id, 'route' => 'users.index']) }}"><i class="glyphicon glyphicon-edit"></i></a>
                    <a href="{{ route('users.permissions', $user->id) }}"><i class="fa fa-file-powerpoint-o"></i></a>

                </td>
            </tr>

        @endforeach

        </tbody>
    </table>



</div>
