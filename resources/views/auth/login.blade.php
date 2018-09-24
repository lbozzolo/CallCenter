@extends('layout')


@section('login')


    <div class="container-fluid" style="background: url({{ asset('/img/fondologin.jpg') }}); background-size: cover;height:100vh;">

        <div class="unix-login">
            <div class="container">
                <div class="row">
                    <div class="col-lg-4 col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3 col-lg-offset-4">
                        <div class="login-content">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    Por favor corrige los siguientes errores:<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <div class="login-form">
                                <img src="{{ asset('/img/logo.png') }}" alt="Logo smartline" width="200px">
                               <br><br>

                                {!! Form::open(['method' => 'post', 'url' => route('login'), 'class' => 'form-horizontal']) !!}

                                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <div class="form-group">
                                        {!! Form::text('email', null, ['class' => 'form-control', 'type' => 'email', 'style'=> 'background: rgba(255,255,255,0.3); ', 'placeholder'=>'Usuario']) !!}
                                    </div>
                                    <div class="form-group">
                                        {!! Form::password('password', ['class' => 'form-control', 'style'=> 'background: rgba(255,255,255,0.3); ', 'placeholder'=>'Contraseña', 'border'=>'1px solid #f6bf8c;']) !!}
                                    </div>
                                    <div class="checkbox">
                                        <label>
                                            <input type="checkbox" name="remember"> Recordarme
                                        </label>
                                        <label class="pull-right">
                                            <a href="{{ route('password.email') }}">Olvido su Contraseña?</a>
                                        </label>

                                    </div>
                                    <button type="submit" class="btn btn-primary btn-flat m-b-15 m-t-15">Ingresar</button>

                                {!! Form::close() !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection