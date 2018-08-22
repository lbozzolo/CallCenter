<nav class="navbar navbar-default small">
    <div class="col-lg-10 col-lg-offset-1">
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
                <li>
                    <a href="{{ route('users.index') }}"><i class="fa fa-home"></i> </a>
                </li>
            @permission('listado.usuario')
                <li><a href="{{ route('users.index') }}">Habilitados</a></li>
                <li><a href="{{ route('users.index.disable') }}">Deshabilitados</a></li>
            @endpermission

            @permission('listado.usuarios.nuevos')
                <li><a href="{{ route('users.index.nuevos') }}">Nuevos</a></li>
            @endpermission

            @permission('crear.usuario')
                <li><a href="{{ route('users.create') }}"><span class="text-primary"><i class="fa fa-user-plus"></i> Agregar</span></a></li>
            @endpermission
            </ul>
        </div>
    </div>
</nav>
