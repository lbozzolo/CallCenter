@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">
                <h2>Editar perfil</h2>
                <hr>
                <div class="col-lg-6 col-md-6">
                    {!! Form::open(['method' => 'put', 'url' => route('users.update', $user->id), 'class' =>'form']) !!}

                    <div class="form-group">
                        {!! Form::label('nombre', 'Nombre') !!}
                        {!! Form::text('nombre', $user->nombre, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('apellido', 'Apellido') !!}
                        {!! Form::text('apellido', $user->apellido, ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('email', 'Email') !!}
                        {!! Form::email('email', $user->email, ['class' => 'form-control']) !!}
                    </div>

                    {!! Form::submit('Guardar cambios', ['class' => 'btn btn-primary']) !!}
                    <a href="{{ route('users.profile', $user->id) }}" class="btn btn-default">Cancelar</a>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection



