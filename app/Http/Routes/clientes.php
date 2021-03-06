<?php

Route::get('clientes', [
    'as' => 'clientes.index',
    'uses' => 'ClientesController@index',
    'middleware' => 'permission:listado.cliente'
]);

Route::get('clientes/crear', [
    'as' => 'clientes.create',
    'uses' => 'ClientesController@create',
    'middleware' => 'permission:crear.cliente'
]);

Route::post('clientes/crear', [
    'as' => 'clientes.store',
    'uses' => 'ClientesController@store',
    'middleware' => 'permission:crear.cliente'
]);

Route::get('clientes/{id}/datos', [
    'as' => 'clientes.show',
    'uses' => 'ClientesController@show',
    'middleware' => 'permission:ver.cliente'
]);

Route::get('clientes/{id}/editar', [
    'as' => 'clientes.edit',
    'uses' => 'ClientesController@edit',
    'middleware' => 'permission:editar.cliente'
]);

Route::put('clientes/{id}/actualizar', [
    'as' => 'clientes.update',
    'uses' => 'ClientesController@update',
    'middleware' => 'permission:editar.cliente'
]);

Route::post('clientes/{id}/agregar-tarjeta', [
    'as' => 'clientes.agregar.tarjeta',
    'uses' => 'ClientesController@agregarTarjeta',
    'middleware' => 'permission:agregar.tarjeta.cliente'
]);

Route::put('clientes/{id}/update-tarjeta', [
    'as' => 'clientes.update.tarjeta',
    'uses' => 'ClientesController@updateTarjeta',
    'middleware' => 'permission:editar.tarjeta.cliente'
]);

Route::delete('clientes/{id}/eliminar-tarjeta', [
    'as' => 'clientes.eliminar.tarjeta',
    'uses' => 'ClientesController@eliminarTarjeta',
    'middleware' => 'permission:eliminar.tarjeta.cliente'
]);

//Rutas de relaciones
Route::get('clientes/{id}/compras', [
    'as' => 'clientes.compras',
    'uses' => 'ClientesController@compras',
    'middleware' => 'permission:ver.compras.cliente'
]);

Route::get('clientes/{id}/compras/estado', [
    'as' => 'clientes.compras.filtrar',
    'uses' => 'ClientesController@comprasFiltrar',
    'middleware' => 'permission:ver.compras.cliente'
]);

Route::get('clientes/{id}/llamadas', [
    'as' => 'clientes.llamadas',
    'uses' => 'ClientesController@llamadas',
    'middleware' => 'permission:ver.llamadas.cliente'
]);

Route::get('clientes/{id}/reclamos', [
    'as' => 'clientes.reclamos',
    'uses' => 'ClientesController@reclamos',
    'middleware' => 'permission:ver.reclamos.cliente'
]);

Route::get('clientes/{id}/reclamo/{idReclamo}', [
    'as' => 'clientes.show.reclamo',
    'uses' => 'ClientesController@showReclamo',
    'middleware' => 'permission:ver.reclamos.cliente'
]);

Route::get('clientes/{id}/reclamo/{idReclamo}/llamada/{idLlamada}', [
    'as' => 'clientes.llamadas.show',
    'uses' => 'ClientesController@showLlamada',
    'middleware' => 'permission:ver.reclamos.cliente'
]);

Route::get('clientes/{id}/intereses', [
    'as' => 'clientes.intereses',
    'uses' => 'ClientesController@intereses',
    'middleware' => 'permission:ver.intereses.cliente'
]);

Route::get('clientes/importacion', [
    'as' => 'clientes.importacion',
    'uses' => 'ClientesController@importacion'
]);

Route::post('clientes/importacion', [
    'as' => 'clientes.importacion.subir',
    'uses' => 'ClientesController@importacionUpload'
]);

Route::get('descargar-excel-clientes', [
    'as' => 'clientes.download.excel',
    'uses' => 'ClientesController@downloadExcel'
]);