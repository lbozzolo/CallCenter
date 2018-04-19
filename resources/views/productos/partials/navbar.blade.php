<nav class="navbar navbar-default">
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
        <ul class="nav navbar-nav">
            <li><a href="{{ route('productos.index') }}">Activos</a></li>
            <li><a href="{{ route('productos.index.inactivos') }}">Inactivos</a></li>
            <li><a href="{{ route('productos.create') }}"><i class="fa fa-plus"></i> Agregar</a></li>
            <li><a href="{{ route('marcas.index') }}">Marcas</a></li>
            <li><a href="{{ route('categorias.index') }}">Categorías</a></li>
            <li><a href="{{ route('subcategorias.index') }}">Subcategorías</a></li>
        </ul>
    </div>
</nav>