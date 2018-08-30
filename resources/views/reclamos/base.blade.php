@extends('base')

@section('content')

    @yield('titulo')

   <div class="row">
        <div class="col-lg-12">
            @include('reclamos.partials.navbar')
            @yield('contenido')
        </div>
    </div>

@endsection