<?php

namespace SmartLine\Entities;

class VentaCerrada extends Entity
{
    protected $table = 'ventas_cerradas';
    protected $fillable = ['venta_id', 'user_fullname', 'cliente_fullname', 'dni', 'cuit', 'cuil', 'observaciones', 'importe', 'calle', 'numero', 'piso', 'departamento', 'codigo_postal', 'entre_calles', 'barrio', 'localidad', 'partido', 'provincia'];

    public function productos()
    {
        return $this->hasMany(VentaCerradaProducto::class, 'venta_cerrada_id');
    }

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }


}
