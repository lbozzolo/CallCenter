@extends('base')

@section('content')

    @yield('titulo')

    <div class="row">
        <div class="col-lg-12">

            @if(isset($tags))
                @include('ventas.partials.navbar')
            @endif

            @yield('contenido')

        </div>
    </div>

@endsection