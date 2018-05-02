<?php

Route::get('llamadas/salientes', [
    'as' => 'llamadas.index',
    'uses' => 'LlamadasController@index'
]);

Route::get('llamadas/entrantes', [
    'as' => 'llamadas.index.entrantes',
    'uses' => 'LlamadasController@indexEntrantes'
]);

Route::get('llamadas/reclamos', [
    'as' => 'llamadas.index.reclamos',
    'uses' => 'LlamadasController@indexReclamos'
]);

Route::get('llamadas/{id}', [
    'as' => 'llamadas.show',
    'uses' => 'LlamadasController@show'
]);