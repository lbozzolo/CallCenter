@section('css')

    <style type="text/css">
        .sinfoto{
            background-color: #1b6d85;
            color: whitesmoke;
            display: inline-block;
            width: 30px;
            height: 30px;
            padding: 5px;
            -webkit-border-radius: 15px;
            -moz-border-radius: 15px;
            border-radius: 15px;
        }
    </style>

@endsection

<div class="overlay col-lg-12 text-center" style="padding: 100px; border: 1px solid lightgrey; border-radius: 5px">
    Aguarde un momento por favor...<br>
    <i class="fa fa-refresh fa-spin" style="font-size: 2em"></i>
</div>
<div class="table-responsive" id="div-table-enable-users" style="display: none">

    <table class="table table-vertical dataTable" id="table-enable-users">

        <thead>
            <tr>
                <th></th>
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
                <td>
                    @if($user->profile_image)
                        <img src="{{ route('imagenes.ver', $user->profile_image) }}" class="img-circle " style="object-fit: cover; width: 30px; height: 30px">
                    @else
                        <span class="sinfoto text-center">
                            <small>{{ strtoupper(substr($user->nombre,0,2)) }}</small>
                        </span>
                    @endif
                </td>
                <td>{!! $user->id !!}</td>
                <td>
                @permission('ver.usuario')
                    <a href="{{ route('users.profile', $user->id) }}">{!! $user->full_name !!}</a>
                @elsepermission
                    {!! $user->full_name !!}
                @endpermission
                </td>
                <td class="text-center">@include('users.partials.labels-roles')</td>
                <td>{!! $user->email !!}</td>
                <td>{!! ($user->telefono)? $user->telefono : '---' !!}</td>
                <td>{!! ($user->dni)? $user->dni : '---' !!}</td>
                <td>{!! $user->estado->nombre !!}</td>
                <td class="text-center">

                @permission('cambiar.estado.usuario')
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
                @endpermission

                @permission('editar.usuario')
                    <a href="{{ route('users.edit', ['id' => $user->id, 'route' => 'users.index']) }}"><i class="glyphicon glyphicon-edit"></i></a>
                @endpermission

                @permission('editar.permisos.usuario')
                    <a href="{{ route('users.permissions', $user->id) }}"><i class="fa fa-file-powerpoint-o"></i></a>
                @endpermission

                </td>
            </tr>

        @endforeach

        </tbody>
    </table>



</div>