<ul class="nav navbar-nav">
@permission('listado.reclamo')
    <li><a href="{{ route('reclamos.index') }}" class="{{ (Request::is('reclamos') ? 'navbar-item-selected' : '') }}">Todos</a></li>
    <li><a href="{{ route('reclamos.index.productos') }}" class="{{ (Request::is('reclamos/productos'.'*') ? 'navbar-item-selected' : '') }}">Por producto</a></li>
    <li><a href="{{ route('reclamos.index.clientes') }}" class="{{ (Request::is('reclamos/clientes'.'*') ? 'navbar-item-selected' : '') }}">Por cliente</a></li>
@endpermission

</ul>
