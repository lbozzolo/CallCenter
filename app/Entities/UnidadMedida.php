<?php

namespace SmartLine\Entities;


class UnidadMedida extends Entity
{
    protected $table = 'unidades_medida';


    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

}
