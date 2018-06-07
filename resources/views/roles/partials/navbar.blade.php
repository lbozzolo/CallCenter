<nav class="navbar navbar-default small">
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
            <li><a href="{{ route('roles.index') }}"class="{{ (Request::is('roles'.'*') ? 'navbar-item-selected' : '') }}">Roles</a></li>
            <li><a href="{{ route('permissions.index') }}"class="{{ (Request::is('permisos'.'*') ? 'navbar-item-selected' : '') }}">Permisos</a></li>
        </ul>
    </div>
</nav>