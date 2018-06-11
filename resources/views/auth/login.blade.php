@extends('layout')

@include('partials.navbar')

@section('login')
    <div class="container-fluid">
        <form class="form-signin">
          <img class="mb-4" src="https://getbootstrap.com/assets/brand/bootstrap-solid.svg" alt="" width="72" height="72">
          <h1 class="h3 mb-3 font-weight-normal">Iniciar sesión</h1>
          <label for="inputEmail" class="sr-only">Email</label>
          <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
          <label for="inputPassword" class="sr-only">Contraseña</label>
          <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>
          <div class="checkbox mb-3">
            <label>
              <input type="checkbox" value="remember-me"> Recordarme
            </label>
          </div>
          <button class="btn btn-lg btn-primary btn-block" type="submit">Iniciar sesión</button>
          <p class="mt-5 mb-3 text-muted">&copy; Smartline 2018</p>
        </form>
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



        <div class="row d-flex">
            <div class="col-12 mx-auto">
                <div class="row">
                    <div class="h1 text-center">
                        Iniciar sesión
                    </div>
                    <hr>
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
                </div>
                <div class="row">
                    <div class="container d-flex justify-content-center">
                        <form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <div class="col-12 mx-auto">
                                    {!! Form::text('email', null, ['placeholder' => 'Mail', 'class' => 'form-control', 'type' => 'email']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-12">
                                    {!! Form::password('password', ['class' => 'form-control']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-6 d-flex">
                                    <div class="checkbox ml-auto">
                                        <input type="checkbox" name="remember"> Recordarme
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-6 col-md-offset-4">
                                    <button type="submit" class="btn btn-primary" style="margin-right: 15px;">
                                        Entrar
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>                    
                </div>
                <div class="row">
                    <hr>
                    <div class="col-12">
                        <a href="{{ route('password.email') }}" class="text-center">¿Olvidaste tu contraña?
                    </div>
                </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection