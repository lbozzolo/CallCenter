<?php

Route::get('reclamos', [
    'as' => 'reclamos.index',
    'uses' => 'ReclamosController@index'
]);

Route::get('reclamos/crear', [
    'as' => 'reclamos.create',
    'uses' => 'ReclamosController@create'
]);

Route::post('reclamos/crear', [
    'as' => 'reclamos.store',
    'uses' => 'ReclamosController@store'
]);

Route::get('reclamos/{id}/{reclamoFecha?}', [
    'as' => 'reclamos.show',
    'uses' => 'ReclamosController@show'
]);

Route::get('reclamos/{id}/editar', [
    'as' => 'reclamos.edit',
    'uses' => 'ReclamosController@edit'
]);

Route::put('reclamos/{id}/actualizar', [
    'as' => 'reclamos.update',
    'uses' => 'ReclamosController@update'
]);

Route::delete('reclamos/{id}/eliminar', [
    'as' => 'reclamos.destroy',
    'uses' => 'ReclamosController@destroy'
]);
