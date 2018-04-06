@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">
            <h2>Roles y permisos</h2>
            <hr>
            <div class="col-lg-4">

                <h3>Roles actuales</h3>
                    <div class="box">
                        <i class="glyphicon glyphicon-info-sign"></i>
                        <small class="text-muted">Haga click en un rol para asignarle permisos o editarlo</small>
                    </div>
                    <ul class="list-group">
                        @foreach($roles as $role)
                            <li class="list-group-item" style="padding: 0px">
                                @if($role->slug != 'superadmin')
                                <button type="button" title="Eliminar" class="pull-right nonStyledButton" data-toggle="modal" data-target="#eliminarRol{!! $role->id !!}" style="border: none">
                                    <i class="glyphicon glyphicon-trash small text-danger"></i>
                                </button>
                                @endif
                                <a href="{{ route('roles.index', $role->id) }}" style="display: block; padding: 10px 20px; margin: 0px">
                                    <strong>{!! $role->name !!} ({!! $role->slug !!}) - </strong>Nivel {!! $role->level !!}<br>
                                    <small>{!! $role->description !!}</small>
                                </a>
                            </li>

                            <div class="modal fade" id="eliminarRol{!! $role->id !!}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span></button>
                                            <h4 class="modal-title"><i class="fa fa-warning "></i> Eliminar rol</h4>
                                        </div>
                                        <div class="modal-body">
                                            <p class="text-danger">
                                                Usted está a punto de eliminar el rol de '{!! $role->name !!}' devinitivamente<br>
                                                Al hacerlo puede ocasionar problemas al sistema.
                                            </p>
                                            <p>¿Desea continuar?</p>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Cancelar</button>
                                            {!! Form::open(['route'  => ['roles.destroy', $role->id], 'method' => 'delete']) !!}
                                            {!! Form::hidden('role_id', $role->id) !!}
                                            <button type="submit" class="btn btn-danger pull-right">Eliminar de todos modos</button>
                                            {!! Form::close() !!}
                                        </div>
                                    </div>
                                </div>
                            </div>

                        @endforeach

                    </ul>




            </div>
            <div class="col-lg-6 col-lg-offset-1">

                <h3>Crear nuevo rol</h3>
                {!! Form::open(['method' => 'post', 'url' => route('roles.create'), 'class' => 'form']) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Nombre') !!}
                    {!! Form::text('name', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('description', 'Descripción') !!}
                    {!! Form::text('description', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('slug', 'Slug') !!}
                    {!! Form::text('slug', null, ['class' => 'form-control']) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('level', 'Nivel (de 1 a 10)') !!}
                    {!! Form::number('level',null, ['class' => 'form-control', 'min' => '1', 'max' => '10']) !!}
                </div>

                {!! Form::submit('Crear rol', ['class' => 'btn btn-primary']) !!}

                {!! Form::close() !!}

            </div>
            </div>
        </div>
    </div>

@endsection