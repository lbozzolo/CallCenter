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
            <li><a href="{{ route('ventas.index') }}"><small>Todas</small></a></li>
            <li><a href="{{ route('ventas.index', 'auditada') }}"><small>Auditadas ({!! $total['auditada'] !!})</small></a></li>
            <li><a href="{{ route('ventas.index', 'confirmada') }}"><small>Confirmadas ({!! $total['confirmada'] !!})</small></a></li>
            <li><a href="{{ route('ventas.index', 'rechazada') }}"><small>Rechazadas ({!! $total['rechazada'] !!})</small></a></li>
            <li><a href="{{ route('ventas.index', 'cobrada') }}"><small>Cobradas ({!! $total['cobrada'] !!})</small></a></li>
            <li><a href="{{ route('ventas.index', 'facturada') }}"><small>Facturadas ({!! $total['facturada'] !!})</small></a></li>
            <li><a href="{{ route('ventas.index', 'enviada') }}"><small>Enviadas ({!! $total['enviada'] !!})</small></a></li>
            <li><a href="{{ route('ventas.index', 'entregado') }}"><small>Entregadas ({!! $total['entregado'] !!})</small></a></li>
            <li><a href="{{ route('ventas.index', 'noentregado') }}"><small>No entregadas ({!! $total['noentregado'] !!})</small></a></li>
            <li><a href="{{ route('ventas.index', 'devuelto') }}"><small>Devueltas ({!! $total['devuelto'] !!})</small></a></li>
        </ul>
    </div>
</nav>
