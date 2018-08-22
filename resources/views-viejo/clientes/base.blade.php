@extends('base')

@section('content')

    @if(isset($cliente))
    <div class="row">
        <div class="col-lg-12">

            @include('clientes.partials.navbar')

        </div>
    </div>
    @endif
    <div class="row">

        <div class="container">
            <div class="content">

                @yield('titulo')

                <div class="row">
                    <div class="col-lg-12">
                        @yield('contenido')
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection