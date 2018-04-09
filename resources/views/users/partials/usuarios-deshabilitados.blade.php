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
            <th>Email</th>
            <th>Teléfono</th>
            <th>DNI</th>
            <th>Estado</th>
            <th>Opciones</th>
        </tr>
        </thead>
        <tbody>

        @foreach($disableUsers as $user)

            <tr>
                <td>{!! $user->id !!}</td>
                <td>{!! $user->full_name !!}</td>
                <td>{!! $user->email !!}</td>
                <td>{!! $user->telefono !!}</td>
                <td>{!! $user->dni !!}</td>
                <td>{!! $user->estado->nombre !!}</td>
                <td class="text-center">
                    <a href="{{ route('users.change.state', $user->id) }}" class="btn btn-default btn-xs" title="HABILITAR">habilitar</a>
                </td>
            </tr>

        @endforeach

        </tbody>
    </table>



</div>
