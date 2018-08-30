@extends('layout')


@section('body')

    @include('partials.navbar')

    @include('partials.messages')

    @include('partials.header')

    <div class="row">
        <div class="col-lg-12">
            <div class="content-wrap">
                <div class="main">
                    <div class="container-fluid">

                        @yield('content')


                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row" id="footer">
        <div class="col-lg-12">
            <div class="footer">
                <p>Smartline @ 2018 - Desarrollado por <a href="http://www.bamdig.com/" target="_new" class="page-refresh">Bamdig.com</a></p>
            </div>
        </div>
    </div>


@endsection