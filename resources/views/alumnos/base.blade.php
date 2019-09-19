@extends('base')

@section('content')

    @yield('titulo')

    {{--@if(isset($cliente))--}}
        {{--@include('clientes.partials.navbar')--}}
    {{--@endif--}}

    <div class="row">
        <div class="col-lg-12 col-md-10">
            @yield('contenido')
        </div>
    </div>

@endsection