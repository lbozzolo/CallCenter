<head>
    <link href="https://fonts.googleapis.com/css?family=Raleway" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet">

</head>
<style>
    h1{
        font-family: Raleway;
    }
    p{
        font-family: "Open Sans";
    }
</style>

<div>
    <h1>SmartLine</h1>
    <p>Bienvenido al sistema SmartLine</p>
    <p>Su contraseña para ingresar es <span class="lead">{!! $password !!}</span></p>
    <p>Haga click en el siguiente link para iniciar sesión</p>
    <a href="{{ route('login') }}">{{ route('login') }}</a>
</div>
