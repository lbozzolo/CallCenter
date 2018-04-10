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
    <h1>CallCenter</h1>
    <p>Bienvenido al sistema CallCenter</p>
    <p>Tu contraseña para ingresar es <span class="lead">{!! $password !!}</span></p>
    <p>Haz click en el siguiente link para iniciar sesión</p>
    <a href="{{ route('login') }}">{{ route('login') }}</a>
</div>
