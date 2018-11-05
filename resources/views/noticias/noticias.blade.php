@extends('noticias.base')

@section('css')

    <style type="text/css">

        .noticia, .noticia p{
            background-color: whitesmoke;
            color: black !important;
            margin: 10px;
            border-radius: 3px;
        }

    </style>

@endsection

@section('titulo')

    <h2>Noticias</h2>

@endsection

@section('contenido')

    <div class="row">
        <div class="col-lg-7">

            @permission('listado.noticia')
            <ul class="list-unstyled">

                @forelse($noticias as $noticia)

                    <li>
                        <div class="noticia" style="padding: 10px 20px">
                            <span>{!! $noticia->fecha_creado !!} - {!! $noticia->hora_created !!} hs</span>
                            <span class="pull-right">Autor: {!! $noticia->autor->full_name !!}</span>
                            <div style="padding: 10px 20px" class="noticia">{!! $noticia->descripcion !!}</div>
                        </div>
                    </li>

                @empty

                    <div class="card">
                        <p>Todavía no hay ninguna noticia cargada en el sistema.</p>
                    </div>

                @endforelse

            </ul>

            {!! $noticias->render() !!}
            @endpermission

        </div>
    </div>

@endsection