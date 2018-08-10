<?php

Route::get('instituciones', [
    'as' => 'instituciones.index',
    'uses' => 'InstitucionesController@index',
    'middleware' => 'permission:listado.institucion'
]);

Route::get('instituciones/crear', [
    'as' => 'instituciones.create',
    'uses' => 'InstitucionesController@create',
    'middleware' => 'permission:crear.institucion'
]);

Route::post('instituciones/crear', [
    'as' => 'instituciones.store',
    'uses' => 'InstitucionesController@store',
    'middleware' => 'permission:crear.institucion'
]);

Route::get('instituciones/{id}/ver', [
    'as' => 'instituciones.show',
    'uses' => 'InstitucionesController@show',
    'middleware' => 'permission:ver.institucion'
]);

Route::get('instituciones/{id}/editar', [
    'as' => 'instituciones.edit',
    'uses' => 'InstitucionesController@edit',
    'middleware' => 'permission:editar.institucion'
]);

Route::put('instituciones/{id}/actualizar', [
    'as' => 'instituciones.update',
    'uses' => 'InstitucionesController@update',
    'middleware' => 'permission:editar.institucion'
]);

Route::delete('instituciones/{id}/eliminar', [
    'as' => 'instituciones.destroy',
    'uses' => 'InstitucionesController@destroy',
    'middleware' => 'permission:eliminar.institucion'
]);