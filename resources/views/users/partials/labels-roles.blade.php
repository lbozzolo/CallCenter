@foreach($user->roles as $role)

    @if($role->slug == 'superadmin')

        <label class="label label-info">{!! $role->name !!}</label><br>

    @elseif($role->slug == 'admin')

        <label class="label label-warning">{!! $role->name !!}</label><br>

    @elseif($role->slug == 'supervisor')

        <label class="label label-success">{!! $role->name !!}</label><br>

    @elseif($role->slug == 'operador.in')

        <label class="label label-operador-in">{!! $role->name !!}</label><br>

    @elseif($role->slug == 'operador.out')

        <label class="label label-operador-out">{!! $role->name !!}</label><br>

    @elseif($role->slug == 'atencion.al.cliente')

        <label class="label label-atencion-al-cliente">{!! $role->name !!}</label><br>

    @elseif($role->slug == 'logistica')

        <label class="label label-logistica">{!! $role->name !!}</label><br>

    @elseif($role->slug == 'auditor')

        <label class="label label-danger">{!! $role->name !!}</label><br>

    @else

        <label class="small">{!! $role->name !!}</label><br>

    @endif

@endforeach