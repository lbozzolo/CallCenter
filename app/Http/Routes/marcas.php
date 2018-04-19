<?php

Route::get('marcas', [
    'as' => 'marcas.index',
    'uses' => 'MarcasController@index'
]);

Route::get('marcas/crear', [
    'as' => 'marcas.create',
    'uses' => 'MarcasController@create'
]);

Route::post('marcas/crear', [
    'as' => 'marcas.store',
    'uses' => 'MarcasController@store'
]);

Route::get('marcas/{id}', [
    'as' => 'marcas.show',
    'uses' => 'MarcasController@show'
]);

Route::get('marcas/{id}/editar', [
    'as' => 'marcas.edit',
    'uses' => 'MarcasController@edit'
]);

Route::put('marcas/{id}/actualizar', [
    'as' => 'marcas.update',
    'uses' => 'MarcasController@update'
]);

Route::delete('marcas/{id}/eliminar', [
    'as' => 'marcas.destroy',
    'uses' => 'MarcasController@destroy'
]);