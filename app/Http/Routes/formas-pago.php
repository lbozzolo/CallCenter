<?php

Route::get('formas-pago', [
    'as' => 'formas.pago.index',
    'uses' => 'FormasPagoController@index'
]);

Route::post('formas-pago/store', [
    'as' => 'formas.pago.store',
    'uses' => 'FormasPagoController@store'
]);

Route::get('formas-pago/{id}/editar', [
    'as' => 'formas.pago.edit',
    'uses' => 'FormasPagoController@edit'
]);

Route::put('formas-pago/{id}/actualizar', [
    'as' => 'formas.pago.update',
    'uses' => 'FormasPagoController@update'
]);

Route::delete('formas-pago/{id}/eliminar', [
    'as' => 'formas.pago.destroy',
    'uses' => 'FormasPagoController@destroy'
]);

