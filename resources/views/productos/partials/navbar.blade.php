<nav class="navbar navbar-default">
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li><a href="{{ route('productos.index') }}" class="{{ (Request::is('productos') ? 'navbar-item-selected' : '') }}">Activos</a></li>
            <li><a href="{{ route('productos.index.inactivos') }}" class="{{ (Request::is('productos/inactivos') ? 'navbar-item-selected' : '') }}">Inactivos</a></li>
            <li><a href="{{ route('productos.create') }}" class="{{ (Request::is('productos/crear') ? 'navbar-item-selected' : '') }}"><i class="fa fa-plus"></i> Agregar</a></li>
            <li><a href="{{ route('categorias.index') }}" class="{{ (Request::is('categorias'.'*') ? 'navbar-item-selected' : '') }}">Categorías</a></li>
            <li><a href="{{ route('subcategorias.index') }}" class="{{ (Request::is('subcategorias'.'*') ? 'navbar-item-selected' : '') }}">Subcategorías</a></li>
            <li><a href="{{ route('marcas.index') }}" class="{{ (Request::is('marcas'.'*') ? 'navbar-item-selected' : '') }}">Marcas</a></li>
        </ul>
    </div>
</nav>