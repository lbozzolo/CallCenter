<?php

Route::group(['prefix' => 'ws', 'namespace' => 'Ws'], function() {

    Route::get('enviopack', [
        'as' => 'enviopack',
        'uses' => 'EnviopackController@enviopack'
    ]);

    Route::get('enviopack/cotizaciones', [
        'as' => 'enviopack.cotizaciones',
        'uses' => 'EnviopackController@cotizaciones'
    ]);

    Route::controller('cotizaciones', 'EnviopackController');
    Route::controller('correos', 'EnviopackController');

});