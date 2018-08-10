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
            <th>Teléfono</th>
            <th>DNI</th>
            <th>Estado</th>
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>

        @foreach($newUsers as $user)

            <tr>
                <td>{!! $user->id !!}</td>
                <td>{!! $user->full_name !!}</td>
                <td class="text-center">@include('users.partials.labels-roles')</td>
                <td>{!! $user->email !!}</td>
                <td>{!! $user->telefono !!}</td>
                <td>{!! $user->dni !!}</td>
                <td>{!! $user->estado->nombre !!}</td>
                <td class="text-center">

                @permission('cambiar.estado.usuario')
                    <button type="button" title="HABILITAR" class="nonStyledButton" data-toggle="modal" data-target="#enableUser{!! $user->id !!}" >
                        <i class="fa fa-toggle-off"></i>
                    </button>
                    <div class="modal fade" id="enableUser{!! $user->id !!}">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Habilitar usuario</h4>
                                </div>
                                <div class="modal-body">
                                    <p>¿Desea habilitar el usuario '{!! $user->full_name !!}'?</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                                    <a href="{{ route('users.change.state', $user->id) }}" class="btn btn-primary" title="DESHABILITAR">Habilitar</a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endpermission

                </td>
            </tr>

        @endforeach

        </tbody>
    </table>



</div>
