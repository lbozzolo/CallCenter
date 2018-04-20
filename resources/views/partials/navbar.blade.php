<nav class="navbar navbar-inverse">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle Navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">SMARTLINE</a>
        </div>

        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                {{--<li><a href="/">Home</a></li>--}}
                @if(Auth::check() && Auth::user()->estado->slug == 'habilitado')

                <li><a href="{{ route('users.index') }}">Usuarios</a></li>
                <li><a href="{{ route('roles.index') }}">Roles</a></li>
                <li><a href="{{ route('clientes.index') }}">Clientes</a></li>
                <li><a href="{{ route('productos.index') }}">Productos</a></li>
                <li><a href="{{ route('instituciones.index') }}">Instituciones</a></li>
                <li><a href="{{ route('llamadas.index') }}">Llamadas</a></li>
                <li><a href="{{ route('ventas.index') }}">Ventas</a></li>
                <li><a href="{{ route('imagenes.index') }}">Imágenes</a></li>

                @endif
            </ul>

            <ul class="nav navbar-nav navbar-right">
                @if (Auth::guest())
                    <li><a href="/auth/login">Iniciar sesión</a></li>
                    {{--<li><a href="/auth/register">Registrarse</a></li>--}}
                @else
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">{{ Auth::user()->full_name }}<span class="caret"></span></a>
                        <ul class="dropdown-menu" role="menu">
                            @if(Auth::check() && Auth::user()->estado->slug == 'habilitado')
                            <li><a href="{{ route('users.profile', Auth::user()->id) }}">Mi perfil</a></li>
                            @endif
                            <li><a href="{{ route('logout') }}">Cerrar sesión</a></li>
                        </ul>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</nav>
