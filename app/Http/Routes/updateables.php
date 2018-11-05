<?php

Route::group(['prefix' => 'registro-de-movimientos'], function () {

    Route::get('', [
        'as' => 'updateables.index',
        'uses' => 'UpdateablesController@index'
    ]);

    Route::get('entidad', [
        'as' => 'updateables.entidad',
        'uses' => 'UpdateablesController@entidad'
    ]);

    Route::get('entidad/{entity}/{id}/show', [
        'as' => 'updateables.entidad.show',
        'uses' => 'UpdateablesController@show'
    ]);

});


