@extends('base')

@section('content')

    <div class="row">
        <div class="col-lg-12">
            @include('roles.partials.navbar')
        </div>
    </div>
    <div class="row">

        <div class="container">
            <div class="content">

                <div class="row">
                    <div class="col-lg-12">

                        @yield('titulo')

                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12">

                        @yield('contenido')

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection