<?php

Route::get('ventas/choose-tag', [
    'as' => 'ventas.choose.tag',
    'uses' => 'VentasController@chooseTag'
]);

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

Route::post('ventas/crear', [
    'as' => 'ventas.crear',
    'uses' => 'VentasController@create'
]);

Route::get('ventas/panel/{idVenta}', [
   'as' => 'ventas.panel',
   'uses' => 'VentasController@panel'
]);

Route::post('ventas/agregar-producto', [
    'as' => 'ventas.agregar.producto',
    'uses' => 'VentasController@agregarProducto'
]);

Route::delete('ventas/quitar-producto', [
    'as' => 'ventas.quitar.producto',
    'uses' => 'VentasController@quitarProducto'
]);

Route::put('ventas/editar-modos', [
    'as' => 'ventas.editar.modos',
    'uses' => 'VentasController@editarModos'
]);

/*Route::post('ventas/crear', [
    'as' => 'ventas.store',
    'uses' => 'VentasController@store'
]);*/


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

Route::put('ventas/cancelar-venta', [
    'as' => 'ventas.cancelar',
    'uses' => 'VentasController@cancelar'
]);

Route::put('ventas/aceptar-venta', [
    'as' => 'ventas.aceptar',
    'uses' => 'VentasController@aceptar'
]);

Route::put('ventas/retomar-venta', [
    'as' => 'ventas.retomar',
    'uses' => 'VentasController@retomar'
]);

Route::delete('ventas/{id}/eliminar', [
    'as' => 'ventas.destroy',
    'uses' => 'VentasController@destroy'
]);