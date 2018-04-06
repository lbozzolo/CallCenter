<?php

Route::get('usuarios', [
    'as' => 'users.index',
    'uses' => 'UsersController@index'
]);

Route::get('perfil/{id}', [
    'as' => 'users.profile',
    'uses' => 'UsersController@profile'
]);

Route::get('perfil/{id}/editar', [
    'as' => 'users.edit',
    'uses' => 'UsersController@edit'
]);

Route::put('perfil/update/{id}', [
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