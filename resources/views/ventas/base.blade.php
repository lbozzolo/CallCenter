@extends('base')

@section('content')

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

                        
                        <div class="row" style="margin-top:2%">
                            <div class="col-lg-12">
                                @include('ventas.partials.navbar')
                            </div>
                        </div>

                        @yield('contenido')

                    </div>
                </div>

            </div>
        </div>
    </div>

@endsection