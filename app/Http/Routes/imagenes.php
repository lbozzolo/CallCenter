<?php

Route::post('imagenes/store/{id}/{model}', [
    'as' => 'imagenes.store',
    'uses' => 'ImagenesController@storeImage',
    'middleware' => 'permission:crear.imagen'
]);

Route::get('imagenes/principal/{id}', [
    'as' => 'imagenes.principal',
    'uses' => 'ImagenesController@principalImage',
    'middleware' => 'permission:crear.imagen'
]);

Route::delete('imagenes/delete/{id}', [
    'as' => 'imagenes.delete',
    'uses' => 'ImagenesController@deleteImage',
    'middleware' => 'permission:eliminar.imagen'
]);

Route::get('ver-image/{file}', [
    'as' => 'imagenes.ver',
    'uses' => 'ImagenesController@verImage',
    'middleware' => 'permission:ver.imagen'
]);