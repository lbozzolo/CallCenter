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
            <li>
                <a href="{{ route('clientes.index') }}"><i class="fa fa-home"></i> </a>
            </li>
            <li>
                <a href="{{ route('clientes.show', $cliente->id) }}" class="{{ (Request::is('clientes/'.'*'.'/datos') ? 'navbar-item-selected' : '') }}">
                    Datos
                </a>
            </li>
            <li>
                <a href="{{ route('clientes.compras', $cliente->id) }}" class="{{ (Request::is('clientes/'.'*'.'/compras'.'*') ? 'navbar-item-selected' : '') }}">
                    Compras ({!! count($cliente->ventas) !!})
                </a>
            </li>
            <li>
                <a href="{{ route('clientes.llamadas', $cliente->id) }}" class="{{ (Request::is('clientes/'.'*'.'/llamadas'.'*') ? 'navbar-item-selected' : '') }}">
                    Llamadas ({!! count($cliente->llamadas) !!})
                </a>
            </li>
            <li>
                <a href="{{ route('clientes.reclamos', $cliente->id) }}" class="{{ (Request::is('clientes/'.'*'.'/reclamos'.'*') ? 'navbar-item-selected' : '') }}">
                    Reclamos ({!! count($cliente->reclamos) !!})
                </a>
            </li>
            <li>
                <a href="{{ route('clientes.intereses', $cliente->id) }}" class="{{ (Request::is('clientes/'.'*'.'/intereses'.'*') ? 'navbar-item-selected' : '') }}">
                    Intereses
                </a>
            </li>
        </ul>
    </div>
</nav>
