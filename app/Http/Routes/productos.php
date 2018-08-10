<?php

Route::get('productos', [
    'as' => 'productos.index',
    'uses' => 'ProductosController@index',
    'middleware' => 'permission:listado.producto'
]);

Route::get('productos/inactivos', [
    'as' => 'productos.index.inactivos',
    'uses' => 'ProductosController@indexInactivos',
    'middleware' => 'permission:listado.producto'
]);

Route::get('productos/crear', [
    'as' => 'productos.create',
    'uses' => 'ProductosController@create',
    'middleware' => 'permission:crear.producto'
]);

Route::post('productos/crear', [
    'as' => 'productos.store',
    'uses' => 'ProductosController@store',
    'middleware' => 'permission:crear.producto'
]);

Route::get('productos/{id}/ver', [
    'as' => 'productos.show',
    'uses' => 'ProductosController@show',
    'middleware' => 'permission:ver.producto'
]);

Route::get('productos/{id}/editar', [
    'as' => 'productos.edit',
    'uses' => 'ProductosController@edit',
    'middleware' => 'permission:editar.producto'
]);

Route::get('productos/{id}/etapas', [
    'as' => 'productos.etapas',
    'uses' => 'ProductosController@etapas',
    'middleware' => 'permission:editar.producto'
]);

Route::post('productos/{id}/etapas', [
    'as' => 'productos.etapas.store',
    'uses' => 'ProductosController@etapasStore',
    'middleware' => 'permission:editar.producto'
]);

Route::put('productos/{id}/actualizar', [
    'as' => 'productos.update',
    'uses' => 'ProductosController@update',
    'middleware' => 'permission:editar.producto'
]);

Route::put('productos/{id}/actualizar-stock', [
    'as' => 'productos.update.stock',
    'uses' => 'ProductosController@updateStock',
    'middleware' => 'permission:editar.producto'
]);

Route::delete('productos/{id}/eliminar', [
    'as' => 'productos.destroy',
    'uses' => 'ProductosController@destroy',
    'middleware' => 'permission:eliminar.producto'
]);

Route::get('productos/{id}/cambiar-estado', [
    'as' => 'productos.change.state',
    'uses' => 'ProductosController@changeState',
    'middleware' => 'permission:cambiar.estado.producto'
]);

Route::get('productos/{id}/imagenes', [
    'as' => 'productos.imagenes',
    'uses' => 'ProductosController@adminImagenes',
    'middleware' => 'permission:ver.producto'
]);

Route::get('productos/buscar', [
    'as' => 'productos.buscar',
    'uses' => 'ProductosController@buscar',
    'middleware' => 'permission:ver.producto'
]);

Route::get('productos/prospecto', [
    'as' => 'productos.prospecto',
    'uses' => 'ProductosController@prospecto',
    'middleware' => 'permission:ver.producto'
]);