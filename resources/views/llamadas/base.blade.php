@extends('base')

@section('content')

   
    <div class="row">

        <div class="container">
            <div class="content">

                @yield('titulo')
                <div class="row">
                        <div class="col-lg-12">
                            @if(isset($llamada))

                                @if($llamada->reclamo)
                                    @include('reclamos.partials.navbar')
                                @else
                                    {{--@include('ventas.partials.navbar')--}}
                                    @include('llamadas.partials.navbar')
                                @endif

                            @else
                                @include('llamadas.partials.navbar')
                            @endif
                        </div>
                    </div>
                <div class="row">
                    <div class="col-lg-11">
                        @yield('contenido')
                    </div>
                </div>

            </div>
        </div>
    </div>
    

@endsection