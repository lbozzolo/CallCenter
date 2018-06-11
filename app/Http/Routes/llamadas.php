<?php

Route::get('llamadas/salientes', [
    'as' => 'llamadas.index',
    'uses' => 'LlamadasController@index'
]);

Route::get('llamadas/entrantes', [
    'as' => 'llamadas.index.entrantes',
    'uses' => 'LlamadasController@indexEntrantes'
]);

Route::get('llamadas/reclamos', [
    'as' => 'llamadas.index.reclamos',
    'uses' => 'LlamadasController@indexReclamos'
]);

Route::get('llamadas/{id}/show', [
    'as' => 'llamadas.show',
    'uses' => 'LlamadasController@show'
]);


//Realizar venta
Route::get('llamadas/llamar/seleccion-cliente', [
    'as' => 'llamadas.seleccion.cliente',
    'uses' => 'LlamadasController@seleccionCliente'
]);

Route::get('llamadas/llamar/seleccion-producto/{idCliente}', [
    'as' => 'llamadas.seleccion.producto',
    'uses' => 'LlamadasController@seleccionProducto'
]);

Route::get('llamadas/agregar-producto', [
    'as' => 'llamadas.agregar.producto',
    'uses' => 'LlamadasController@agregarProducto'
]);

Route::get('llamadas/llamar/panel/{idCliente}/{idProducto}', [
    'as' => 'llamadas.panel',
    'uses' => 'LlamadasController@panel'
]);



