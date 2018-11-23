@extends('noticias.base')

@section('css')

    <style type="text/css">

        .noticia, .noticia p{
            background-color: whitesmoke;
            color: black !important;
            margin: 10px;
            border-radius: 3px;
        }

        .noticia-anterior, .noticia-anterior p {
            background-color: darkgray;
        }

    </style>

@endsection

@section('titulo')

    <h2>Noticias</h2>

@endsection

@section('contenido')

    <div class="row">
        <div class="col-lg-8">

            <div class="card">
                <div class="card-header">
                    <h3>Últimas noticias</h3>
                </div>
                <div class="card-body">
                    @permission('listado.noticia')
                    <ul class="list-unstyled">

                        @forelse($recientes as $noticia)

                            <li>
                                <div class="noticia" style="padding: 10px 20px">
                                    <strong>{!! $noticia->titulo !!}</strong>
                                    @if($noticia->isTodaysNew())
                                    <span class="label label-warning pull-right">Noticia de hoy</span>
                                    @endif
                                    <br>
                                    <em>{!! $noticia->autor->full_name !!}</em>
                                    <span class="pull-right">{!! $noticia->fecha_creado !!} - {!! $noticia->hora_created !!} hs</span>
                                    <div style="padding: 10px 20px" class="noticia">{!! $noticia->descripcion !!}</div>
                                </div>
                            </li>

                        @empty

                            <div class="card">
                                <p>No hay ninguna noticia nueva esta semana.</p>
                            </div>

                        @endforelse

                    </ul>

                    @endpermission
                </div>
            </div>

        </div>
        <div class="col-lg-4">

            <div class="card">
                <div class="card-header">
                    <h3>Noticias anteriores <small>({!! $anteriores->count() !!})</small></h3>
                </div>
                <div class="card-body" style="max-height: 600px; overflow: scroll">
                    @permission('listado.noticia')
                    <ul class="list-unstyled">

                        @forelse($anteriores as $noticia)

                            <li>
                                <div class="noticia noticia-anterior" style="padding: 10px 20px">
                                    <strong>{!! $noticia->titulo !!}</strong><br>
                                    <em>{!! $noticia->autor->full_name !!}</em>
                                    <span class="pull-right">{!! $noticia->fecha_creado !!} - {!! $noticia->hora_created !!} hs</span>
                                    <div style="padding: 10px 20px" class="noticia noticia-anterior">{!! $noticia->descripcion !!}</div>
                                </div>
                            </li>

                        @empty

                            <div class="card">
                                <p>Todavía no hay ninguna noticia cargada en el sistema.</p>
                            </div>

                        @endforelse

                    </ul>

                    @endpermission
                </div>
                <div class="card-footer">
                    <p class="panel panel-barra text-center">más noticias... <i class="fa fa-angle-double-down"></i> </p>
                </div>
            </div>


        </div>
    </div>

@endsection