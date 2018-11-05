@extends('noticias.base')

@section('titulo')

    <h2>Noticias <span class="text-muted">/ Ver noticia #{!! $noticia->id !!}</span> </h2>

@endsection

@section('contenido')

    <div class="row">

        @permission('ver.noticia')
        <div class="col-lg-7">
            <div class="noticia" style="padding: 10px 20px">
                <span>{!! $noticia->fecha_creado !!} - {!! $noticia->hora_created !!} hs</span>
                <span class="pull-right">Autor: {!! $noticia->autor->full_name !!}</span>
                <div style="padding: 10px 20px" class="noticia">{!! $noticia->descripcion !!}</div>

                <a href="{!! route('noticias.index') !!}" class="btn btn-default">Volver</a>
            </div>
        </div>
        @endpermission

    </div>

@endsection