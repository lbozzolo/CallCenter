<?php

namespace SmartLine\Entities;

class Activacion extends Entity
{
    protected $table = 'activaciones';
    protected $fillable = ['cliente_id', 'producto_id', 'estado'];


    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

}
