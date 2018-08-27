@extends('layout')


@section('login')
    <div class="container-fluid" style="background: url(/img/fondologin.jpg); background-size: cover); width: 100%; height: 100%">
        <div class="row text-center">
            <img src="{{ asset('/img/logo.png') }}" alt="Logo smartline" style="margin: 5% auto; width: 25%;">
        </div>
        <div class="row">
            <div class="col-md-8 col-md-offset-2" style="margin-top: 12%">
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
                        <div class="col-md-8  col-md-offset-2">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <!--<label class="col-md-4 control-label">{{ trans('validation.attributes.email') }}</label>-->
                                <div class="col-12">
                                    {!! Form::text('email', null, ['class' => 'form-control', 'type' => 'email', 'style'=> 'background: rgba(255,255,255,0.3); height: 60px;', 'placeholder'=>'Usuario']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <!--<label class="col-md-4 control-label">{{ trans('validation.attributes.password') }}</label>-->
                                <div class="col-12">
                                    {!! Form::password('password', ['class' => 'form-control', 'style'=> 'background: rgba(255,255,255,0.3); height: 60px;', 'placeholder'=>'Contraseña', 'border'=>'1px solid #f6bf8c;']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="checkbox">
                                            <span style="background: rgba(255,255,255,0.5); padding:3%; border-radius:3px">
                                            <label>
                                                <input type="checkbox" name="remember"> Recordarme
                                            </label>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-md-offset-2">
                                        <button type="submit" class="btn btn-primary" style="float:right">
                                        Ingresar
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col">
                                    <span style="background: rgba(255,255,255,0.5); padding:1%; border-radius:8px">
                                    <a href="{{ route('password.email') }}">¿Olvidaste tu contraseña?</a>
                                    </span>
                                </div>
                            </div>
                        </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection