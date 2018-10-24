<ul class="list-inline panel panel-barra">

    @permission('listado.producto')
        <li><a href="{{ route('productos.index') }}" class="{{ (Request::is('productos') ? 'navbar-item-selected' : '') }}">Activos</a></li>
    @endpermission

    @permission('listado.producto')
        <li><a href="{{ route('productos.index.inactivos') }}" class="{{ (Request::is('productos/inactivos') ? 'navbar-item-selected' : '') }}">Inactivos</a></li>
    @endpermission

    @permission('crear.producto')
        <li><a href="{{ route('productos.create') }}"><span class="text-primary"><i class="fa fa-plus"></i> Agregar</span></a></li>
    @endpermission

</ul>