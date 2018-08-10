<?php

Route::get('etapas/{etapaId}/{productoId}/editar', [
    'as' => 'etapas.edit',
    'uses' => 'EtapasController@edit',
    'middleware' => 'permission:editar.etapa'
]);

Route::put('etapas/{id}/actualizar', [
    'as' => 'etapas.update',
    'uses' => 'EtapasController@update',
    'middleware' => 'permission:editar.etapa'
]);

Route::delete('etapas/{id}/eliminar', [
    'as' => 'etapas.destroy',
    'uses' => 'EtapasController@destroy',
    'middleware' => 'permission:eliminar.etapa'
]);