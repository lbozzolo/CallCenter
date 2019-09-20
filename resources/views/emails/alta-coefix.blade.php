<!DOCTYPE html>
<html lang="en" class="dark">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Webstrot Admin : Invoice</title>

    <!-- ================= Favicon ================== -->
    <!-- Standard -->
    <link rel="shortcut icon" href="http://placehold.it/64.png/000/fff">
    <!-- Retina iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="144x144" href="http://placehold.it/144.png/000/fff">
    <!-- Retina iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="114x114" href="http://placehold.it/114.png/000/fff">
    <!-- Standard iPad Touch Icon-->
    <link rel="apple-touch-icon" sizes="72x72" href="http://placehold.it/72.png/000/fff">
    <!-- Standard iPhone Touch Icon-->
    <link rel="apple-touch-icon" sizes="57x57" href="http://placehold.it/57.png/000/fff">

    <style type="text/css">

        .bienvenida {
            color: white;
        }

        .bg-primary {
            background-color: #1F2037;
            font-family: sans-serif;
        }

        .unix-invoice {
            background-color: #333B54;
            /*background-color: red;*/
            padding: 20px;
            width: 80%;
            margin: 30px auto;
            border-radius: 5px;
        }
        #invoice {
            width: 100%;
            display: inline-block;
        }
        #invoice-top {
            padding: 10px 20px;
        }
        #invoice-mid {
            background-color: #262c3f;
            padding: 10px 10px;
            border-radius: 10px;
        }
        #invoice-bot {
            padding: 10px 20px;
        }
        .invoice-info span{
            color: white;
        }
        .title p {
            color: grey;
        }

        h2 {
            color: white;
            font-weight: 100;
        }
        ul {
            color: white;
        }
        .username {
            color: orange;
            font-size: 1.5em;
        }
        #project {
            display: inline-block;
        }
        #invoice-table ul{
            list-style: none;
            margin-left: -40px;
        }
        #invoice-table ul li{
            padding: 10px 20px;
            background-color: #404a6b;
            border: 1px solid #2D4558
        }
        .legal {
            color: lightgray;
        }
        .btn {
            background-color: #1da1f2;
            color: white;
            padding: 5px 10px;
            border-radius: 5px;
            border: none;
            font-size: 1.2em;
            cursor: pointer;
        }
        .nuevo {
            padding: 5px 10px;
            background-color: darkgreen;
            color: white;
            border-radius: 5px;
            font-size: 0.8em;
            float: right;
        }

        @media (max-width: 360px){

            h2 {
                font-size: 1.2em;
            }

            .username {
                font-size: 1em;
            }

            #project ul li span {
                font-size: 0.8em;
            }

            #invoice-table div ul li {
                font-size: 0.8em;
            }

            .btn {
                font-size: 1em;
            }

            .legal {
                font-size: 0.7em;
            }

            .bienvenida {
                font-size: 0.9em;
            }

        }

    </style>

</head>

<body class="bg-primary">

<div class="unix-invoice">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div id="invoice" class="effect2 m-t-120">

                    <div id="invoice-top">

                        <div class="invoice-logo"></div>
                        <div class="invoice-info">
                            <img src="http://200.61.136.134/~crmcoefix/public/img/logo.png" style="width: 50%; margin: 0px auto"><br>
                            <span>info@coefix.com - </span>
                            <span>Teléfono: 011-2275-7035</span>
                            <span style="color: grey"> -  {!! $data['fecha'] !!}</span>
                        </div>

                    </div>

                    @if($data['alumno']->notificado)
                        <p class="bienvenida">
                            ¡Bienvenido/a a la plataforma educativa COEFIX!
                            Tenemos el agrado de informarle que ya forma parte de nuestra comunidad de enseñanza.
                            ¡Ya mismo puede acceder y comenzar a aprender!
                        </p>

                        <div id="invoice-mid">

                            <div id="project">
                                <h2>Información de Usuario</h2>
                                <ul>
                                    <li>
                                        <span>Nombre:</span><br>
                                        <span class="username">{!! ($data['alumno']->fullname)? $data['alumno']->fullname : '' !!}</span>
                                    </li>
                                    <li>
                                        <span>Usuario:</span><br>
                                        <span class="username">{!! ($data['alumno']->username)? $data['alumno']->username : '' !!}</span>
                                    </li>
                                    <li>
                                        <span>Contraseña:</span><br>
                                        <span class="username">#Coefix123</span>
                                    </li>
                                </ul>
                                <small style="color: gray">Recuerde cambiar la contraseña una vez iniciada sesión.</small>
                            </div>

                        </div>
                        <!--End Invoice Mid-->
                    @else

                        <p style="color: white">
                            ¡Bienvenido/a a la plataforma educativa COEFIX! Ha sido habilitado a nuevos cursos. ¡Ya mismo puede acceder y comenzar a aprender!
                        </p>

                        <div id="invoice-mid">

                            <div id="project">
                                <h2>Información de Usuario</h2>
                                <ul>
                                    <li>
                                        <span>Nombre:</span>
                                        <span class="username">{!! ($data['alumno']->fullname)? $data['alumno']->fullname : '' !!}</span>
                                    </li>
                                </ul>
                            </div>

                        </div>

                    @endif

                    <div id="invoice-bot">

                        <div id="invoice-table">
                            <h2>Cursos Activos en su Plataforma</h2>
                            <div class="table-responsive">
                                <ul>
                                    @foreach($data['alumno']->cursosActivos() as $activacion)
                                        @if(!$activacion->notificado)
                                            <li>
                                                <span class="nuevo">nuevo</span>
                                                {!! $activacion->producto->nombre !!}
                                            </li>
                                        @else
                                            <li>
                                                {!! $activacion->producto->nombre !!}
                                            </li>
                                        @endif
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <!--End Table-->


                        <a href="https://www.coefix.com/login/index.php">
                            <button class="btn" type="button">
                                <i class="ti-thumb-up"></i>Acceder a la Plataforma
                            </button>
                        </a>



                        <div id="legalcopy">
                            <p class="legal">
                                <strong>¡Gracias por confiar en Coefix!</strong> 
                                Nos aseguraremos de brindarle la mejor atención para que su experiencia sea de su agrado.
                            </p>
                        </div>

                    </div>
                    <!--End InvoiceBot-->
                </div>
                <!--End Invoice-->
            </div>
        </div>
    </div>
</div>

</body>

</html>