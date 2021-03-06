<?php

namespace SmartLine\Entities;

class MarcaTarjeta extends Entity
{
    protected $table = 'marcas_tarjetas';
    protected $fillable = ['nombre'];

    public function datosTarjetas()
    {
        return $this->hasMany(Producto::class);
    }

    public function formasPago()
    {
        return $this->hasMany(FormaPago::class, 'marca_tarjeta_id');
    }

}
