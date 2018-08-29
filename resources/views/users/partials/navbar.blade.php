
<ul class="list-inline">
    
    @permission('listado.usuario')
    <li><a href="{{ route('users.index') }}">Habilitados</a></li>
    <li><a href="{{ route('users.index.disable') }}">Deshabilitados</a></li>
    @endpermission

    @permission('listado.usuarios.nuevos')
    <li><a href="{{ route('users.index.nuevos') }}">Nuevos</a></li>
    @endpermission

    @permission('crear.usuario')
    <li><a href="{{ route('users.create') }}"><span class="text-primary"><i class="fa fa-user-plus"></i> Agregar</span></a></li>
    @endpermission
</ul>
       