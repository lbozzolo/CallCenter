<nav class="navbar navbar-default small">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-2">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
    </div>
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-2">
        <ul class="nav navbar-nav">
            <li><a href="{{ route('reclamos.index') }}" class="{{ (Request::is('reclamos') ? 'navbar-item-selected' : '') }}">Todos</a></li>
            <li><a href="{{ route('reclamos.index.productos') }}" class="{{ (Request::is('reclamos/productos'.'*') ? 'navbar-item-selected' : '') }}">Por producto</a></li>
            <li><a href="{{ route('reclamos.index.clientes') }}" class="{{ (Request::is('reclamos/clientes'.'*') ? 'navbar-item-selected' : '') }}">Por cliente</a></li>
        </ul>
    </div>
</nav>