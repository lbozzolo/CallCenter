@extends('noticias.base')

@section('titulo')

    <h2>Noticias</h2>

@endsection

@section('contenido')

    <div class="row">

        <div class="col-lg-6">
            <div class="card" style="color: black; background-color: white">

                <div class="card-header" style="padding: 10px 20px">
                    <h3>{!! $noticia->titulo !!}</h3>
                    <span>{!! $noticia->fecha_creado !!}</span>
                </div>
                <div class="card-body" style="padding: 10px 20px; background-color:white">
                    <p style="color: black; background-color: white">{!! $noticia->descripcion !!}</p>
                </div>

            </div>

            <div class="card-footer">
                <a href="{!! route('noticias.index') !!}" class="btn btn-default">Volver</a>
            </div>

        </div>

@endsection





