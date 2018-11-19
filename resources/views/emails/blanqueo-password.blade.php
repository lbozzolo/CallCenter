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
    <p>Su contraseña se ha blanqueado con éxito</p>
    <p>Su contraseña para ingresar es <span class="lead" style="color: dodgerblue">{!! $password !!}</span></p>
    <p>Haga click en el siguiente link para iniciar sesión</p>
    <a href="{{ route('login') }}">{{ route('login') }}</a>
    <p>Una vez ingresado, recuerde cambiar la contraseña para su seguridad</p>
</div>
