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
    <p>Haga click en el siguiente link para resetear su contraseña:</p>
    <a href="{{ route('reset.link', $token) }}">{{ route('reset.link', $token) }}</a>
</div>
