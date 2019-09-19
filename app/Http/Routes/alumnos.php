<?php

Route::get('alumnos', [
    'as' => 'alumnos.index',
    'uses' => 'AlumnosController@index',
    'middleware' => 'permission:listado.cliente'
]);

Route::get('alumnos/{id}/cursos', [
    'as' => 'alumnos.cursos',
    'uses' => 'AlumnosController@cursos',
]);

Route::put('alumnos/{id}/update-username', [
    'as' => 'alumnos.update.username',
    'uses' => 'AlumnosController@updateUsername',
]);

Route::get('alumnos/{id}/habilitar-cursos', [
    'as' => 'alumnos.habilitar.deshabilitar.alumno',
    'uses' => 'AlumnosController@habilitarDeshabilitarAlumno',
]);

Route::get('alumnos/{id}/habilitacion-de-curso', [
    'as' => 'alumnos.habilitar.deshabilitar.curso',
    'uses' => 'AlumnosController@habilitarDeshabilitarCurso',
]);

Route::get('alumnos/{id}/notificar', [
    'as' => 'alumnos.notificar',
    'uses' => 'AlumnosController@notificar',
]);