<nav class="navbar navbar-default">
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li><a href="{{ route('clientes.show', $cliente->id) }}">Datos</a></li>
            <li><a href="{{ route('clientes.compras', $cliente->id) }}">Compras</a></li>
            <li><a href="{{ route('clientes.llamadas', $cliente->id) }}">Llamadas</a></li>
            <li><a href="">Reclamos</a></li>
            <li><a href="">Intereses</a></li>
        </ul>
    </div>
</nav>