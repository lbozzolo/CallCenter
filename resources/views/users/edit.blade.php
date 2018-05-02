@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <div class="col-lg-6 col-lg-offset-3">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <h2 class="panel-title">Editar perfil de {!! $user->full_name !!}</h2>
                        </div>
                        <div class="panel-body">
                            {!! Form::model($user, ['method' => 'put', 'url' => route('users.update', ['id' => $user->id, 'route' => $route]), 'class' =>'form']) !!}

                            <div class="form-group">
                                {!! Form::label('roles', 'Roles:') !!}
                                ({!! $rolesActuales !!})
                                {!! Form::select('roles[]', $roles, $user->roles->first()->id, ['class' => 'form-control select2 multiple']) !!}
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
                            </div>
                            <div class="form-group">
                                {!! Form::label('dni', 'DNI') !!}
                                {!! Form::text('dni', null, ['class' => 'form-control']) !!}
                            </div>

                            {!! Form::submit('Guardar cambios', ['class' => 'btn btn-primary']) !!}
                            <a href="{{ URL::previous() }}" class="btn btn-default">Cerrar</a>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div>

                <hr>

            </div>
        </div>
    </div>

@endsection

@section('js')

    <script>


        $('.select2').select2({
            multiple: true,
        });

    </script>

@endsection
