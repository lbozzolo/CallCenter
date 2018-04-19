<?php

namespace SmartLine\Entities;


class EstadoInstitucion extends Entity
{
    protected $table = 'estados_instituciones';
    protected $fillable = ['nombre', 'direccion', 'telefono', 'email', 'url', 'responsable', 'descripcion', 'estado_id', 'created_at', 'updated_at'];


    public function instituciones()
    {
        return $this->hasMany(Institucion::class);
    }

}
