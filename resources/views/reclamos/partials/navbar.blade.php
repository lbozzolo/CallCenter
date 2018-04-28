<nav class="navbar navbar-default">
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li><a href="{{ route('reclamos.index') }}" class="{{ (Request::is('reclamos') ? 'navbar-item-selected' : '') }}">Todos</a></li>
            <li><a href="{{ route('llamadas.index.entrantes') }}" class="{{ (Request::is('llamadas/entrantes'.'*') ? 'bg-info' : '') }}">Default</a></li>
            <li><a href="{{ route('llamadas.index.reclamos') }}" class="{{ (Request::is('llamadas/reclamos'.'*') ? 'bg-info' : '') }}">Default</a></li>
        </ul>
    </div>
</nav>