<?php

namespace SmartLine\Entities;

class Marca extends Entity
{
    protected $table = 'marcas';
    protected $fillable = ['nombre', 'descripcion'];
    public $timestamps = false;

    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

}
