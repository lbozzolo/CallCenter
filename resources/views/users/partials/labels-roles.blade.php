@foreach($user->roles as $role)

    @if($role->slug == 'superadmin')
        <label class="label label-info">{!! $role->name !!}</label><br>
    @elseif($role->slug == 'admin')
        <label class="label label-warning">{!! $role->name !!}</label><br>
    @elseif($role->slug == 'supervisor')
        <label class="label label-success">{!! $role->name !!}</label><br>
    @elseif($role->slug == 'operador')
        <label class="label label-default">{!! $role->name !!}</label><br>
    @elseif($role->slug == 'auditor')
        <label class="label label-danger">{!! $role->name !!}</label><br>
    @else
        <label class="small">{!! $role->name !!}</label><br>
    @endif

@endforeach