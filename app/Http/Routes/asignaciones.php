<?php

Route::get('asignaciones', [
    'as' => 'asignaciones.index',
    'uses' => 'AsignacionesController@index',
    //'middleware' => 'permission:listado.asignaciones'
]);

Route::post('asignaciones/seleccion-operador', [
    'as' => 'asignaciones.seleccion.operador',
    'uses' => 'AsignacionesController@seleccionOperador',
    //'middleware' => 'permission:crear.asignaciones'
]);

Route::post('asignaciones/store', [
    'as' => 'asignaciones.store',
    'uses' => 'AsignacionesController@store',
    //'middleware' => 'permission:crear.asignaciones'
]);

Route::delete('asignaciones/{id}/eliminar', [
    'as' => 'asignaciones.destroy',
    'uses' => 'AsignacionesController@destroy',
    //'middleware' => 'permission:eliminar.asignaciones'
]);

