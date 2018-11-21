<div class="header">
    <div class="pull-left">
        <div class="logo" style="padding: 5px 10px; margin:  10px">
            <a href="#">
                <img src="{{ asset('img/logo_sis.png') }}" alt="Smartline"  height="30px">
            </a>
        </div>
        <div class="hamburger sidebar-toggle">
            <span class="line"></span>
            <span class="line"></span>
            <span class="line"></span>
        </div>
    </div>
    <div class="pull-right p-r-15">
        <ul>

            @if(Auth::user()->profile_image)
                <li class="header-icon dib">
                    <img src="{{ route('imagenes.ver', Auth::user()->profile_image) }}" class="img-circle " style="object-fit: cover; width: 30px; height: 30px">
                    <span class="user-avatar">{{ Auth::user()->fullname }}<i class="ti-angle-down f-s-10"></i></span>

            @else
                <li class="header-icon dib">
                    <img src="{{ route('imagenes.ver', 'x') }}" class="img-circle " style="object-fit: cover; width: 30px; height: 30px">
                    <span class="user-avatar">{{ Auth::user()->fullname }}<i class="ti-angle-down f-s-10"></i></span>

            @endif
                    <div class="drop-down dropdown-profile">

                        <div class="dropdown-content-body" style="background-color: #333B54">
                            <ul>
                                <li><a href="{{ route('users.profile', Auth::user()->id) }}"><i class="ti-user"></i> <span>Mi Perfil</span></a></li>
                                @permission('ver.mis.asignaciones')
                                <li>
                                    <a href="{{ route('asignaciones.mis.tareas') }}">
                                        <i class="ti-signal"></i> <span>Mis tareas</span>
                                        <small class="label label-default">{!! Auth::user()->total_asignaciones_actuales !!}</small>
                                    </a>
                                </li>
                                @endpermission
                                <li>
                                    <a href="{{ route('tickets.create') }}"><i class="fa fa-flag-o"></i><span>Soporte</span></a>
                                </li>
                                <li><a href="{{ route('logout') }}"><i class="ti-power-off"></i> <span>Logout</span></a></li>
                            </ul>
                        </div>
                    </div>
                </li>

        </ul>
    </div>
</div>

