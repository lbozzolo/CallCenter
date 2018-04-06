<?php


Route::get('roles', [
    'as' => 'roles.index',
    'uses' => 'RolesController@index'
]);

Route::post('roles/crear', [
    'as' => 'roles.create',
    'uses' => 'RolesController@create'
]);

Route::delete('roles/{id}/eliminar', [
    'as' => 'roles.destroy',
    'uses' => 'RolesController@destroy'
]);