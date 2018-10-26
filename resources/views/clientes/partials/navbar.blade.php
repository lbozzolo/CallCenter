
<ul class="list-inline panel panel-barra">
    @permission('listado.cliente')
    <li>
        <a href="{{ route('clientes.index') }}"><i class="fa fa-home"></i> </a>
    </li>
    @endpermission
    <li>
    @permission('ver.cliente')
        <a href="{{ route('clientes.show', $cliente->id) }}" class="{{ (Request::is('clientes/'.'*'.'/datos') ? 'navbar-item-selected' : '') }}">
            Datos personales
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
