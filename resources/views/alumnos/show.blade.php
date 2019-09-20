@extends('alumnos.base')

@section('titulo')

    <h2>
        Alumnos /
        {!! $cliente->full_name !!}
        <span class="text-muted"> / Cursos</span>
    </h2>

@endsection

@section('contenido')

    <div class="row">
        <div class="col-lg-5">
            <div class="card card-body">
                <ul class="list-unstyled list-inline">
                    @if($cliente->email)
                        <li>
                            <h3 class="card-title"> <span class="text-info">{!! $cliente->email !!}</span></h3>
                        </li>
                    @else
                        <li>
                            <div class="form-group text-left bg-danger" style="padding: 10px">
                                <i class="fa fa-exclamation-triangle"></i>
                                <span>ATENCIÓN.</span><br>
                                <span> Este alumno aún no ha especificado un email al cual contactarlo.</span><br>
                                <span>
                                            Recuerde que si se lo habilita, el mismo deberá ser notificado de algún otro modo acerca de su USUARIO y su CONTRASEÑA
                                            ya que el sistema no podrá hacerlo automáticamente.</span>
                            </div>
                        </li>
                    @endif
                    <li>
                        @if($cliente->estado->slug == 'nuevo')
                            <label class="label label-warning">{!! $cliente->estado->nombre !!}</label>
                        @elseif($cliente->estado->slug == 'frecuente')
                            <label class="label label-primary">{!! $cliente->estado->nombre !!}</label>
                        @elseif($cliente->estado->slug == 'habilitado')
                            <label class="label label-default" style="background-color: rgb(8, 142, 83);">{!! $cliente->estado->nombre !!}</label>
                        @elseif($cliente->estado->slug == 'deshabilitado')
                            <label class="label label-danger" >{!! $cliente->estado->nombre !!}</label>
                        @endif
                    </li>
                    @if(!$cliente->dni)
                        <li>
                            <span class="label label-danger pull-right">sin dni</span>
                        </li>
                    @endif
                </ul>
                <ul class="list-unstyled listado">
                    <li class="list-group-item">

                        <div class="text-warning"><i class="fa fa-user-circle-o"></i> Usuario</div>

                        {!! Form::model($cliente, ['url' => route('alumnos.update.username', $cliente->id), 'method' => 'put']) !!}

                        <div class="input-group margin">
                            {!! Form::text('username', $cliente->username, ['class' => 'form-control', 'style="background-color: grey!important;"']) !!}
                            <span class="input-group-btn">
                                      <button type="button" class="btn btn-info btn-flat" style="padding: 9px 5px" data-target="#modificarUsername" data-toggle="modal">Modificar</button>
                                    </span>
                        </div>

                        <div class="modal fade col-lg-3 col-lg-offset-4" id="modificarUsername">
                            <div class="card">
                                <div class="card-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <h4 class="modal-title">Modificar Username</h4>
                                </div>
                                <div class="card-body">
                                    <p>¿Desea modificar el username?</p>
                                </div>
                                <div class="card-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    <button type="submit" class="btn btn-primary">Aceptar</button>
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}

                    </li>
                    <li class="list-group-item">
                        <div class="text-warning "><i class="fa fa-lock"></i> Contraseña</div>
                        <p class="lead" style="margin-bottom: 0px">#Coefix123</p>
                        <em><small style="color: lightgrey">* Esta contraseña es genérica e idéntica para todos los alumnos nuevos. Se sugiere cambiarla luego de iniciar sesión por primera vez.</small></em>
                    </li>
                </ul>
                <ul class="listado" style="margin-top: 10px">
                    <li class="list-group-item">
                        <div class="text-warning"><i class="fa fa-phone"></i> Teléfono</div>
                        <div>
                            @if($cliente->telefono)
                                <span> {!! $cliente->telefono !!}</span>
                            @endif
                            @if($cliente->celular)
                                <span> {!! $cliente->celular !!}</span>
                            @endif
                        </div>
                    </li>
                    <li class="list-group-item">
                        <div class="text-warning">DNI</div>
                        {!! ($cliente->dni)? $cliente->dni : '<small class="text-muted">No hay DNI espeficifado</small>' !!}
                    </li>
                    <li class="list-group-item">
                        <div class="text-warning">Observaciones</div>
                        {!! ($cliente->observaciones)? $cliente->observaciones : '<small class="text-muted">sin datos</small>' !!}
                    </li>
                </ul>
            </div>
        </div>
        <div class="col-lg-7">
            <div class="card card-body">
                <h3>Cursos para habilitar</h3>

                <div class="table-responsive">
                    <table class="table table-condensed">
                        <thead>
                            <tr>
                                <th>Curso</th>
                                <th class="text-center">Estado</th>
                                <th class="text-center">Fecha de activación</th>
                                <th class="text-center">Opciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($cliente->activaciones as $activacion)
                            <tr>
                                <td>{!! $activacion->producto->nombre !!}</td>
                                <td class="text-center">
                                    @if($activacion->estado == 0) <i class="fa fa-lock text-danger"></i> @else <i class="fa fa-check text-success "></i> @endif
                                </td>
                                <td class="text-center">
                                    @if($activacion->estado == 1)
                                        {!! $activacion->fecha_editado !!}
                                    @else
                                        -
                                    @endif
                                </td>
                                <td class="text-center">
                                    @if($activacion->estado == 0)
                                        <a href="{!! route('alumnos.habilitar.deshabilitar.curso', $activacion->id) !!}" class="btn btn-primary btn-xs pull-right">activar</a>
                                    @else
                                        <a href="{!! route('alumnos.habilitar.deshabilitar.curso', $activacion->id) !!}" class="btn btn-danger btn-xs pull-right">desactivar</a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="panel panel-barra">
                    <button type="button" class="btn btn-primary" data-target="#notificarAlumno" @if(!$cliente->cursosActivos($cliente->id)->count()) disabled @endif data-toggle="modal">
                        <i class="fa fa-envelope"></i> Notificar alumno
                    </button>
                    <a href="{!! route('alumnos.index') !!}" class="btn btn-default">Volver atrás</a>
                </div>
                <div class="modal fade col-lg-4 col-lg-offset-4" id="notificarAlumno">
                    <div class="card">
                        <div class="card card-body">
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                            <h4>Notificar alumnno</h4>

{{--                            @if(!$cliente->cursosActivos($cliente->id)->count())--}}
                            @if(!$cliente->notificado)
                                <div class="panel panel-barra">
                                    <p>Se enviará un email a <span class="text-primary">{!! $cliente->fullname !!}</span>  notificando la activación a la siguiente casilla:</p>
                                    <div class="lead text-warning">{!! $cliente->email !!}</div>
                                    <p>Notificando su nombre de usuario:</p>
                                    <div class="lead text-warning">{!! $cliente->username !!}</div>
                                    <p>Y su contraseña genérica (la cual deberá cambiar)</p>
                                    <div class="lead text-warning">#Coefix123</div>
                                </div>
                            @else
                                <div class="panel panel-barra">
                                    <p>
                                        Se enviará un email a <span class="text-primary">{!! $cliente->fullname !!}</span>
                                        notificando la activación a la siguiente casilla:
                                    </p>
                                    <div class="lead text-warning">{!! $cliente->email !!}</div>
                                </div>
                            @endif
                            <h4>Cursos a habilitar</h4>
                            <ul class="listado">
                                @foreach($cliente->activaciones as $activacion)
                                    @if($activacion->estado == 1)
                                        <li class="list-group-item">{!! $activacion->producto->nombre !!}</li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="card card-footer">
                            <a href="{!! route('alumnos.notificar', $cliente->id) !!}" class="btn btn-primary">Notificar</a>
                            <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </div>

                {{--@if($cliente->isDisabled())--}}
                    {{--<div class="panel panel-barra text-right">--}}
                        {{--<span class="text-warning" style="margin-right: 10px">El ALUMNO está deshabilitado en todos los cursos adquiridos</span>--}}
                        {{--<button type="button" class="btn" style="background-color: rgb(8, 142, 83)" data-target="#habilitarAlumno" data-toggle="modal">--}}
                            {{--<i class="fa fa-check"></i> Habilitar--}}
                        {{--</button>--}}
                        {{--<a href="{!! route('alumnos.index') !!}" class="btn btn-default">Volver atrás</a>--}}
                    {{--</div>--}}
                    {{--<div class="modal fade col-lg-4 col-lg-offset-4" id="habilitarAlumno">--}}
                        {{--<div class="card">--}}
                            {{--<div class="card card-body">--}}
                                {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
                                {{--<h4>Habilitar alumnno</h4>--}}

                                {{--<div class="panel panel-barra">--}}
                                    {{--<p>Se enviará un email a <span class="text-primary">{!! $cliente->fullname !!}</span>  notificando la activación a la siguiente casilla:</p>--}}
                                    {{--<div class="lead text-warning">{!! $cliente->email !!}</div>--}}
                                    {{--<p>Notificando su nombre de usuario:</p>--}}
                                    {{--<div class="lead text-warning">{!! $cliente->username !!}</div>--}}
                                    {{--<p>Y su contraseña genérica (la cual deberá cambiar)</p>--}}
                                    {{--<div class="lead text-warning">#Coefix123</div>--}}
                                {{--</div>--}}
                                {{--<h4>Cursos a habilitar</h4>--}}
                                {{--<ul class="listado">--}}
                                    {{--@foreach($cliente->activaciones as $activacion)--}}
                                        {{--<li class="list-group-item">{!! $activacion->producto->nombre !!}</li>--}}
                                    {{--@endforeach--}}
                                    {{--@foreach($cliente->cursos($cliente->id) as $curso)--}}
                                        {{--<li class="list-group-item">{!! $curso->nombre !!}</li>--}}
                                    {{--@endforeach--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                            {{--<div class="card card-footer">--}}
                                {{--<a href="{!! route('alumnos.habilitar.deshabilitar.alumno', $cliente->id) !!}" class="btn" style="background-color: rgb(8, 142, 83)">Habilitar</a>--}}
                                {{--<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@else--}}
                    {{--<div class="panel panel-barra text-right">--}}
                        {{--<span class="text-success" style="margin-right: 10px">El ALUMNO está habilitado en todos los cursos adquiridos</span>--}}
                        {{--<button type="button" class="btn btn-danger" data-target="#deshabilitarAlumno" data-toggle="modal">--}}
                            {{--<i class="fa fa-ban"></i> Deshabilitar--}}
                        {{--</button>--}}
                        {{--<a href="{!! route('alumnos.index') !!}" class="btn btn-default">Volver atrás</a>--}}
                    {{--</div>--}}
                    {{--<div class="modal fade col-lg-4 col-lg-offset-4" id="deshabilitarAlumno">--}}
                        {{--<div class="card">--}}
                            {{--<div class="card card-header">--}}
                                {{--<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>--}}
                                {{--<h4>Deshabilitar alumnno</h4>--}}

                                {{--<p>¿Desea deshabilitar a <span class="text-primary">{!! $cliente->fullname !!}</span>  en los siguientes cursos?</p>--}}
                                {{--<ul class="listado">--}}
                                    {{--@foreach($cliente->activaciones as $activacion)--}}
                                        {{--<li class="list-group-item">{!! $activacion->producto->nombre !!}</li>--}}
                                    {{--@endforeach--}}
                                    {{--@foreach($cliente->cursos($cliente->id) as $curso)--}}
                                        {{--<li class="list-group-item">{!! $curso->nombre !!}</li>--}}
                                    {{--@endforeach--}}
                                {{--</ul>--}}
                            {{--</div>--}}
                            {{--<div class="card card-footer">--}}
                                {{--<a href="{!! route('alumnos.habilitar.deshabilitar.alumno', $cliente->id) !!}" class="btn btn-danger">Deshabilitar</a>--}}
                                {{--<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--@endif--}}
            </div>
        </div>

    </div>

@endsection