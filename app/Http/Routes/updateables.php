<?php

Route::group(['prefix' => 'registro-de-movimientos'], function () {

    Route::get('', [
        'as' => 'updateables.index',
        'uses' => 'UpdateablesController@index',
        'middleware' => 'permission:listado.updateable'
    ]);

    Route::get('entidad', [
        'as' => 'updateables.entidad',
        'uses' => 'UpdateablesController@entidad',
        'middleware' => 'permission:listado.updateable'
    ]);

    Route::get('entidad/{entity}/{id}/show', [
        'as' => 'updateables.entidad.show',
        'uses' => 'UpdateablesController@show',
        'middleware' => 'permission:listado.updateable'
    ]);

});


