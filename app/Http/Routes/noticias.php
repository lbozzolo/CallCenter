<?php

Route::get('noticias', [
    'as' => 'noticias.index',
    'uses' => 'NoticiasController@index',
]);

Route::get('noticias/crear', [
    'as' => 'noticias.create',
    'uses' => 'NoticiasController@create',
]);

Route::post('noticias/crear', [
    'as' => 'noticias.store',
    'uses' => 'NoticiasController@store',
]);

Route::get('noticias/{id}/ver', [
    'as' => 'noticias.show',
    'uses' => 'NoticiasController@show',
]);

Route::get('noticias/{id}/editar', [
    'as' => 'noticias.edit',
    'uses' => 'NoticiasController@edit',
]);

Route::put('noticias/{id}/actualizar', [
    'as' => 'noticias.update',
    'uses' => 'NoticiasController@update',
]);

Route::delete('noticias/{id}/eliminar', [
    'as' => 'noticias.destroy',
    'uses' => 'NoticiasController@destroy',
]);


Route::get('noticias/todas', [
    'as' => 'noticias.noticias',
    'uses' => 'NoticiasController@noticias',
]);