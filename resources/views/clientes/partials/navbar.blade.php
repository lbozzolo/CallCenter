<nav class="navbar navbar-default">
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
            <li><a href="{{ route('clientes.show', $cliente->id) }}" class="{{ (Request::is('clientes/') ? 'navbar-item-selected' : '') }}">Datos</a></li>
            <li><a href="{{ route('clientes.compras', $cliente->id) }}" class="{{ (Request::is('clientes/'.'*'.'/compras'.'*') ? 'navbar-item-selected' : '') }}">Compras</a></li>
            <li><a href="{{ route('clientes.llamadas', $cliente->id) }}" class="{{ (Request::is('clientes/'.'*'.'/llamadas'.'*') ? 'navbar-item-selected' : '') }}">Llamadas</a></li>
            <li><a href="">Reclamos</a></li>
            <li><a href="">Intereses</a></li>
        </ul>
    </div>
</nav>