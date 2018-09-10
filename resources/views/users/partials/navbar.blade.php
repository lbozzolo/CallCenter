
<ul class="list-inline">
    
    @permission('listado.usuario')
    <li><a href="{{ route('users.index') }}" class="{{ (Request::is('usuarios') ? 'navbar-item-selected' : '') }}">Habilitados</a></li>
    <li><a href="{{ route('users.index.disable') }}"class="{{ (Request::is('usuarios/deshabilitados') ? 'navbar-item-selected' : '') }}">Deshabilitados</a></li>
    @endpermission

    @permission('listado.usuarios.nuevos')
    <li><a href="{{ route('users.index.nuevos') }}"class="{{ (Request::is('usuarios/nuevos') ? 'navbar-item-selected' : '') }}">Nuevos</a></li>
    @endpermission

    @permission('crear.usuario')
    <li><a href="{{ route('users.create') }}"><span class="text-primary"><i class="fa fa-user-plus"></i> Agregar</span></a></li>
    @endpermission
</ul>
       