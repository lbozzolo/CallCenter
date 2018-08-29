@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                @yield('titulo')

                <div class="row">
                    <div class="col-lg-11">
                        @yield('contenido')
                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection