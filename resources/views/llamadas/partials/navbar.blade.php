<nav class="navbar navbar-default">
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li><a href="{{ route('llamadas.index') }}" class="{{ (Request::is('llamadas/salientes'.'*') ? 'navbar-item-selected' : '') }}">Salientes</a></li>
            <li><a href="{{ route('llamadas.index.entrantes') }}" class="{{ (Request::is('llamadas/entrantes'.'*') ? 'navbar-item-selected' : '') }}">Entrantes</a></li>
            <li><a href="{{ route('llamadas.index.entrantes') }}" class="{{ (Request::is('llamadas/llamar'.'*') ? 'navbar-item-selected' : '') }}"><i class="fa fa-phone-square text-success"></i> Llamar</a></li>
            <li><a href="{{ route('llamadas.index.reclamos') }}" class="{{ (Request::is('llamadas/reclamos'.'*') ? 'navbar-item-selected' : '') }}">Reclamos</a></li>
        </ul>
    </div>
</nav>