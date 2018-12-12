<?php

namespace SmartLine\Entities;

class VentaCerradaProducto extends Entity
{
    protected $table = 'ventas_cerradas_productos';
    protected $fillable = ['venta_cerrada_id', 'nombre', 'marca', 'institucion'];
    public $timestamps = false;

    public function ventaCerrada()
    {
        return $this->belongsTo(VentaCerrada::class, 'venta_cerrada_id');
    }


}