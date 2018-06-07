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
                <li><a href="{{ route('productos.index') }}" class="{{ (Request::is('productos') ? 'navbar-item-selected' : '') }}">Activos</a></li>
                <li><a href="{{ route('productos.index.inactivos') }}" class="{{ (Request::is('productos/inactivos') ? 'navbar-item-selected' : '') }}">Inactivos</a></li>
                <li><a href="{{ route('categorias.index') }}" class="{{ (Request::is('categorias'.'*') ? 'navbar-item-selected' : '') }}">Categorías</a></li>
                <li><a href="{{ route('subcategorias.index') }}" class="{{ (Request::is('subcategorias'.'*') ? 'navbar-item-selected' : '') }}">Subcategorías</a></li>
                <li><a href="{{ route('marcas.index') }}" class="{{ (Request::is('marcas'.'*') ? 'navbar-item-selected' : '') }}">Marcas</a></li>
                <li><a href="{{ route('productos.create') }}" class="{{ (Request::is('productos/crear') ? 'navbar-item-selected' : '') }}"><span class="text-primary"><i class="fa fa-plus"></i> Agregar</span></a></li>
            </ul>
        </div>
    </div>
</nav>
