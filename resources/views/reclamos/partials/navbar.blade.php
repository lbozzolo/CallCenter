<ul class="list-inline panel panel-barra">
@permission('listado.reclamo')
    <li><a href="{{ route('reclamos.index') }}" class="{{ (Request::is('reclamos') ? 'navbar-item-selected' : '') }}">Abiertos</a></li>
    <li><a href="{{ route('reclamos.index', 'cerrado') }}" class="{{ (Request::is('reclamos/cerrado') ? 'navbar-item-selected' : '') }}">Cerrados</a></li>
    <li><a href="{{ route('reclamos.index.productos') }}" class="{{ (Request::is('reclamos/productos'.'*') ? 'navbar-item-selected' : '') }}">Por producto</a></li>
    <li><a href="{{ route('reclamos.index.clientes') }}" class="{{ (Request::is('reclamos/clientes'.'*') ? 'navbar-item-selected' : '') }}">Por cliente</a></li>
@endpermission
</ul>
