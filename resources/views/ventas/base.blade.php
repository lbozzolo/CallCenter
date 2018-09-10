@extends('base')

@section('content')

    @yield('titulo')

    <div class="row">
        <div class="col-lg-12">

            @if(!isset($venta))
                @include('ventas.partials.navbar')
            @endif

            @yield('contenido')

        </div>
    </div>

@endsection