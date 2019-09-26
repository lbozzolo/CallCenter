<?php

Route::get('sucursales', [
    'as' => 'sucursales.index',
    'uses' => 'SucursalesController@index',
]);

Route::get('sucursales/crear', [
    'as' => 'sucursales.create',
    'uses' => 'SucursalesController@create',
]);

Route::post('sucursales/crear', [
    'as' => 'sucursales.store',
    'uses' => 'SucursalesController@store',
]);

Route::get('sucursales/{id}/editar', [
    'as' => 'sucursales.edit',
    'uses' => 'SucursalesController@edit',
]);

Route::put('sucursales/{id}/actualizar', [
    'as' => 'sucursales.update',
    'uses' => 'SucursalesController@update',
]);

Route::get('sucursales/{id}/eliminar', [
    'as' => 'sucursales.destroy',
    'uses' => 'SucursalesController@destroy',
]);