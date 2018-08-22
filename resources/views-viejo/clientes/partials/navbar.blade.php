<nav class="navbar navbar-default small">
    <div class="col-lg-10 col-lg-offset-1">
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
                @permission('listado.cliente')
                <li>
                    <a href="{{ route('clientes.index') }}"><i class="fa fa-home"></i> </a>
                </li>
                @endpermission
                <li>
                @permission('ver.cliente')
                    <a href="{{ route('clientes.show', $cliente->id) }}" class="{{ (Request::is('clientes/'.'*'.'/datos') ? 'navbar-item-selected' : '') }}">
                        Datos
                    </a>
                @endpermission
                </li>
                @permission('ver.compras.cliente')
                <li>
                    <a href="{{ route('clientes.compras', $cliente->id) }}" class="{{ (Request::is('clientes/'.'*'.'/compras'.'*') ? 'navbar-item-selected' : '') }}">
                        Compras ({!! count($cliente->ventas) !!})
                    </a>
                </li>
                @endpermission
                @permission('ver.llamadas.cliente')
                <li>
                    <a href="{{ route('clientes.llamadas', $cliente->id) }}" class="{{ (Request::is('clientes/'.'*'.'/llamadas'.'*') ? 'navbar-item-selected' : '') }}">
                        Llamadas ({!! count($cliente->llamadas) !!})
                    </a>
                </li>
                @endpermission
                @permission('ver.reclamos.cliente')
                <li>
                    <a href="{{ route('clientes.reclamos', $cliente->id) }}" class="{{ (Request::is('clientes/'.'*'.'/reclamos'.'*') ? 'navbar-item-selected' : '') }}">
                        Reclamos ({!! count($cliente->reclamos) !!})
                    </a>
                </li>
                @endpermission
                @permission('ver.intereses.cliente')
                <li>
                    <a href="{{ route('clientes.intereses', $cliente->id) }}" class="{{ (Request::is('clientes/'.'*'.'/intereses'.'*') ? 'navbar-item-selected' : '') }}">
                        Intereses
                    </a>
                </li>
                @endpermission
            </ul>
        </div>
    </div>
</nav>
