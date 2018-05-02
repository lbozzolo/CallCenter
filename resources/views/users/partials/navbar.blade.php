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
            <li><a href="{{ route('users.index') }}">Habilitados</a></li>
            <li><a href="{{ route('users.index.disable') }}">Deshabilitados</a></li>
            <li><a href="{{ route('users.index.nuevos') }}">Nuevos</a></li>
            <li><a href="{{ route('users.create') }}"><i class="fa fa-plus"></i> Agregar usuario</a></li>
        </ul>
    </div>
</nav>
