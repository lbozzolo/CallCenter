@extends('base')

@section('content')

    @yield('titulo')

    <div class="row">
        <div class="col-lg-12">

            @permission('listado.usuario')
            @include('users.partials.navbar')
            @endpermission

            @yield('contenido')

        </div>
    </div>

@endsection