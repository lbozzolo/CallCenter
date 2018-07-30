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
            @permission('listado.reclamo')
                <li><a href="{{ route('reclamos.index') }}" class="{{ (Request::is('reclamos') ? 'navbar-item-selected' : '') }}">Todos</a></li>
                <li><a href="{{ route('reclamos.index.productos') }}" class="{{ (Request::is('reclamos/productos'.'*') ? 'navbar-item-selected' : '') }}">Por producto</a></li>
                <li><a href="{{ route('reclamos.index.clientes') }}" class="{{ (Request::is('reclamos/clientes'.'*') ? 'navbar-item-selected' : '') }}">Por cliente</a></li>
            @endpermission
            @permission('crear.reclamo')
                <li><a href="{{ route('reclamos.create') }}" class="{{ (Request::is('reclamos/crear') ? 'navbar-item-selected' : '') }}"><span class="text-primary"><i class="fa fa-plus"></i> Ingresar reclamo</span></a></li>
            @endpermission
            </ul>
        </div>
    </div>
</nav>