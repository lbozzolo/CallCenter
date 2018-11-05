@extends('users.base')

@section('titulo')

    <h2>
        @if($user->profile_image)
            <img src="{{ route('imagenes.ver', $user->profile_image) }}" class="img-circle" style="object-fit: cover; width: 80px; height: 80px; margin-bottom: 10px">
        @endif
        {!! $user->full_name !!}
        <span class="text-muted"> / Perfil de usuario</span>
    </h2>

@endsection

@section('contenido')

    <div class="card">
        <span class="pull-right"> @include('users.partials.labels-roles-inline')</span>
        <span class="text-info">{!! $user->email !!}</span>
    </div>
    <div class="row">
        <div class="col-lg-6 col-md-6">
            <div class="card">
                <ul class="list-unstyled listado">
                    <li class="list-group-item">Fecha de alta: {!! $user->fecha_creado !!}</li>
                    <li class="list-group-item"><i class="fa fa-phone"></i>Teléfono:  {!! ($user->telefono)? $user->telefono : "<small class='text-muted'>sin datos</small>" !!}</li>
                    <li class="list-group-item">DNI: {!! ($user->dni)? $user->dni : "<small class='text-muted'>sin datos</small>" !!}</li>
                    @if(Auth::user()->id == $user->id || Auth::user()->is('superadmin'))
                        <li class="list-group-item">
                            <a href="{{ route('users.changePassword', $user->id) }}" style="color: cyan">Cambiar contraseña</a>
                        </li>
                    @endif
                </ul>
                @if(Auth::user()->id == $user->id || Auth::user()->is('superadmin|admin'))
                    <div style="padding: 10px 0px"><a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Editar</a></div>
                @endif
            </div>
        </div>
        <div class="col-lg-6 col-md-6">
            @if(Auth::user()->id == $user->id || Auth::user()->is('superadmin|admin'))
                <div class="card card-default">
                    <div class="card-heading">
                        <h3 class="card-title">Agregar foto de perfil</h3>
                    </div>
                    <div class="card-body">

                        <div class="formularioFoto">
                            {!! Form::open(['url' => route('imagenes.store', ['id' => $user->id, 'model' => 'user']), 'method' => 'post', 'class' => 'form', 'enctype' => 'multipart/form-data']) !!}

                            <div class="form-group">
                                <div class="input-group input-group-sm">
                                    {!! Form::file('img', ['class' => 'form-control', 'id' => 'inputImagen']) !!}
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-primary btn-flag">Subir</button>
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
                                    @if($imagen->image_exists)
                                        <li>
                                            <span style="display: inline-block">
                                                <a href="" data-toggle="modal" data-target="#modalVerImage{!! $imagen->id !!}">
                                                    <img src="{{ route('imagenes.ver', $imagen->path) }}" class="img-responsive" style="{!! ($imagen->principal == 0)? 'opacity: 0.5;' : '' !!} height: 80px">
                                                </a>
                                            </span>
                                            <div class="modal fade col-lg-6 col-lg-offset-3" id="modalVerImage{!! $imagen->id !!}">
                                                <div class="card">
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
                                                        <div class="modal fade col-lg-4 col-lg-offset-8" id="modalDeleteImage{!! $imagen->id !!}">
                                                            <div class="card">
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
                                                                    <button type="submit" class="btn btn-danger">Eliminar de todos modos</button>
                                                                    {!! Form::close() !!}
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endif
                                @endforeach
                            </ul>
                        @endif

                    </div>
                </div>
            @endif
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


