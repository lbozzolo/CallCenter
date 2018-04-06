@extends('base')

@section('content')

    <div class="row">
        <div class="container">
            <div class="content">
                <h2>Cambiar contraseña</h2>
                <hr>
                <div class="col-lg-6 col-md-6">
                    {!! Form::open(['method' => 'put', 'url' => route('users.storeNewPassword'), 'class' => 'form']) !!}

                    {!! Form::hidden('user_id', $userId) !!}

                    <div class="form-group">
                        {!! Form::label('current_password', 'Contraseña actual') !!}
                        {!! Form::password('current_password', ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password', 'Nueva contraseña') !!}
                        {!! Form::password('password', ['class' => 'form-control']) !!}
                    </div>
                    <div class="form-group">
                        {!! Form::label('password_confirmation', 'Repetir nueva contraseña') !!}
                        {!! Form::password('password_confirmation', ['class' => 'form-control']) !!}
                    </div>

                    {!! Form::submit('Cambiar contraseña', ['class' => 'btn btn-primary']) !!}
                    <a href="{{ route('users.profile', $userId) }}" class="btn btn-default">Cancelar</a>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection



