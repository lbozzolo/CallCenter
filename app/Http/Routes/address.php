<?php


Route::get('address/partidos', [
    'as' => 'address.partidos',
    'uses' => 'AddressController@getPartidos'
]);

Route::get('address/localidades', [
    'as' => 'address.localidades',
    'uses' => 'AddressController@getLocalidades'
]);