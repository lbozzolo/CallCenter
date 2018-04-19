<?php

Route::get('categorias', [
    'as' => 'categorias.index',
    'uses' => 'CategoriasController@index'
]);

Route::get('subcategorias', [
    'as' => 'subcategorias.index',
    'uses' => 'CategoriasController@indexSubcategorias'
]);

Route::post('categorias/crear', [
    'as' => 'categorias.store',
    'uses' => 'CategoriasController@store'
]);

Route::get('categorias/{id}/editar', [
    'as' => 'categorias.edit',
    'uses' => 'CategoriasController@edit'
]);

Route::put('categorias/{id}/actualizar', [
    'as' => 'categorias.update',
    'uses' => 'CategoriasController@update'
]);

Route::delete('categorias/{id}/eliminar', [
    'as' => 'categorias.destroy',
    'uses' => 'CategoriasController@destroy'
]);

Route::get('categoria/subcategoria', [
    'as' => 'categoria.asesoramiento',
    'uses' => 'CategoriasController@categoriaSubcategoria'
]);