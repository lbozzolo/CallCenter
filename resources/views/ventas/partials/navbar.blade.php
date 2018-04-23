<nav class="navbar navbar-default">
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
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
            {{--<li><a href="{{ route('ventas.index') }}"><label class="label estadoVentas" data-estado="iniciada"> Iniciadas</label></a></li>
            <li><a href="{{ route('ventas.index') }}"><label class="label estadoVentas" data-estado="auditada"> Auditadas</label></a></li>
            <li><a href="{{ route('ventas.index') }}"><label class="label estadoVentas" data-estado="confirmada"> Confiramdas</label></a></li>
            <li><a href="{{ route('ventas.index') }}"><label class="label estadoVentas" data-estado="rechazada"> Rechazadas</label></a></li>
            <li><a href="{{ route('ventas.index') }}"><label class="label estadoVentas" data-estado="cobrada"> Cobradas</label></a></li>
            <li><a href="{{ route('ventas.index') }}"><label class="label estadoVentas" data-estado="facturada"> Facturadas</label></a></li>
            <li><a href="{{ route('ventas.index') }}"><label class="label estadoVentas" data-estado="enviada"> Enviadas</label></a></li>
            <li><a href="{{ route('ventas.index') }}"><label class="label estadoVentas" data-estado="entregado"> Entregadas</label></a></li>
            <li><a href="{{ route('ventas.index') }}"><label class="label estadoVentas" data-estado="no.entregado"> No entregadas</label></a></li>
            <li><a href="{{ route('ventas.index') }}"><label class="label estadoVentas" data-estado="devuelto"> Devueltas</label></a></li>--}}
        </ul>
    </div>
</nav>