<?php

Route::get('ventas', [
    'as' => 'ventas.index',
    'uses' => 'VentasController@index'
]);

Route::get('ventas/crear', [
    'as' => 'ventas.create',
    'uses' => 'VentasController@create'
]);

Route::post('ventas/crear', [
    'as' => 'ventas.store',
    'uses' => 'VentasController@store'
]);

Route::get('ventas/{id}/ver', [
    'as' => 'ventas.show',
    'uses' => 'VentasController@show'
]);

Route::get('ventas/{id}/editar', [
    'as' => 'ventas.edit',
    'uses' => 'VentasController@edit'
]);

Route::put('ventas/{id}/actualizar', [
    'as' => 'ventas.update',
    'uses' => 'VentasController@update'
]);

Route::delete('ventas/{id}/eliminar', [
    'as' => 'ventas.destroy',
    'uses' => 'VentasController@destroy'
]);