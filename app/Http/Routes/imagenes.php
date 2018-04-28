<?php

Route::post('imagenes/store/{id}/{model}', [
    'as' => 'imagenes.store',
    'uses' => 'ImagenesController@storeImage'
]);

Route::get('imagenes/principal/{id}', [
    'as' => 'imagenes.principal',
    'uses' => 'ImagenesController@principalImage'
]);

Route::delete('imagenes/delete/{id}', [
    'as' => 'imagenes.delete',
    'uses' => 'ImagenesController@deleteImage'
]);

Route::get('ver-image/{file}', [
    'as' => 'imagenes.ver',
    'uses' => 'ImagenesController@verImage'
]);