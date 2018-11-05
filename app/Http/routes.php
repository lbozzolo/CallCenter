<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

require(__DIR__ . '/Routes/auth.php');


Route::group(['middleware' => ['auth', 'new.user']], function () {


    Route::get('/', ['as' => '/', 'uses' => 'DashboardController@index']);

    require(__DIR__ . '/Routes/users.php');
    require(__DIR__ . '/Routes/roles.php');
    require(__DIR__ . '/Routes/permissions.php');
    require(__DIR__ . '/Routes/clientes.php');
    require(__DIR__ . '/Routes/productos.php');
    require(__DIR__ . '/Routes/categorias.php');
    require(__DIR__ . '/Routes/marcas.php');
    require(__DIR__ . '/Routes/noticias.php');
    require(__DIR__ . '/Routes/instituciones.php');
    require(__DIR__ . '/Routes/llamadas.php');
    require(__DIR__ . '/Routes/ventas.php');
    require(__DIR__ . '/Routes/imagenes.php');
    require(__DIR__ . '/Routes/etapas.php');
    require(__DIR__ . '/Routes/reclamos.php');
    require(__DIR__ . '/Routes/address.php');
    require(__DIR__ . '/Routes/enviopack.php');
    require(__DIR__ . '/Routes/formas-pago.php');
    require(__DIR__ . '/Routes/asignaciones.php');
    require(__DIR__ . '/Routes/updateables.php');

    //Ruta para ejecutar pruebas
    Route::get('/test', ['as' => 'test', 'uses' => 'DashboardController@test']);


});


