<div class="sidebar sidebar-hide-to-small sidebar-shrink sidebar-gestures">
    <div class="nano">
        <div class="nano-content">
            <ul>
                
                <li><a href="{{route('/')}}"><i class="ti-home"></i> Dashboard </a></li>
                @if(Auth::check() && Auth::user()->isEnabled())

                @role('superadmin|admin|supervisor|operador.in|operador.out|atencion.al.cliente')
                <li class="label">Menu</li>
                @endrole


                @role('superadmin|admin|supervisor')
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
                @endrole


                @role('superadmin|admin|supervisor|operador.in|operador.out|atencion.al.cliente')
                    @permission('listado.reclamo')
                        <li>
                            <a class="sidebar-sub-toggle" href="{{ route('reclamos.index') }}" style="{{ (Request::is('reclamos'.'*') ? 'color: white' : '') }}"><i class="ti-face-sad"></i> Reclamos <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                            <ul>
                                @permission('listado.reclamo')
                                <li><a href="{{ route('reclamos.index') }}">Listar Reclamos </a></li>
                                @endpermission

                                @permission('crear.reclamo')
                                <li><a href="{{ route('reclamos.index.ventas') }}">Iniciar Reclamo </a></li>
                                @endpermission
                            </ul>
                        </li>
                    @endpermission
                @endrole

                @role('superadmin|admin|operador.in|operador.out|supervisor')
                    @permission('listado.venta')
                        <li>
                            <a class="sidebar-sub-toggle" href="{{ route('ventas.index') }}" style="{{ (Request::is('ventas'.'*') ? 'color: white' : '') }}"><i class="ti-ticket"></i> Ventas <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                            <ul>
                                @role('superadmin|admin')
                                    @permission('listado.venta')
                                    <li><a href="{{ route('ventas.index') }}">Listar Ventas </a></li>
                                    @endpermission
                                @endrole

                                @permission('listado.venta')
                                <li><a href="{{ route('ventas.mis.ventas') }}">Mis Ventas </a></li>
                                @endpermission

                                @permission('crear.venta')
                                <li><a href="{{ route('ventas.seleccion.cliente') }}"> Generar Venta</a></li>
                                @endpermission
                            </ul>
                        </li>
                    @endpermission
                @endrole


                @permission('ver.noticia')
                <li class="label">Informacion</li>
                <li>
                    <a href="{{ route('noticias.noticias') }}">
                        <i class="ti-notepad"></i> Noticias
                        @if(\SmartLine\Entities\Noticia::todaysNews() > 0)
                        <span class="label label-default text-center">{!! \SmartLine\Entities\Noticia::todaysNews() !!}</span>
                        @endif
                    </a>
                </li>
                @endpermission

                @role('superadmin|admin|supervisor|facturacion|auditor|logistica|atencion.al.cliente')
                <li class="label">Gestion</li>
                @endrole

                @role('superadmin|admin|supervisor')
                    @permission('listado.asignacion')
                    <li><a href="{{ route('asignaciones.index') }}"><i class="ti-signal"></i> Asignación de Tareas </a></li>
                    @endpermission
                @endrole

                @role('superadmin|admin')
                    @permission('crear.noticia')
                    <li><a href="{{ route('noticias.index') }}"><i class="ti-notepad"></i> Carga de Noticias </a></li>
                    @endpermission
                @endrole

                @role('superadmin|admin')
                    @permission('listado.updateable')
                    <li><a href="{{ route('updateables.index') }}"><i class="ti-direction-alt"></i> Movimientos </a></li>
                    @endpermission
                @endrole

                @role('superadmin|admin|facturacion')
                    @permission('listado.facturacion.venta')
                    <li><a href="{{ route('ventas.facturacion') }}"> <i class="ti-money"></i>Facturación</a></li>
                    @endpermission
                @endrole

                @role('superadmin|admin|supervisor|auditor')
                    @permission('listado.auditoria.venta')
                    <li><a href="{{ route('ventas.auditoria') }}"> <i class="ti-eye"></i>Auditoria</a></li>
                    @endpermission
                @endrole

                @role('superadmin|admin|supervisor|logistica')
                    @permission('listado.logistica.venta')
                    <li><a href="{{ route('ventas.logistica') }}"> <i class="ti-truck"></i>Logística</a></li>
                    @endpermission
                @endrole

                @role('superadmin|admin|supervisor|atencion.al.cliente')
                    @permission('listado.postventa.venta')
                    <li><a href="{{ route('ventas.post.venta') }}"> <i class="ti-package"></i>Postventa</a></li>
                    @endpermission
                @endrole


                @permission('listado.producto')
                <li class="label">Seteos</li>

                    <li>
                        <a class="sidebar-sub-toggle" href="{{ route('productos.index') }}" style="{{ (Request::is('productos'.'*') ? 'color: white' : '') }}"><i class="ti-shopping-cart"></i> Productos <span class="sidebar-collapse-icon ti-angle-down"></span></a>
                        <ul>
                            @permission('listado.producto')
                            <li><a href="{{ route('productos.index') }}">Listar Productos </a></li>
                            @endpermission

                            @role('superadmin|admin')
                                @permission('crear.producto')
                                <li><a href="{{ route('productos.create') }}">Agregar Productos </a></li>
                                @endpermission
                            @endrole
                        </ul>
                    </li>
                @endpermission


                @role('superadmin|admin')
                    @permission('listado.categoria')
                    <li><a href="{{ route('categorias.index') }}"><i class="ti-control-shuffle"></i> Categorias </a></li>
                    @endpermission
                @endrole

                @role('superadmin|admin')
                    @permission('listado.categoria')
                    <li><a href="{{ route('subcategorias.index') }}"><i class="ti-menu-alt"></i> Subcategorías </a></li>
                    @endpermission
                @endrole

                @role('superadmin|admin')
                    @permission('listado.marca')
                    <li><a href="{{ route('marcas.index') }}"><i class="ti-receipt"></i> Marcas </a></li>
                    @endpermission
                @endrole

                @role('superadmin|admin')
                    @permission('listado.institucion')
                    <li><a href="{{ route('instituciones.index') }}"><i class="ti-medall-alt"></i> Instituciones </a></li>
                    @endpermission
                @endrole


                @role('superadmin|admin')
                    @permission('listado.forma.de.pago')
                    <li><a href="{{ route('formas.pago.index') }}"><i class="ti-money"></i> Formas de Pagos </a></li>
                    @endpermission
                @endrole


                @role('superadmin|admin')

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
                        <li><a href="{{ route('tickets.index') }}"><i class="ti-flag"></i> Soporte </a></li>
                    @endrole

                @endrole


                @endif

            </ul>
        </div>
    </div>
</div>
