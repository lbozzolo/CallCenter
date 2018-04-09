<?php

Route::get('permisos', [
    'as' => 'permissions.index',
    'uses' => 'PermissionsController@index'
]);

Route::post('permisos/crear', [
    'as' => 'permissions.create',
    'uses' => 'PermissionsController@create'
]);

Route::get('permisos/{id}/editar', [
    'as' => 'permissions.edit',
    'uses' => 'PermissionsController@edit'
]);

Route::put('permisos/{id}/actualizar', [
    'as' => 'permissions.update',
    'uses' => 'PermissionsController@update'
]);

Route::delete('permisos/{id}/eliminar', [
    'as' => 'permissions.destroy',
    'uses' => 'PermissionsController@destroy'
]);