<?php

Route::get('reclamos', [
    'as' => 'reclamos.index',
    'uses' => 'ReclamosController@index'
]);

Route::get('reclamos/productos', [
    'as' => 'reclamos.index.productos',
    'uses' => 'ReclamosController@indexProductos'
]);

Route::get('reclamos/clientes', [
    'as' => 'reclamos.index.clientes',
    'uses' => 'ReclamosController@indexClientes'
]);

Route::get('reclamos/crear', [
    'as' => 'reclamos.create',
    'uses' => 'ReclamosController@create'
]);

Route::post('reclamos/crear', [
    'as' => 'reclamos.store',
    'uses' => 'ReclamosController@store'
]);

Route::get('reclamos/{id}/{reclamoFecha?}', [
    'as' => 'reclamos.show',
    'uses' => 'ReclamosController@show'
]);

Route::get('reclamos/productos/ver/{id}/{reclamoFecha?}', [
    'as' => 'reclamos.show.productos',
    'uses' => 'ReclamosController@showReclamosProductos'
]);

Route::get('reclamos/clientes/ver/{id}/{reclamoFecha?}', [
    'as' => 'reclamos.show.clientes',
    'uses' => 'ReclamosController@showReclamosClientes'
]);

Route::get('reclamos-productos/{id}', [
    'as' => 'reclamos.productos',
    'uses' => 'ReclamosController@reclamosProductos'
]);

Route::get('reclamos-clientes/{id}', [
    'as' => 'reclamos.clientes',
    'uses' => 'ReclamosController@reclamosClientes'
]);

Route::get('reclamos/{id}/editar', [
    'as' => 'reclamos.edit',
    'uses' => 'ReclamosController@edit'
]);

Route::put('reclamos/{id}/actualizar', [
    'as' => 'reclamos.update',
    'uses' => 'ReclamosController@update'
]);

Route::delete('reclamos/{id}/eliminar', [
    'as' => 'reclamos.destroy',
    'uses' => 'ReclamosController@destroy'
]);

Route::put('reclamos/{id}/actualizar-descripcion', [
    'as' => 'reclamos.description.update',
    'uses' => 'ReclamosController@descriptionUpdate'
]);

Route::put('reclamos/{id}/change-status', [
    'as' => 'reclamos.change.status',
    'uses' => 'ReclamosController@changeStatus'
]);

Route::put('reclamos/{id}/change-solucionado', [
    'as' => 'reclamos.change.solucionado',
    'uses' => 'ReclamosController@changeSolucionado'
]);
