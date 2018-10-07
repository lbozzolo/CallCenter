<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
    <div class="nano">
        <div class="nano-content">
            <ul>
                
                <li><a href="{{route('/')}}"><i class="ti-home"></i> Dashboard </a></li>
                @if(Auth::check() && Auth::user()->isEnabled())

                <li class="label">Menu</li>
                 @permission('listado.cliente')
                    <li>
                        <a class="sidebar-sub-toggle" href="{{ route('clientes.index') }}" style="{{ (Request::is('clientes'.'*') ? 'color: white' : '') }}"><i class="ti-user"></i> Clientes <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            @permission('listado.cliente')
                            <li><a href="{{ route('clientes.index') }}">Listar Clientes </a></li>
                            @endpermission

                            @permission('crear.cliente')
                            <li><a href="{{ route('clientes.create') }}">Agregar Cliente </a></li>
                            @endpermission

                            @permission('crear.cliente')
                            <li><a href="{{ route('clientes.importacion') }}">Importar Lista </a></li>
                            @endpermission
                        </ul>
                    </li>
                @endpermission



                @permission('listado.reclamo')
                    <li>
                        <a class="sidebar-sub-toggle" href="{{ route('reclamos.index') }}" style="{{ (Request::is('reclamos'.'*') ? 'color: white' : '') }}"><i class="ti-face-sad"></i> Reclamos <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            @permission('listado.reclamo')
                            <li><a href="{{ route('reclamos.index') }}">Listar Reclamos </a></li>
                            @endpermission

                            @permission('crear.reclamo')
                            <li><a href="{{ route('reclamos.create') }}">Agregar Reclamos </a></li>
                            @endpermission
                        </ul>
                    </li>
                @endpermission
                
                @permission('listado.venta')
                    <li>
                        <a class="sidebar-sub-toggle" href="{{ route('ventas.index') }}" style="{{ (Request::is('ventas'.'*') ? 'color: white' : '') }}"><i class="ti-ticket"></i> Ventas <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            @permission('listado.venta')
                            <li><a href="{{ route('ventas.index') }}">Listar Ventas </a></li>
                            @endpermission

                            @permission('crear.venta')
                            <li><a href="{{ route('ventas.seleccion.cliente') }}"> Generar Venta</a></li>
                            @endpermission
                        </ul>
                    </li>
                @endpermission


                @permission('listado.llamada')
                    <li>
                        <a class="sidebar-sub-toggle" href="{{ route('llamadas.index') }}" style="{{ (Request::is('llamadas'.'*') ? 'color: white' : '') }}"><i class="ti-headphone-alt"></i> Llamadas <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            @permission('listado.llamada')
                            <li><a href="{{ route('llamadas.index') }}">Listar Llamadas </a></li>
                            @endpermission

                            @permission('listado.llamada')
                            <li><a href="{{ route('llamadas.index.entrantes') }}">Lamadas Entrantes</a></li>
                            @endpermission

                            @permission('listado.llamada')
                            <li><a href="{{ route('llamadas.index') }}">Llamadas Salientes</a></li>
                            @endpermission

                        </ul>
                    </li>
                @endpermission


                <li class="label">Informacion</li>

                <li><a href="{{ route('noticias.noticias') }}"><i class="ti-notepad"></i> Noticias </a></li>

                <li class="label">Gestion</li>

                @permission('listado.asignacion')
                <li><a href="{{ route('asignaciones.index') }}"><i class="ti-signal"></i> Asignación de Tareas </a></li>
                @endpermission

                <li><a href="{{ route('noticias.index') }}"><i class="ti-notepad"></i> Carga de Noticias </a></li>

                <li class="label">Seteos</li>

                @permission('listado.producto')
                    <li>
                        <a class="sidebar-sub-toggle" href="{{ route('productos.index') }}" style="{{ (Request::is('productos'.'*') ? 'color: white' : '') }}"><i class="ti-shopping-cart"></i> Productos <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            @permission('listado.producto')
                            <li><a href="{{ route('productos.index') }}">Listar Productos </a></li>
                            @endpermission

                            @permission('crear.producto')
                            <li><a href="{{ route('productos.create') }}">Agregar Productos </a></li>
                            @endpermission
                        </ul>
                    </li>
                @endpermission


                @permission('listado.categoria')
                <li><a href="{{ route('categorias.index') }}"><i class="ti-control-shuffle"></i> Categorias </a></li>
                @endpermission

                
                @permission('listado.categoria')
                <li><a href="{{ route('subcategorias.index') }}"><i class="ti-menu-alt"></i> Subcategorías </a></li>
                @endpermission

                
                @permission('listado.marca')
                <li><a href="{{ route('marcas.index') }}"><i class="ti-receipt"></i> Marcas </a></li>
                @endpermission


                @permission('listado.institucion')
                <li><a href="{{ route('instituciones.index') }}"><i class="ti-medall-alt"></i> Instituciones </a></li>
                @endpermission



                @permission('listado.forma.de.pago')
                <li><a href="{{ route('formas.pago.index') }}"><i class="ti-money"></i> Pagos </a></li>
                @endpermission



                <li class="label">Administración</li>

                @permission('listado.usuario')
                    <li>
                        <a class="sidebar-sub-toggle" href="{{ route('users.index') }}" style="{{ (Request::is('usuarios'.'*') ? 'color: white' : '') }}"><i class="ti-face-smile"></i> Usuarios <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            @permission('listado.usuario')
                            <li><a href="{{ route('users.index') }}">Listar Usuarios </a></li>
                            @endpermission

                            @permission('crear.usuario')
                            <li><a href="{{ route('users.create') }}">Agregar Usuarios </a></li>
                            @endpermission
                        </ul>
                    </li>
                @endpermission


                @role('superadmin')
                    <li>
                        <a class="sidebar-sub-toggle" href="{{ route('roles.index') }}" style="{{ (Request::is('roles'.'*') ? 'color: white' : '') }}"><i class="ti-settings"></i> Roles <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            @role('superadmin')
                            <li><a href="{{ route('roles.index') }}">Listar Roles </a></li>
                            <li><a href="{{ route('permissions.index') }}">Listar Permisos </a></li>
                            @endrole
                        </ul>
                    </li>
                @endrole


                @endif
            </ul>
        </div>
    </div>
</div>
