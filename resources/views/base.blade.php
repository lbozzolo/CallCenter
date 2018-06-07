@extends('layout')


@section('body')

    <div class="row">
        <div class="col-lg-12">
            @include('partials.navbar')
        </div>
    </div>
    @include('partials.messages')

    @yield('content')

@endsection