<?php

namespace SmartLine\Entities;


class Etapa extends Entity
{
    protected $table = 'etapas';
    protected $fillable = ['nombre', 'dias_pendiente', 'etapa_anterior_id', 'etapa_proxima_id', 'producto_id'];
    public $timestamps = false;

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }

}
