<?php

namespace SmartLine\Entities;

class Categoria extends Entity
{
    protected $table = 'categorias';
    protected $fillable = ['nombre', 'slug', 'parent_id'];

    public function parent()
    {
        return $this->belongsTo(Categoria::class, 'parent_id');
    }

    public function subcategorias()
    {
        return $this->hasMany(Categoria::class, 'parent_id', 'id');
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class);
    }

}
