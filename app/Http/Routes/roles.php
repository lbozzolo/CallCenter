<?php

Route::group(['middleware' => 'role:superadmin'], function () {

    Route::get('roles', [
        'as' => 'roles.index',
        'uses' => 'RolesController@index'
    ]);

    Route::post('roles/crear', [
        'as' => 'roles.create',
        'uses' => 'RolesController@create'
    ]);

    Route::get('roles/{id}/editar', [
        'as' => 'roles.edit',
        'uses' => 'RolesController@edit'
    ]);

    Route::put('roles/{id}/actualizar', [
        'as' => 'roles.update',
        'uses' => 'RolesController@update'
    ]);

    Route::delete('roles/{id}/eliminar', [
        'as' => 'roles.destroy',
        'uses' => 'RolesController@destroy'
    ]);

    Route::get('roles/{id}/permisos', [
        'as' => 'roles.permissions',
        'uses' => 'RolesController@permissions'
    ]);

    Route::put('roles/{id}/permisos', [
        'as' => 'roles.assign.permissions',
        'uses' => 'RolesController@assignPermissions'
    ]);

});

