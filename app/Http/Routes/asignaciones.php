<?php

Route::get('asignaciones/{datosModificar?}', [
    'as' => 'asignaciones.index',
    'uses' => 'AsignacionesController@index',
    'middleware' => 'permission:listado.asignacion'
]);


Route::post('asignaciones/seleccion-operador', [
    'as' => 'asignaciones.seleccion.operador',
    'uses' => 'AsignacionesController@seleccionOperador',
    'middleware' => 'permission:crear.asignacion'
]);

Route::post('asignaciones/store', [
    'as' => 'asignaciones.store',
    'uses' => 'AsignacionesController@store',
    'middleware' => 'permission:crear.asignacion'
]);

Route::delete('asignaciones/{id}/eliminar', [
    'as' => 'asignaciones.destroy',
    'uses' => 'AsignacionesController@destroy',
    'middleware' => 'permission:eliminar.asignacion'
]);

Route::get('mis-tareas', [
    'as' => 'asignaciones.mis.tareas',
    'uses' => 'AsignacionesController@misTareas',
    'middleware' => 'permission:ver.mis.asignaciones'
]);

Route::get('mis-tareas-anteriores', [
    'as' => 'asignaciones.mis.tareas.anteriores',
    'uses' => 'AsignacionesController@misTareasAnteriores',
    'middleware' => 'permission:ver.mis.asignaciones'
]);

