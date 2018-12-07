<?php

Route::get('formas-pago', [
    'as' => 'formas.pago.index',
    'uses' => 'FormasPagoController@index',
    'middleware' => 'permission:listado.forma.de.pago'
]);

Route::post('formas-pago/store', [
    'as' => 'formas.pago.store',
    'uses' => 'FormasPagoController@store',
    'middleware' => 'permission:crear.forma.de.pago'
]);

Route::get('formas-pago/{id}/editar', [
    'as' => 'formas.pago.edit',
    'uses' => 'FormasPagoController@edit',
    'middleware' => 'permission:editar.forma.de.pago'
]);

Route::put('formas-pago/{id}/actualizar', [
    'as' => 'formas.pago.update',
    'uses' => 'FormasPagoController@update',
    'middleware' => 'permission:editar.forma.de.pago'
]);

Route::delete('formas-pago/{id}/eliminar', [
    'as' => 'formas.pago.destroy',
    'uses' => 'FormasPagoController@destroy',
    'middleware' => 'permission:eliminar.forma.de.pago'
]);

Route::get('formas-pago/tarjeta', [
    'as' => 'formas.choose.card',
    'uses' => 'FormasPagoController@chooseCard',
    //'middleware' => 'permission:editar.forma.de.pago'
]);
