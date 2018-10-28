<?php

Route::get('ventas/choose-tag', [
    'as' => 'ventas.choose.tag',
    'uses' => 'VentasController@chooseTag',
    'middleware' => 'permission:listado.venta'
]);

Route::get('ventas/{estado?}', [
    'as' => 'ventas.index',
    'uses' => 'VentasController@index',
    'middleware' => 'permission:listado.venta'
]);

//Creación de venta
Route::get('ventas/llamar/seleccionar-cliente', [
    'as' => 'ventas.seleccion.cliente',
    'uses' => 'VentasController@seleccionCliente',
    'middleware' => 'permission:crear.venta'
]);

Route::get('ventas/llamar/seleccionar-producto/{idCliente}', [
    'as' => 'ventas.seleccion.producto',
    'uses' => 'VentasController@seleccionProducto',
    'middleware' => 'permission:crear.venta'
]);

Route::post('ventas/crear', [
    'as' => 'ventas.crear',
    'uses' => 'VentasController@create',
    'middleware' => 'permission:crear.venta'
]);

Route::get('ventas/panel/{idVenta}', [
   'as' => 'ventas.panel',
   'uses' => 'VentasController@panel',
    'middleware' => 'permission:crear.venta'
]);

Route::post('ventas/agregar-producto', [
    'as' => 'ventas.agregar.producto',
    'uses' => 'VentasController@agregarProducto',
    'middleware' => 'permission:crear.venta'
]);

Route::delete('ventas/quitar-producto', [
    'as' => 'ventas.quitar.producto',
    'uses' => 'VentasController@quitarProducto',
    'middleware' => 'permission:quitar.producto.venta'
]);

Route::put('ventas/{id}/editar-modos', [
    'as' => 'ventas.editar.modos',
    'uses' => 'VentasController@editarModos',
    'middleware' => 'permission:editar.venta'
]);

/*Route::post('ventas/crear', [
    'as' => 'ventas.store',
    'uses' => 'VentasController@store'
]);*/


Route::get('ventas/{id}/ver', [
    'as' => 'ventas.show',
    'uses' => 'VentasController@show',
    'middleware' => 'permission:ver.venta'
]);

Route::get('ventas/{id}/reclamos', [
    'as' => 'ventas.reclamos',
    'uses' => 'VentasController@reclamos',
    'middleware' => 'permission:ver.reclamos.venta'
]);

Route::get('ventas-cliente/{id}/ver', [
    'as' => 'ventas.show.cliente.ventas',
    'uses' => 'VentasController@showClienteVentas',
    'middleware' => 'permission:ver.venta'
]);

Route::get('ventas/{id}/editar', [
    'as' => 'ventas.edit',
    'uses' => 'VentasController@edit',
    'middleware' => 'permission:editar.venta'
]);

Route::put('ventas/{id}/actualizar', [
    'as' => 'ventas.update',
    'uses' => 'VentasController@update',
    'middleware' => 'permission:editar.venta'
]);

Route::put('ventas/{id}/cambiar-estado', [
    'as' => 'ventas.update.status',
    'uses' => 'VentasController@updateStatus',
    'middleware' => 'permission:editar.venta'
]);

Route::post('ventas/{id}/agregar-metodo-de-pago', [
    'as' => 'ventas.agregar.metodo.de.pago',
    'uses' => 'VentasController@agregarMetodoDePago',
    //'middleware' => 'permission:editar.venta'
]);

Route::put('ventas/{id}/ajustar', [
    'as' => 'ventas.ajustar',
    'uses' => 'VentasController@ajustar',
    //'middleware' => 'permission:editar.venta'
]);

Route::put('ventas/{id}/quitar-ajuste', [
    'as' => 'ventas.quitar.ajuste',
    'uses' => 'VentasController@quitarAjuste',
    //'middleware' => 'permission:editar.venta'
]);

Route::delete('ventas/{id}/quitar-metodo-pago', [
    'as' => 'ventas.quitar.metodopago',
    'uses' => 'VentasController@quitarMetodoPago',
    //'middleware' => 'permission:editar.venta'
]);

Route::post('ventas/{id}/numero-guia', [
    'as' => 'ventas.numero.guia',
    'uses' => 'VentasController@numeroGuia',
    'middleware' => 'permission:editar.venta'
]);

Route::put('ventas/cancelar-venta', [
    'as' => 'ventas.cancelar',
    'uses' => 'VentasController@cancelar',
    'middleware' => 'permission:cancelar.venta'
]);

Route::put('ventas/aceptar-venta', [
    'as' => 'ventas.aceptar',
    'uses' => 'VentasController@aceptar',
    'middleware' => 'permission:aceptar.venta'
]);

Route::put('ventas/retomar-venta', [
    'as' => 'ventas.retomar',
    'uses' => 'VentasController@retomar',
    'middleware' => 'permission:retomar.venta'
]);

Route::delete('ventas/{id}/eliminar', [
    'as' => 'ventas.destroy',
    'uses' => 'VentasController@destroy',
    'middleware' => 'permission:eliminar.venta'
]);

Route::put('ventas/{id}/editar-metodo-pago-venta', [
    'as' => 'ventas.editar.metodo.pago.venta',
    'uses' => 'VentasController@editarMetodoPagoVenta',
    //'middleware' => 'permission:retomar.venta'
]);