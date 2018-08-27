@extends('layout')


@section('body')

    @include('partials.navbar')

    @include('partials.messages')

    @include('partials.header')

    <div class="content-wrap">
        <div class="main">
            <div class="container-fluid">

                @yield('content')

            </div>
        </div>
    </div>

@endsection