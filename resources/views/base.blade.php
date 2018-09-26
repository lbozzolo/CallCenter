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
                <p>Smartline @ 2018 - Desarrollado por <a href="http://www.bamdig.com/" target="_new" class="page-refresh">Bamdig.com</a></p>
            </div>
        </div>
    </div>

@endsection