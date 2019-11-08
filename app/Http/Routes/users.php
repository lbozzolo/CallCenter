<?php

Route::get('usuarios', [
    'as' => 'users.index',
    'uses' => 'UsersController@index',
    'middleware' => 'permission:listado.usuario'
]);

Route::get('usuarios/crear', [
    'as' => 'users.create',
    'uses' => 'UsersController@create',
    'middleware' => 'permission:crear.usuario'
]);

Route::post('usuarios/crear', [
    'as' => 'users.store',
    'uses' => 'UsersController@store',
    'middleware' => 'permission:crear.usuario'
]);

Route::get('usuarios/deshabilitados', [
    'as' => 'users.index.disable',
    'uses' => 'UsersController@indexDisable',
    'middleware' => 'permission:eliminar.usuario'
]);

Route::get('usuarios/nuevos', [
    'as' => 'users.index.nuevos',
    'uses' => 'UsersController@indexNuevos',
    'middleware' => 'permission:listado.usuarios.nuevos'
]);

Route::get('usuarios/{id}/blanqueo-de-contraseña', [
    'as' => 'users.blanqueo.password',
    'uses' => 'UsersController@blanqueoPassword',
    'middleware' => 'permission:blanquear.password.usuario'
]);

Route::get('perfil/{id}', [
    'as' => 'users.profile',
    'uses' => 'UsersController@profile',
    'middleware' => 'permission:ver.usuario'
]);

Route::get('perfil/{id}/editar/{route?}', [
    'as' => 'users.edit',
    'uses' => 'UsersController@edit',
    'middleware' => 'permission:editar.usuario'
]);

Route::put('perfil/update/{id}/{route?}', [
    'as' => 'users.update',
    'uses' => 'UsersController@update',
    'middleware' => 'permission:editar.usuario'
]);

Route::get('perfil/{id}/password', [
    'as' => 'users.changePassword',
    'uses' => 'UsersController@changePassword'
]);

Route::put('perfil/password', [
    'as' => 'users.storeNewPassword',
    'uses' => 'UsersController@storeNewPassword'
]);

Route::get('usuarios/{id}/cambiar-estado', [
    'as' => 'users.change.state',
    'uses' => 'UsersController@changeState',
    'middleware' => 'permission:cambiar.estado.usuario'
]);

Route::get('usuarios/{id}/permisos', [
    'as' => 'users.permissions',
    'uses' => 'UsersController@permissions',
    'middleware' => 'permission:editar.permisos.usuario'
]);

Route::put('usuarios/{id}/permisos', [
    'as' => 'users.assign.permissions',
    'uses' => 'UsersController@assignPermissions',
    'middleware' => 'permission:editar.permisos.usuario'
]);