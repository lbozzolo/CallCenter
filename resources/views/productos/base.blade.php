@extends('base')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            @include('productos.partials.navbar')
        </div>
    </div>
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