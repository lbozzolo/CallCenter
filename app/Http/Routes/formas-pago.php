<?php

Route::get('formas-pago', [
    'as' => 'formas.pago.index',
    'uses' => 'FormasPagoController@index'
]);

Route::post('formas-pago/store', [
    'as' => 'formas.pago.store',
    'uses' => 'FormasPagoController@store'
]);

