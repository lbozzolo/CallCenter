<?php


// Authentication routes...
Route::get('auth/login', [
    'uses' => 'Auth\AuthController@getLogin',
    'as'   => 'login'
]);

Route::post('auth/login', [
    'uses' => 'Auth\AuthController@postLogin',
    'as'   => 'login'
]);

Route::get('auth/logout', [
    'uses' => 'Auth\AuthController@getLogout',
    'as'   => 'logout'
]);

// Registration routes...
Route::get('auth/register', [
    'uses' => 'Auth\AuthController@getRegister',
    'as'   => 'register'
]);

Route::post('auth/register', [
    'uses' => 'Auth\AuthController@postRegister',
    'as'   => 'register'
]);

// Password reset link request routes...
Route::get('password/email', [
    'uses' => 'Auth\PasswordController@getEmail',
    'as'   => 'password.email'
]);

Route::post('password/email', [
    'uses' => 'Auth\PasswordController@postEmail',
    'as'   => 'password.email'
]);

// Password reset routes...
Route::get('password/reset/{token}', [
    'uses' => 'Auth\PasswordController@getReset',
    'as'   => 'reset.link'
]);

Route::post('password/reset', [
    'uses' => 'Auth\PasswordController@postReset',
    'as'   => 'reset'
]);

Route::get('auth/bienvenido', [
    'uses' => 'Auth\AuthController@firstTime',
    'as' => 'auth.firsttime'
]);