@extends('base')

@section('content')


    <div class="row">

        <div class="container">
            <div class="content">

                @yield('titulo')

                @if(isset($cliente))
                    @include('clientes.partials.navbar')
                @endif
                <div class="row">
                    <div class="col-lg-12">
                        @yield('contenido')
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection