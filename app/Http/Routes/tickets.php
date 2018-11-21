<?php

Route::get('soporte', [
    'as' => 'tickets.index',
    'uses' => 'TicketsController@index',
    'middleware' => 'permission:listado.ticket'
]);

Route::get('soporte/crear', [
    'as' => 'tickets.create',
    'uses' => 'TicketsController@create',
    'middleware' => 'permission:crear.ticket'
]);

Route::post('soporte/crear', [
    'as' => 'tickets.store',
    'uses' => 'TicketsController@store',
    'middleware' => 'permission:crear.ticket'
]);

Route::get('soporte/mis-tickets', [
    'as' => 'tickets.mis.tickets',
    'uses' => 'TicketsController@misTickets',
    'middleware' => 'permission:crear.ticket'
]);

Route::get('soporte/{id}/ver', [
    'as' => 'tickets.show',
    'uses' => 'TicketsController@show',
    'middleware' => 'permission:ver.ticket'
]);

Route::post('soporte/{id}/comment', [
    'as' => 'tickets.comment',
    'uses' => 'TicketsController@comment',
    'middleware' => 'permission:crear.ticket'
]);

Route::post('soporte/{id}/cambiar-criticidad', [
    'as' => 'tickets.cambiar.criticidad',
    'uses' => 'TicketsController@cambiarCriticidad',
    'middleware' => 'permission:editar.ticket'
]);

Route::get('soporte/{id}/cerrar', [
    'as' => 'tickets.change.state',
    'uses' => 'TicketsController@changeState',
    'middleware' => 'permission:change.state.ticket'
]);

