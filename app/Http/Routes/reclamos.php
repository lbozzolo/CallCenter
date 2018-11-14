<?php

Route::get('reclamos', [
    'as' => 'reclamos.index',
    'uses' => 'ReclamosController@index',
    'middleware' => 'permission:listado.reclamo'
]);

Route::get('reclamos/productos', [
    'as' => 'reclamos.index.productos',
    'uses' => 'ReclamosController@indexProductos',
    'middleware' => 'permission:listado.reclamo'
]);

Route::get('reclamos/clientes', [
    'as' => 'reclamos.index.clientes',
    'uses' => 'ReclamosController@indexClientes',
    'middleware' => 'permission:listado.reclamo'
]);

Route::get('reclamos/ventas', [
    'as' => 'reclamos.index.ventas',
    'uses' => 'ReclamosController@indexVentas',
    'middleware' => 'permission:crear.reclamo'
]);

Route::get('reclamos/{id}/crear', [
    'as' => 'reclamos.create',
    'uses' => 'ReclamosController@create',
    'middleware' => 'permission:crear.reclamo'
]);

Route::post('reclamos/{id}/crear', [
    'as' => 'reclamos.store',
    'uses' => 'ReclamosController@store',
    'middleware' => 'permission:crear.reclamo'
]);

Route::get('reclamos/{id}/{reclamoFecha?}', [
    'as' => 'reclamos.show',
    'uses' => 'ReclamosController@show',
    'middleware' => 'permission:ver.reclamo'
]);

Route::get('reclamos/productos/ver/{id}/{reclamoFecha?}', [
    'as' => 'reclamos.show.productos',
    'uses' => 'ReclamosController@showReclamosProductos',
    'middleware' => 'permission:ver.reclamo'
]);

Route::get('reclamos/clientes/ver/{id}/{reclamoFecha?}', [
    'as' => 'reclamos.show.clientes',
    'uses' => 'ReclamosController@showReclamosClientes',
    'middleware' => 'permission:ver.reclamo'
]);

Route::get('reclamos-productos/{id}', [
    'as' => 'reclamos.productos',
    'uses' => 'ReclamosController@reclamosProductos',
    'middleware' => 'permission:ver.reclamo'
]);

Route::get('reclamos-clientes/{id}', [
    'as' => 'reclamos.clientes',
    'uses' => 'ReclamosController@reclamosClientes',
    'middleware' => 'permission:ver.reclamo'
]);

Route::get('reclamos/{id}/editar', [
    'as' => 'reclamos.edit',
    'uses' => 'ReclamosController@edit',
    'middleware' => 'permission:editar.reclamo'
]);

Route::put('reclamos/{id}/actualizar', [
    'as' => 'reclamos.update',
    'uses' => 'ReclamosController@update',
    'middleware' => 'permission:editar.reclamo'
]);

Route::delete('reclamos/{id}/eliminar', [
    'as' => 'reclamos.destroy',
    'uses' => 'ReclamosController@destroy',
    'middleware' => 'permission:eliminar.reclamo'
]);

Route::put('reclamos/{id}/actualizar-descripcion', [
    'as' => 'reclamos.description.update',
    'uses' => 'ReclamosController@descriptionUpdate',
    'middleware' => 'permission:editar.reclamo'
]);

Route::put('reclamos/{id}/change-status', [
    'as' => 'reclamos.change.status',
    'uses' => 'ReclamosController@changeStatus',
    'middleware' => 'permission:editar.reclamo'
]);

Route::put('reclamos/{id}/change-solucionado', [
    'as' => 'reclamos.change.solucionado',
    'uses' => 'ReclamosController@changeSolucionado',
    'middleware' => 'permission:editar.reclamo'
]);

Route::post('reclamos/{id}/derivar', [
    'as' => 'reclamos.derivar',
    'uses' => 'ReclamosController@derivar',
    'middleware' => 'permission:derivar.reclamo'
]);
