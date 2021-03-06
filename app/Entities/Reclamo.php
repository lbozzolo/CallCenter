<?php

namespace SmartLine\Entities;


use SmartLine\User;

class Reclamo extends Entity
{
    protected $table = 'reclamos';
    protected $fillable = ['venta_id', 'titulo', 'descripcion', 'estado_id', 'solucionado', 'owner_id', 'derivador_id', 'responsable_id', 'created_at', 'updated_at'];

    // Scopes

    public function scopeOpen($query)
    {
        return $query->where('estado_id', 1);
    }

    public function scopeClose($query)
    {
        return $query->where('estado_id', 2);
    }

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

    public function llamadas()
    {
        return $this->hasMany(Llamada::class);
    }

    public function updateable()
    {
        return $this->morphMany(Updateable::class, 'updateable');
    }

}
