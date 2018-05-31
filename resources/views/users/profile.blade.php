@extends('base')

@section('content')


    <div class="row">
        <div class="container">
            <div class="content">

                <div class="row">
                    <div class="col-lg-12">
                        <h2>
                            @if($user->profile_image)
                                <img src="{{ route('imagenes.ver', $user->profile_image) }}" class="img-circle" style="object-fit: cover; width: 50px; height: 50px; margin-bottom: 10px">
                            @endif
                            {!! $user->full_name !!}
                            <span class="text-muted"> / Perfil de usuario</span>
                        </h2>
                        @include('users.partials.navbar')
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-12 col-md-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <div class="pull-right"> @include('users.partials.labels-roles-inline')</div>
                                <h3 class="panel-title">{!! $user->full_name !!}</h3>
                                <span class="text-info">{!! $user->email !!}</span>
                            </div>
                            <div class="panel-body">

                                <div class="col-lg-6 col-md-6">
                                    <ul class="list-unstyled">
                                        <li class="list-group-item">Fecha de alta: {!! $user->fecha_creado !!}</li>
                                        <li class="list-group-item"><i class="fa fa-phone"></i> {!! $user->telefono !!}</li>
                                        <li class="list-group-item">DNI: {!! $user->dni !!}</li>
                                        @if(Auth::user()->id == $user->id || Auth::user()->is('superadmin|admin'))
                                            <li class="list-group-item">
                                                <a href="{{ route('users.changePassword', $user->id) }}">Cambiar contraseña</a>
                                            </li>
                                        @endif
                                    </ul>
                                    <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Editar</a>
                                </div>

                                <div class="col-lg-6 col-md-6">

                                    <div class="panel panel-default">
                                        <div class="panel-heading">
                                            <h3 class="panel-title">Agregar foto de perfil</h3>
                                        </div>
                                        <div class="panel-body">

                                            <div class="formularioFoto">
                                                {!! Form::open(['url' => route('imagenes.store', ['id' => $user->id, 'model' => 'user']), 'method' => 'post', 'class' => 'form', 'enctype' => 'multipart/form-data']) !!}

                                                <div class="form-group">
                                                    <div class="input-group input-group-sm">
                                                        {!! Form::file('img', ['class' => 'form-control', 'id' => 'inputImagen']) !!}
                                                        <span class="input-group-btn">
                                            {!! Form::submit('Subir', ['class' => 'btn btn-info btn-flag']) !!}
                                            </span>
                                                    </div>
                                                </div>
                                                <div class="form-group" id="titleDescription" style="display:none">
                                                    <label for="title"><small class="text-muted">Agregue una descripción de la foto</small></label>
                                                    {!! Form::text('title', null, ['class' => 'form-control']) !!}
                                                </div>

                                                {!! Form::close() !!}

                                            </div>

                                            @if(count($user->images) > 0)

                                                <ul class="list-inline">
                                                    @foreach($user->images as $imagen)
                                                        <li>
                                            <span style="display: inline-block">
                                                <a href="" data-toggle="modal" data-target="#modalVerImage{!! $imagen->id !!}">
                                                <img src="{{ route('imagenes.ver', $imagen->path) }}" class="img-responsive" style="{!! ($imagen->principal == 0)? 'opacity: 0.5;' : '' !!} height: 80px">
                                            </a>
                                            </span>
                                                            <div class="modal fade" id="modalVerImage{!! $imagen->id !!}">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-body">
                                                                            <img src="{{ route('imagenes.ver', $imagen->path) }}" class="img-responsive" style="margin: 0px auto">
                                                                        </div>
                                                                        <div class="modal-footer">

                                                                            @if($imagen->principal == 0)
                                                                                <a href="{{ route('imagenes.principal', $imagen->id) }}" class="btn btn-primary" title="Marcar como principal">Marcar como principal</a>
                                                                            @else
                                                                                <a href="#" class="btn btn-primary" disabled title="Marcar como principal">Marcar como principal</a>
                                                                            @endif
                                                                            <button class="btn btn-danger" title="Eliminar foto" data-toggle="modal" data-target="#modalDeleteImage{!! $imagen->id !!}">Eliminar</button>
                                                                            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
                                                                            <div class="modal fade text-left" id="modalDeleteImage{!! $imagen->id !!}">
                                                                                <div class="modal-dialog">
                                                                                    <div class="modal-content">
                                                                                        <div class="modal-header">
                                                                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                                                <span aria-hidden="true">&times;</span></button>
                                                                                            <h4 class="modal-title">Eliminar imagen</h4>
                                                                                        </div>
                                                                                        <div class="modal-body">
                                                                                            <p class="text-red">¿Está seguro que desea eliminar la imagen?</p>
                                                                                        </div>
                                                                                        <div class="modal-footer">
                                                                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                                                                                            {!! Form::open(['method' => 'DELETE', 'url' => route('imagenes.delete', $imagen->id)]) !!}
                                                                                            {!! Form::submit('Eliminar de todos modos', ['class' => 'btn btn-danger']) !!}
                                                                                            {!! Form::close() !!}
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif

                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>

        $('#inputImagen').change(function() {
            $('#titleDescription').fadeIn();
        });

    </script>

@endsection


