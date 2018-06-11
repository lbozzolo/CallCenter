<?php

Route::get('ventas/{estado?}', [
    'as' => 'ventas.index',
    'uses' => 'VentasController@index'
]);

//Creación de venta
Route::get('ventas/crear/seleccionar-cliente', [
    'as' => 'ventas.seleccion.cliente',
    'uses' => 'VentasController@seleccionCliente'
]);

Route::get('ventas/crear/seleccionar-producto/{idCliente}', [
    'as' => 'ventas.seleccion.producto',
    'uses' => 'VentasController@seleccionProducto'
]);

Route::get('ventas/crear/{idCliente}/{idProducto}', [
    'as' => 'ventas.crear',
    'uses' => 'VentasController@create'
]);

Route::post('ventas/crear', [
    'as' => 'ventas.store',
    'uses' => 'VentasController@store'
]);


Route::get('ventas/{id}/ver', [
    'as' => 'ventas.show',
    'uses' => 'VentasController@show'
]);

Route::get('ventas-cliente/{id}/ver', [
    'as' => 'ventas.show.cliente.ventas',
    'uses' => 'VentasController@showClienteVentas'
]);

Route::get('ventas/{id}/editar', [
    'as' => 'ventas.edit',
    'uses' => 'VentasController@edit'
]);

Route::put('ventas/{id}/actualizar', [
    'as' => 'ventas.update',
    'uses' => 'VentasController@update'
]);

Route::put('ventas/{id}/cambiar-estado', [
    'as' => 'ventas.update.status',
    'uses' => 'VentasController@updateStatus'
]);

Route::delete('ventas/{id}/eliminar', [
    'as' => 'ventas.destroy',
    'uses' => 'VentasController@destroy'
]);