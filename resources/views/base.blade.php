@extends('layout')


@section('body')

    @include('partials.navbar')
    @include('partials.messages')
    @yield('content')

@endsection