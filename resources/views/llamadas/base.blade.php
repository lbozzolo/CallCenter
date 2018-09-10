@extends('base')

@section('content')

    @yield('titulo')

    <div class="row">
        <div class="col-lg-12">

            @if(isset($llamada))

                @if($llamada->reclamo)
                    {{--@include('reclamos.partials.navbar')--}}
                @else
                    @include('llamadas.partials.navbar')
                @endif

            @else
                @include('llamadas.partials.navbar')
            @endif

            @yield('contenido')

        </div>
    </div>

@endsection