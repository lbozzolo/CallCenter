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

Route::get('clientes/{id}', [
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