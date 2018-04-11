<?php

Route::get('productos', [
    'as' => 'productos.index',
    'uses' => 'ProductosController@index'
]);

Route::get('productos/crear', [
    'as' => 'productos.create',
    'uses' => 'ProductosController@create'
]);

Route::post('productos/crear', [
    'as' => 'productos.store',
    'uses' => 'ProductosController@store'
]);

Route::get('productos/{id}/ver', [
    'as' => 'productos.show',
    'uses' => 'ProductosController@show'
]);

Route::get('productos/{id}/editar', [
    'as' => 'productos.edit',
    'uses' => 'ProductosController@edit'
]);

Route::put('productos/{id}/actualizar', [
    'as' => 'productos.update',
    'uses' => 'ProductosController@update'
]);

Route::delete('productos/{id}/eliminar', [
    'as' => 'productos.destroy',
    'uses' => 'ProductosController@destroy'
]);