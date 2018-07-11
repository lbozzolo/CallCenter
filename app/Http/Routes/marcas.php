<?php

Route::get('marcas', [
    'as' => 'marcas.index',
    'uses' => 'MarcasController@index',
    'middleware' => 'permission:listado.marca'
]);

Route::get('marcas/crear', [
    'as' => 'marcas.create',
    'uses' => 'MarcasController@create',
    'middleware' => 'permission:crear.marca'
]);

Route::post('marcas/crear', [
    'as' => 'marcas.store',
    'uses' => 'MarcasController@store',
    'middleware' => 'permission:crear.marca'
]);

Route::get('marcas/{id}', [
    'as' => 'marcas.show',
    'uses' => 'MarcasController@show',
    'middleware' => 'permission:ver.marca'
]);

Route::get('marcas/{id}/editar', [
    'as' => 'marcas.edit',
    'uses' => 'MarcasController@edit',
    'middleware' => 'permission:editar.marca'
]);

Route::put('marcas/{id}/actualizar', [
    'as' => 'marcas.update',
    'uses' => 'MarcasController@update',
    'middleware' => 'permission:editar.marca'
]);

Route::delete('marcas/{id}/eliminar', [
    'as' => 'marcas.destroy',
    'uses' => 'MarcasController@destroy',
    'middleware' => 'permission:eliminar.marca'
]);