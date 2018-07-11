<?php

Route::get('llamadas/salientes', [
    'as' => 'llamadas.index',
    'uses' => 'LlamadasController@index',
    'middleware' => 'permission:listado.llamada'
]);

Route::get('llamadas/entrantes', [
    'as' => 'llamadas.index.entrantes',
    'uses' => 'LlamadasController@indexEntrantes',
    'middleware' => 'permission:listado.llamada'
]);

Route::get('llamadas/reclamos', [
    'as' => 'llamadas.index.reclamos',
    'uses' => 'LlamadasController@indexReclamos',
    'middleware' => 'permission:listado.llamada'
]);

Route::get('llamadas/{id}/show', [
    'as' => 'llamadas.show',
    'uses' => 'LlamadasController@show',
    'middleware' => 'permission:ver.llamada'
]);


//Realizar venta
Route::get('llamadas/llamar/seleccion-cliente', [
    'as' => 'llamadas.seleccion.cliente',
    'uses' => 'LlamadasController@seleccionCliente',
    'middleware' => 'permission:crear.llamada'
]);

Route::get('llamadas/llamar/seleccion-producto/{idCliente}', [
    'as' => 'llamadas.seleccion.producto',
    'uses' => 'LlamadasController@seleccionProducto',
    'middleware' => 'permission:crear.llamada'
]);

Route::get('llamadas/agregar-producto', [
    'as' => 'llamadas.agregar.producto',
    'uses' => 'LlamadasController@agregarProducto',
    'middleware' => 'permission:crear.llamada'
]);

Route::get('llamadas/llamar/panel/{idCliente}/{idProducto}', [
    'as' => 'llamadas.panel',
    'uses' => 'LlamadasController@panel',
    'middleware' => 'permission:crear.llamada'
]);



