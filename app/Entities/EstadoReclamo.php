<?php

namespace SmartLine\Entities;


class EstadoReclamo extends Entity
{
    protected $table = 'estados_reclamos';


    public function reclamos()
    {
        return $this->hasMany(Reclamo::class);
    }

}
