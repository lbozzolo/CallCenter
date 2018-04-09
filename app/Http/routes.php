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


Route::group(['middleware' => 'auth'], function () {

    Route::get('/', [
        'as' => '/',
        'uses' => 'DashboardController@index'
    ]);

    require(__DIR__ . '/Routes/users.php');
    require(__DIR__ . '/Routes/roles.php');
    require(__DIR__ . '/Routes/permissions.php');

});


Route::get('/test', [
    'as' => 'test',
    'uses' => 'DashboardController@test'
]);