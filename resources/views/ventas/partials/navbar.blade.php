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
            <li><a href="{{ route('ventas.index') }}">Todas</a></li>
            <li><a href="{{ route('ventas.index', 'auditada') }}">Auditadas</a></li>
            <li><a href="{{ route('ventas.index', 'confirmada') }}">Confirmadas</a></li>
            <li><a href="{{ route('ventas.index', 'rechazada') }}">Rechazadas</a></li>
            <li><a href="{{ route('ventas.index', 'cobrada') }}">Cobradas</a></li>
            <li><a href="{{ route('ventas.index', 'facturada') }}">Facturadas</a></li>
            <li><a href="{{ route('ventas.index', 'enviada') }}">Enviadas</a></li>
            <li><a href="{{ route('ventas.index', 'entregado') }}">Entregadas</a></li>
            <li><a href="{{ route('ventas.index', 'noentregado') }}">No entregadas</a></li>
            <li><a href="{{ route('ventas.index', 'devuelto') }}">Devueltas</a></li>
        </ul>
    </div>
</nav>
