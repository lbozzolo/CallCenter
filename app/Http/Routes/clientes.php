<?php

Route::get('clientes', [
    'as' => 'clientes.index',
    'uses' => 'ClientesController@index'
]);

Route::get('clientes/crear', [
    'as' => 'clientes.create',
    'uses' => 'ClientesController@create'
]);

Route::post('clientes/crear', [
    'as' => 'clientes.store',
    'uses' => 'ClientesController@store'
]);

Route::get('clientes/{id}/datos', [
    'as' => 'clientes.show',
    'uses' => 'ClientesController@show'
]);

Route::get('clientes/{id}/editar', [
    'as' => 'clientes.edit',
    'uses' => 'ClientesController@edit'
]);

Route::put('clientes/{id}/actualizar', [
    'as' => 'clientes.update',
    'uses' => 'ClientesController@update'
]);

//Rutas de relaciones
Route::get('clientes/{id}/compras', [
    'as' => 'clientes.compras',
    'uses' => 'ClientesController@compras'
]);

Route::get('clientes/{id}/compras/estado', [
    'as' => 'clientes.compras.filtrar',
    'uses' => 'ClientesController@comprasFiltrar'
]);

Route::get('clientes/{id}/llamadas', [
    'as' => 'clientes.llamadas',
    'uses' => 'ClientesController@llamadas'
]);

Route::get('clientes/{id}/reclamos', [
    'as' => 'clientes.reclamos',
    'uses' => 'ClientesController@reclamos'
]);

Route::get('clientes/{id}/reclamo/{idReclamo}', [
    'as' => 'clientes.show.reclamo',
    'uses' => 'ClientesController@showReclamo'
]);

Route::get('clientes/{id}/reclamo/{idReclamo}/llamada/{idLlamada}', [
    'as' => 'clientes.llamadas.show',
    'uses' => 'ClientesController@showLlamada'
]);

Route::get('clientes/{id}/intereses', [
    'as' => 'clientes.intereses',
    'uses' => 'ClientesController@intereses'
]);