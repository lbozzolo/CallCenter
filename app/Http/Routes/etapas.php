<?php

Route::get('etapas/{etapaId}/{productoId}/editar', [
    'as' => 'etapas.edit',
    'uses' => 'EtapasController@edit'
]);

Route::put('etapas/{id}/actualizar', [
    'as' => 'etapas.update',
    'uses' => 'EtapasController@update'
]);

Route::delete('etapas/{id}/eliminar', [
    'as' => 'etapas.destroy',
    'uses' => 'EtapasController@destroy'
]);