@extends('layout')


@section('login')
    <div class="container-fluid" style="background: url(/img/fondologin.jpg); background-size: cover); width: 100%; height: 100%">
    <div class="unix-login">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-lg-offset-3">
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
                            <center><img src="{{ asset('/img/logo.png') }}" alt="Logo smartline"></center>
                           <br><br>
                            <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                <div class="form-group">
                                    <label>Usuario</label>
                                    {!! Form::text('email', null, ['class' => 'form-control', 'type' => 'email', 'style'=> 'background: rgba(255,255,255,0.3); height: 60px;', 'placeholder'=>'Usuario']) !!}
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    {!! Form::password('password', ['class' => 'form-control', 'style'=> 'background: rgba(255,255,255,0.3); height: 60px;', 'placeholder'=>'Contraseña', 'border'=>'1px solid #f6bf8c;']) !!}
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
                                
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>
@endsection