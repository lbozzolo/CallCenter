<?php

Route::get('instituciones', [
    'as' => 'instituciones.index',
    'uses' => 'InstitucionesController@index'
]);

Route::get('instituciones/crear', [
    'as' => 'instituciones.create',
    'uses' => 'InstitucionesController@create'
]);

Route::post('instituciones/crear', [
    'as' => 'instituciones.store',
    'uses' => 'InstitucionesController@store'
]);

Route::get('instituciones/{id}/ver', [
    'as' => 'instituciones.show',
    'uses' => 'InstitucionesController@show'
]);

Route::get('instituciones/{id}/editar', [
    'as' => 'instituciones.edit',
    'uses' => 'InstitucionesController@edit'
]);

Route::put('instituciones/{id}/actualizar', [
    'as' => 'instituciones.update',
    'uses' => 'InstitucionesController@update'
]);

Route::delete('instituciones/{id}/eliminar', [
    'as' => 'instituciones.destroy',
    'uses' => 'InstitucionesController@destroy'
]);