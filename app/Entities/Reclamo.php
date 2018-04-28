<?php

namespace SmartLine\Entities;


use SmartLine\User;

class Reclamo extends Entity
{
    protected $table = 'reclamos';
    protected $fillable = ['venta_id', 'descripcion', 'estado_id', 'solucionado', 'owner_id', 'derivador_id', 'responsable_id', 'created_at', 'updated_at'];

    // Relationships
    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    public function estado()
    {
        return $this->belongsTo(EstadoReclamo::class);
    }

    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function derivador()
    {
        return $this->belongsTo(User::class);
    }

    public function responsable()
    {
        return $this->belongsTo(User::class);
    }

}
