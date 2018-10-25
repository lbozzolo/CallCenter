<ul class="list-inline panel panel-barra">
    <li><a href="{{ route('roles.index') }}"class="{{ (Request::is('roles'.'*') ? 'navbar-item-selected' : '') }}">Roles</a></li>
    <li><a href="{{ route('permissions.index') }}"class="{{ (Request::is('permisos'.'*') ? 'navbar-item-selected' : '') }}">Permisos</a></li>
</ul>
