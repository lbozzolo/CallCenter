<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
    <div class="nano">
        <div class="nano-content">
            <ul>
                
                <li class="active"><a href="{{route('/')}}"><i class="ti-home"></i> Dashboard </a></li>
                @if(Auth::check() && Auth::user()->estado->slug == 'habilitado')

                <li class="label">Menu</li>
                 @permission('listado.cliente')
                    <li>
                        <a class="sidebar-sub-toggle" href="{{ route('clientes.index') }}" style="{{ (Request::is('clientes'.'*') ? 'color: white' : '') }}"><i class="ti-user"></i> Clientes <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            @permission('listado.cliente')
                            <li>
                                <a href="{{ route('clientes.index') }}">Listar Clientes </a>
                            </li>
                            @endpermission

                            @permission('crear.cliente')
                            <li>
                                <a href="{{ route('clientes.create') }}">Agregar Cliente </a>
                            </li>
                            @endpermission

                            @permission('crear.cliente')
                            <li>
                                <a href="{{ route('clientes.create') }}">Importar Lista </a>
                            </li>
                            @endpermission
                        </ul>
                    </li>
                @endpermission



                @permission('listado.reclamo')
                    <li>
                        <a class="sidebar-sub-toggle" href="{{ route('reclamos.index') }}" style="{{ (Request::is('reclamos'.'*') ? 'color: white' : '') }}"><i class="ti-face-sad"></i> Reclamos <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            @permission('listado.reclamo')
                            <li>
                                <a href="{{ route('reclamos.index') }}">Listar Reclamos </a>
                            </li>
                            @endpermission

                            @permission('crear.reclamo')
                            <li>
                                <a href="{{ route('reclamos.create') }}">Agregar Reclamos </a>
                            </li>
                            @endpermission
                        </ul>
                    </li>
                @endpermission
                
                @permission('listado.venta')
                    <li>
                        <a class="sidebar-sub-toggle" href="{{ route('ventas.index') }}" style="{{ (Request::is('ventas'.'*') ? 'color: white' : '') }}"><i class="ti-ticket"></i> Ventas <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            @permission('listado.venta')
                            <li>
                                <a href="{{ route('ventas.index') }}">Listar Ventas </a>
                            </li>
                            @endpermission

                            @permission('crear.venta')
                            <li>
                                <a href="{{ route('ventas.seleccion.cliente') }}"> Generar Venta</a>
                            </li>
                            @endpermission
                        </ul>
                    </li>
                @endpermission


                @permission('listado.llamada')
                    <li>
                        <a class="sidebar-sub-toggle" href="{{ route('llamadas.index') }}" style="{{ (Request::is('llamadas'.'*') ? 'color: white' : '') }}"><i class="ti-headphone-alt"></i> Llamadas <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            @permission('listado.llamada')
                            <li>
                                <a href="{{ route('llamadas.index') }}">Listar Llamadas </a>
                            </li>
                            @endpermission

                            @permission('listado.llamada')
                            <li>
                                <a href="{{ route('llamadas.index.entrantes') }}">Lamadas Entrantes</a>
                            </li>
                            @endpermission

                            @permission('listado.llamada')
                            <li>
                                <a href="{{ route('llamadas.index') }}">Llamadas Salientes</a>
                            </li>
                            @endpermission
                        </ul>
                    </li>
                @endpermission

                

                <li class="label">Seteos</li>

                @permission('listado.producto')
                    <li>
                        <a class="sidebar-sub-toggle" href="{{ route('productos.index') }}" style="{{ (Request::is('productos'.'*') ? 'color: white' : '') }}"><i class="ti-shopping-cart"></i> Productos <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            @permission('listado.producto')
                            <li>
                                <a href="{{ route('productos.index') }}">Listar Productos </a>
                            </li>
                            @endpermission

                            @permission('crear.producto')
                            <li>
                                <a href="{{ route('productos.create') }}">Agregar Productos </a>
                            </li>
                            @endpermission
                        </ul>
                    </li>
                @endpermission



                @permission('listado.categoria')
                    <li>
                        <a class="sidebar-sub-toggle" href="{{ route('categorias.index') }}" style="{{ (Request::is('categorias'.'*') ? 'color: white' : '') }}"><i class="ti-control-shuffle"></i> Categorias <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            @permission('listado.categoria')
                            <li>
                                <a href="{{ route('categorias.index') }}">Listar Categorias </a>
                            </li>
                            @endpermission
                        </ul>
                    </li>
                @endpermission

                @permission('listado.categoria')
                    <li>
                        <a class="sidebar-sub-toggle" href="{{ route('subcategorias.index') }}" style="{{ (Request::is('subcategorias'.'*') ? 'color: white' : '') }}"><i class="ti-menu-alt"></i> Subcategorias <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            @permission('listado.categoria')
                            <li>
                                <a href="{{ route('subcategorias.index') }}">Listar Subcategorias </a>
                            </li>
                            @endpermission
                        </ul>
                    </li>
                @endpermission

                @permission('listado.marca')
                    <li>
                        <a class="sidebar-sub-toggle" href="{{ route('marcas.index') }}" style="{{ (Request::is('marcas'.'*') ? 'color: white' : '') }}"><i class="ti-receipt"></i> Marcas <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            @permission('listado.marca')
                            <li>
                                <a href="{{ route('marcas.index') }}">Listar Marcas </a>
                            </li>
                            @endpermission
                        </ul>
                    </li>
                @endpermission


                @permission('listado.institucion')
                    <li>
                        <a class="sidebar-sub-toggle" href="{{ route('instituciones.index') }}" style="{{ (Request::is('instituciones'.'*') ? 'color: white' : '') }}"><i class="ti-medall-alt"></i> Instituciones <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            @permission('listado.institucion')
                            <li>
                                <a href="{{ route('instituciones.index') }}">Listar Instituciones </a>
                            </li>
                            @endpermission
                        </ul>
                    </li>
                @endpermission



                @permission('listado.forma.de.pago')
                    <li>
                        <a class="sidebar-sub-toggle" href="{{ route('formas.pago.index') }}" style="{{ (Request::is('formas-pago'.'*') ? 'color: white' : '') }}"><i class="ti-money"></i> Pagos <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            @permission('listado.forma.de.pago')
                            <li>
                                <a href="{{ route('formas.pago.index') }}">Listar Formas de Pago </a>
                            </li>
                            @endpermission
                        </ul>
                    </li>
                @endpermission



                <li class="label">Administración</li>

                @permission('listado.usuario')
                    <li>
                        <a class="sidebar-sub-toggle" href="{{ route('users.index') }}" style="{{ (Request::is('usuarios'.'*') ? 'color: white' : '') }}"><i class="ti-face-smile"></i> Usuarios <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            @permission('listado.usuario')
                            <li>
                                <a href="{{ route('users.index') }}">Listar Usuarios </a>
                            </li>
                            @endpermission

                            @permission('crear.usuario')
                            <li>
                                <a href="{{ route('users.create') }}">Agregar Usuarios </a>
                            </li>
                            @endpermission
                        </ul>
                    </li>
                @endpermission


                @role('superadmin')
                    <li>
                        <a class="sidebar-sub-toggle" href="{{ route('roles.index') }}" style="{{ (Request::is('roles'.'*') ? 'color: white' : '') }}"><i class="ti-settings"></i> Roles <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            @role('superadmin')
                            <li>
                                <a href="{{ route('roles.index') }}">Listar Roles </a>
                            </li>
                            <li>
                                <a href="{{ route('permissions.index') }}">Listar Permisos </a>
                            </li>
                            @endrole
                        </ul>
                    </li>
                @endrole
                


                @endif
            </ul>
        </div>
    </div>
</div>
