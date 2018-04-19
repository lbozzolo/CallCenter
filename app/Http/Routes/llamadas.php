<?php

Route::get('llamadas/salientes', [
    'as' => 'llamadas.index',
    'uses' => 'LlamadasController@index'
]);

Route::get('llamadas/entrantes', [
    'as' => 'llamadas.index.entrantes',
    'uses' => 'LlamadasController@indexEntrantes'
]);
