@extends('base')

@section('content')

    @yield('titulo')

    @include('productos.partials.navbar')

    <div class="row">
        <div class="col-lg-12">
            @yield('contenido')
        </div>
    </div>

@endsection