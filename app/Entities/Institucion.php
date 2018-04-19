<?php

namespace SmartLine\Entities;


class Institucion extends Entity
{
    protected $table = 'instituciones';
    protected $fillable = ['nombre', 'direccion', 'telefono', 'email', 'url', 'responsable', 'descripcion', 'estado_id', 'created_at', 'updated_at'];


    public function productos()
    {
        return $this->hasMany(Producto::class);
    }

    public function estado()
    {
        return $this->belongsTo(EstadoInstitucion::class);
    }

}
