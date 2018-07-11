<?php

Route::get('categorias', [
    'as' => 'categorias.index',
    'uses' => 'CategoriasController@index',
    'middleware' => 'permission:listado.categoría'
]);

Route::get('subcategorias', [
    'as' => 'subcategorias.index',
    'uses' => 'CategoriasController@indexSubcategorias',
    'middleware' => 'permission:listado.categoría'
]);

Route::post('categorias/crear', [
    'as' => 'categorias.store',
    'uses' => 'CategoriasController@store',
    'middleware' => 'permission:crear.categoría'
]);

Route::get('categorias/{id}/editar', [
    'as' => 'categorias.edit',
    'uses' => 'CategoriasController@edit',
    'middleware' => 'permission:editar.categoría'
]);

Route::put('categorias/{id}/actualizar', [
    'as' => 'categorias.update',
    'uses' => 'CategoriasController@update',
    'middleware' => 'permission:editar.categoría'
]);

Route::delete('categorias/{id}/eliminar', [
    'as' => 'categorias.destroy',
    'uses' => 'CategoriasController@destroy',
    'middleware' => 'permission:eliminar.categoría'
]);

Route::get('categoria/subcategoria', [
    'as' => 'categoria.asesoramiento',
    'uses' => 'CategoriasController@categoriaSubcategoria',
    'middleware' => 'permission:crear.categoría'
]);