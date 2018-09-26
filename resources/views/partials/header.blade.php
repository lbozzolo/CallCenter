<div class="header">
    <div class="pull-left">
        <div class="logo"><a href="#"><!-- <img src="assets/images/logo.png" alt="" /> --><span>SmartLine</span></a></div>
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
                                <li><a href="{{ route('asignaciones.index') }}"><i class="ti-signal"></i> <span>Tareas Asignadas</span></a></li>
                                <li><a href="{{ route('logout') }}"><i class="ti-power-off"></i> <span>Logout</span></a></li>
                            </ul>
                        </div>
                    </div>
                </li>

        </ul>
    </div>
</div>

