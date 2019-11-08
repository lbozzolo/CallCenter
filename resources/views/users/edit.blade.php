@extends('users.base')

@section('titulo')

    <h2>
        @if($user->profile_image)
            <img src="{{ route('imagenes.ver', $user->profile_image) }}" class="img-circle" style="object-fit: cover; width: 50px; height: 50px; margin-bottom: 10px">
        @endif
        {!! $user->full_name !!}
        <span class="text-muted"> / Editar perfil</span>
    </h2>

@endsection

@section('contenido')


        <div class="col-lg-6 col-md-6">
            <div class="card-body">
                
                <div class="panel-body">
                    {!! Form::model($user, ['method' => 'put', 'url' => route('users.update', ['id' => $user->id, 'route' => $route]), 'class' =>'form']) !!}

                    <div class="form-group">
                        {!! Form::label('roles', 'Roles:') !!}
                        {!! Form::select('roles[]', $roles, null, ['class' => 'form-control select2 multiple roles']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('sucursales', 'Sucursales:') !!}
                        {!! Form::select('sucursales[]', $sucursales, null, ['class' => 'form-control select2 sucursales']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('nombre', 'Nombre') !!}
                        {!! Form::text('nombre', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('apellido', 'Apellido') !!}
                        {!! Form::text('apellido', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', 'Email') !!}
                        {!! Form::email('email', null, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('telefono', 'Teléfono') !!}
                        {!! Form::text('telefono', null, ['class' => 'form-control']) !!}
                        <small class="text-warning">El teléfono debe ser un número sin caracteres especiales</small>
                    </div>
                    <div class="form-group">
                        {!! Form::label('dni', 'DNI') !!}
                        {!! Form::text('dni', null, ['class' => 'form-control']) !!}
                    </div>

                    <button type="submit" class="btn btn-primary">Guardar cambios</button>
                    <a href="{!! route('users.index') !!}" class="btn btn-default">Cancelar</a>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>

        <div class="col-lg-6 col-md-6">

            @permission('blanquear.password.usuario')
            <div class="card">
                <div class="card-body">

                    <span title="Blanquear contraseña" style="cursor: pointer; color:cyan" data-toggle="modal" data-target="#blanquear{!! $user->id !!}" >
                        Blanquear contraseña
                    </span>
                    <div class="modal fade col-lg-4 col-lg-offset-8 text-left" id="blanquear{!! $user->id !!}">
                        <div class="card">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span></button>
                                <h4 class="modal-title">Blanquear contraseña</h4>
                            </div>
                            <div class="modal-body">
                                <p>
                                    ¿Desea blanquear la contraseña de este usuario?<br>
                                    <em class="text-danger">{!! $user->full_name !!}</em>
                                </p>
                            </div>
                            <div class="modal-footer">
                                <a href="{{ route('users.blanqueo.password', $user->id) }}" class="btn btn-primary">Blanquear contraseña</a>
                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            @endpermission

            <div class="card">

                <div class="card-body">
                    <p>Agregar foto de perfil</p>
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
                                                    <div class="modal fade text-left col-lg-3 col-md-3 col-sm-4 col-lg-offset-9 col-md-offset-9 col-sm-offset-8" id="modalDeleteImage{!! $imagen->id !!}">
                                                        <div class="card">
                                                            <div class="card-header">
                                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                                    <span aria-hidden="true">&times;</span></button>
                                                                <h4 class="modal-title">Eliminar imagen</h4>
                                                            </div>
                                                            <div class="card-body">
                                                                <p class="text-red">¿Está seguro que desea eliminar la imagen?</p>
                                                            </div>
                                                            <div class="card-footer">
                                                                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                                                                {!! Form::open(['method' => 'DELETE', 'url' => route('imagenes.delete', $imagen->id)]) !!}
                                                                <button type="submit" class="btn btn-danger">Eliminar</button>
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
        </div>




@endsection

@section('js')

    <script type="text/javascript">

        var rolesActuales =  [<?php echo '"'.implode('","', $user->roles_ids).'"' ?>];
        var sucursalesActuales =  [<?php echo '"'.implode('","', $user->sucursales_ids).'"' ?>];

        $('.roles').select2({
            multiple: true
        }).select2('val', rolesActuales);

        $('.sucursales').select2({
            multiple: false
        }).select2('val', sucursalesActuales);

    </script>

@endsection
