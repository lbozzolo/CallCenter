@foreach($user->roles as $role)

    @if($role->slug == 'superadmin')
        <label class="label label-info">{!! $role->name !!}</label><br>
    @elseif($role->slug == 'admin')
        <label class="label label-warning">{!! $role->name !!}</label><br>
    @elseif($role->slug == 'supervisor')
        <label class="label label-success">{!! $role->name !!}</label><br>
    @elseif($role->slug == 'operador.in')
        <label class="label label-warning" style="background-color: orangered;">{!! $role->name !!}</label><br>
    @elseif($role->slug == 'operador.out')
        <label class="label label-success" style="background-color: rgb(211, 8, 84);">{!! $role->name !!}</label><br>
    @elseif($role->slug == 'atencion.al.cliente')
        <label class="label label-primary" style="background-color: rgb(145, 130, 29);">{!! $role->name !!}</label><br>
    @elseif($role->slug == 'logistica')
        <label class="label label-default">{!! $role->name !!}</label><br>
    @elseif($role->slug == 'auditor')
        <label class="label label-danger">{!! $role->name !!}</label><br>
    @else

        <label class="small">{!! $role->name !!}</label><br>
    @endif

@endforeach