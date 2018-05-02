<nav class="navbar navbar-default">
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li><a href="{{ route('reclamos.index') }}" class="{{ (Request::is('reclamos') ? 'navbar-item-selected' : '') }}">Todos</a></li>
            <li><a href="{{ route('reclamos.index.productos') }}" class="{{ (Request::is('reclamos/productos'.'*') ? 'navbar-item-selected' : '') }}">Por producto</a></li>
            <li><a href="{{ route('reclamos.index.clientes') }}" class="{{ (Request::is('reclamos/clientes'.'*') ? 'navbar-item-selected' : '') }}">Por cliente</a></li>
        </ul>
    </div>
</nav>