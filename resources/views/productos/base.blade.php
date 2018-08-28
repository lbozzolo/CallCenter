@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                @yield('titulo')

                @permission('listado.producto')
                <ul class="list-inline">
                    <li><a href="{{ route('productos.index') }}" class="{{ (Request::is('productos') ? 'navbar-item-selected' : '') }}">Activos</a></li>
                    <li><a href="{{ route('productos.index.inactivos') }}" class="{{ (Request::is('productos/inactivos') ? 'navbar-item-selected' : '') }}">Inactivos</a></li>
                    <li><a href="{{ route('productos.create') }}" class="{{ (Request::is('productos/crear') ? 'navbar-item-selected' : '') }}"><span class="text-primary"><i class="fa fa-plus"></i> Agregar</span></a></li>
                </ul>
                @endpermission

                <div class="row">
                    <div class="col-lg-11">
                        @yield('contenido')
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection