<?php

namespace SmartLine\Entities;

class DatoTarjeta extends Entity
{
    protected $table = 'datos_tarjeta';
    protected $fillable = ['marca_id', 'tipo_tarjeta', 'banco_id', 'numero_tarjeta', 'fecha_expiracion', 'titular', 'codigo_seguridad', 'created_at', 'updated_at'];
    protected $touches = ['venta'];

    public function marca()
    {
        return $this->belongsTo(MarcaTarjeta::class);
    }

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

}
