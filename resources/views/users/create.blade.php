@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">

                <div class="row">
                    <div class="col-lg-12">
                        <h2>Usuarios<span class="text-muted"> / Crear nuevo usuario</span></h2>
                        @include('users.partials.navbar')
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-lg-offset-3">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                <h2 class="panel-title">Crear nuevo usuario</h2>
                            </div>
                            <div class="panel-body">
                                {!! Form::open(['method' => 'post', 'url' => route('users.store'), 'class' =>'form']) !!}

                                <div class="form-group">
                                    {!! Form::label('roles', 'Roles:') !!}
                                    {!! Form::select('roles[]', $roles, null, ['class' => 'form-control select2 multiple']) !!}
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

                                {!! Form::submit('Crear usuario', ['class' => 'btn btn-primary']) !!}
                                <a href="{{ URL::previous() }}" class="btn btn-default">Cancelar</a>

                                {!! Form::close() !!}
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

        $('.select2').select2({
            multiple: true,
        });

    </script>

@endsection
