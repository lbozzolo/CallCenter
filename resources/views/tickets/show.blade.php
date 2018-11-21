@extends('tareas.base')

@section('titulo')

    <h2>Soporte / Ticket #{!! $ticket->id !!}</h2>

@endsection

@section('contenido')

    <div class="row">

        <div class="col-lg-8">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-header">
                            <h3>{!! $ticket->subject !!}</h3>
                        </div>
                        <div class="card-body">
                            <p>{!! $ticket->body !!}</p>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <ul class="list-inline">
                                <li><h3>Comentarios</h3></li>
                                @if(!$ticket->isOpen())
                                    <li><span class="text-danger">Este ticket se encuentra cerrado</span></li>
                                @endif
                            </ul>
                        </div>
                        <div class="card-body">
                            @permission('crear.ticket')
                            @if($ticket->isOpen())
                            {!! Form::open(['url' => route('tickets.comment', $ticket->id), 'method' => 'post', 'class' => 'form']) !!}

                            <div class="form-group">
                                {!! Form::textarea('body', null, ['class' => 'form-control', 'autofocus', 'rows' => '3']) !!}
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Comentar</button>
                            </div>

                            {!! Form::close() !!}
                            @endif
                            @endpermission
                            <ul>
                                @forelse($comments as $comment)
                                    <li>
                                        <div class="panel panel-barra" style="{!! ($comment->author->is('superadmin'))? '' : "background-color: #404a6b" !!}">
                                            <div class="panel-body">
                                                <div class="row">
                                                    <div class="col-lg-1">
                                                        @if($comment->author->profile_image)
                                                            <img src="{{ route('imagenes.ver', $comment->author->profile_image) }}" class="img-circle " style="object-fit: cover; width: 30px; height: 30px">
                                                        @else
                                                            <img src="{{ route('imagenes.ver', 'x') }}" class="img-circle " style="object-fit: cover; width: 30px; height: 30px">
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-11">
                                                        <div><span class="text-muted">{!! $comment->author->fullname !!}:</span></div>
                                                        <div class="pull-right">
                                                            <small>{!! $comment->fecha_creado !!}</small> -
                                                            <small>{!! $comment->hora_created !!}</small> hs
                                                        </div>
                                                        <div>{!! $comment->body !!}</div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @empty
                                    <span class="text-muted">Todavía no hay ningún comentario.</span>
                                @endforelse
                            </ul>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="row">

                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h3>{!! $ticket->subject !!}</h3>
                        </div>
                        <div class="card-body">
                            <ul class="listado">
                                <li class="list-group-item">Id: {!! $ticket->id !!}</li>
                                <li class="list-group-item">Autor: {!! $ticket->author->fullname !!}</li>
                                <li class="list-group-item">
                                    Criticidad:
                                    @if($ticket->level_id == 1)
                                        <span class="text-success">BAJO</span>
                                    @elseif($ticket->level_id == 2)
                                        <span class="text-warning">MEDIO</span>
                                    @else
                                        <span class="text-danger">ALTO</span>
                                    @endif
                                </li>
                                <li class="list-group-item">
                                    Estado:
                                    @if($ticket->estado_id == 1)
                                        <span class="label label-success">abierto</span>
                                    @else
                                        <span class="label label-danger">cerrado</span>
                                    @endif
                                </li>
                                <li class="list-group-item">Módulo: {!! $ticket->modulo($ticket->modulo) !!}</li>
                                <li class="list-group-item">Fecha: {!! $ticket->fecha_creado !!}</li>
                            </ul>
                        </div>
                    </div>
                </div>

                @permission('editar.ticket')
                @if($ticket->isOpen())
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            {!! Form::open(['url' => route('tickets.cambiar.criticidad', $ticket->id), 'method' => 'post', 'class' => 'form']) !!}

                            {!! Form::label('level_id', 'Cambiar el nivel de criticidad') !!}
                            <div class="row">
                                <div class="col-lg-9">
                                    <div class="form-group">
                                        {!! Form::select('level_id', ['1' => 'Bajo', '2' => 'Medio', '3' => 'Alto'], $ticket->level_id, ['class' => 'form-control select2b', 'placeholdes' => '']) !!}
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="form-group" style="padding-top: 3px">
                                        <button type="submit" class="btn btn-primary">Aceptar</button>
                                    </div>
                                </div>
                            </div>

                            {!! Form::close() !!}

                        </div>
                    </div>
                </div>
                @endif
                @endpermission

                @permission('change.state.ticket')
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">

                            @if($ticket->isOpen())
                                <button type="button" title="Cerrar ticket" class="btn btn-danger" data-toggle="modal" data-target="#cerrarTicket{!! $ticket->id !!}" >
                                    Cerrar este ticket
                                </button>
                                <div class="modal fade col-lg-4 col-lg-offset-8 text-left" id="cerrarTicket{!! $ticket->id !!}">
                                    <div class="card">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title"><i class="fa fa-warning "></i> Cerrar ticket</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>¿Está seguro que desea cerrar este ticket?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{ route('tickets.change.state', $ticket->id) }}" class="btn btn-danger pull-left" title="Cerrar ticket">Cerrar</a>
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <button type="button" title="Abrir ticket" class="btn btn-success" data-toggle="modal" data-target="#abrirTicket{!! $ticket->id !!}" >
                                    Volver a abrir este ticket
                                </button>
                                <div class="modal fade col-lg-4 col-lg-offset-8 text-left" id="abrirTicket{!! $ticket->id !!}">
                                    <div class="card">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title"><i class="fa fa-warning "></i> Abrir ticket</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p>¿Está seguro que desea volver a abrir este ticket?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <a href="{{ route('tickets.change.state', $ticket->id) }}" class="btn btn-primary pull-left" title="Abrir ticket">Abrir ticket</a>
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                                        </div>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
                @endpermission

            </div>
        </div>



    </div>


@endsection
