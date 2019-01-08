
<div class="table-responsive">

    <table class="table table-vertical dataTable" id="table-enable-users">

        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th class="text-center">Roles</th>
                <th class="text-right">Opciones</th>
            </tr>
        </thead>
        <tbody>

        @foreach($users as $user)

            <tr>
                <td>{!! $user->id !!}</td>
                <td>{!! $user->full_name !!}</td>
                <td class="text-center">
                    @include('users.partials.labels-roles')
                </td>
                <td class="text-center">

                    {!! Form::open(['url' => route('reclamos.derivar', $reclamo->id), 'method' => 'post']) !!}
                        {!! Form::hidden('user_id', $user->id) !!}
                        <button type="submit" class="btn btn-primary btn-sm btn-flat">derivar</button>
                    {!! Form::close() !!}

                </td>
            </tr>

        @endforeach

        </tbody>
    </table>

</div>
