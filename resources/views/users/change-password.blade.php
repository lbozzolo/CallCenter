@extends('base')

@section('content')

    <div class="row">

        <h2>Cambiar contraseña</h2>
        <div class="card">
            <div class="card-body">

                @if($user->profile_image)
                    <img src="{{ route('imagenes.ver', $user->profile_image) }}" class="img-circle pull-right" style="object-fit: cover; width: 120px; height: 120px">
                @endif

                <div class="col-lg-6 col-md-6">
                    {!! Form::open(['method' => 'put', 'url' => route('users.storeNewPassword'), 'class' => 'form']) !!}

                    {!! Form::hidden('user_id', $user->id) !!}

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

                    <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
                    <a href="{{ route('users.profile', $user->id) }}" class="btn btn-default">Cancelar</a>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection



