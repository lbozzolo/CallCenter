@extends('layout')


@section('body')

    <div class="row">
        <div class="col-lg-12">

            @include('partials.navbar')

            @include('partials.header')

            <div class="content-wrap" style="margin-bottom: 200px">
                <div class="main">
                    <div class="container-fluid">

                        @include('partials.messages')

                        @yield('content')

                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="footer" style="margin-bottom: 0px">
                <p>Smartline @ 2020 - Desarrollado por <a href="http://www.verticedigital.com.ar/" target="_new" class="page-refresh">Verticedigital.com.ar</a></p>
                {{--<span id="date-time" style="display: none"></span>--}}
            </div>
        </div>
    </div>

@endsection