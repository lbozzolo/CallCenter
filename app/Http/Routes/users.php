<?php

Route::get('usuarios', [
    'as' => 'users.index',
    'uses' => 'UsersController@index'
]);

Route::get('usuarios/deshabilitados', [
    'as' => 'users.index.disable',
    'uses' => 'UsersController@indexDisable'
]);

Route::get('perfil/{id}', [
    'as' => 'users.profile',
    'uses' => 'UsersController@profile'
]);

Route::get('perfil/{id}/editar/{route?}', [
    'as' => 'users.edit',
    'uses' => 'UsersController@edit'
]);

Route::put('perfil/update/{id}/{route?}', [
    'as' => 'users.update',
    'uses' => 'UsersController@update'
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
    'uses' => 'UsersController@changeState'
]);

Route::get('usuarios/{id}/permisos', [
    'as' => 'users.permissions',
    'uses' => 'UsersController@permissions'
]);

Route::put('usuarios/{id}/permisos', [
    'as' => 'users.assign.permissions',
    'uses' => 'UsersController@assignPermissions'
]);