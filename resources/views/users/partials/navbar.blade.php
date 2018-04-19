<nav class="navbar navbar-default">
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li><a href="{{ route('users.index') }}">Habilitados</a></li>
            <li><a href="{{ route('users.index.disable') }}">Deshabilitados</a></li>
            <li><a href="{{ route('users.index.nuevos') }}">Nuevos</a></li>
            <li><a href="{{ route('users.create') }}"><i class="fa fa-plus"></i> Agregar usuario</a></li>
        </ul>
    </div>
</nav>