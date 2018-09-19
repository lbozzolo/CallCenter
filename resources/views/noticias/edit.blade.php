@extends('noticias.base')

@section('titulo')

    <h2>Noticias</h2>

@endsection

@section('contenido')

    @include('noticias.partials.formulario-editar-noticia')

@endsection
