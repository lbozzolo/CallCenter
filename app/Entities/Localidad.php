<?php

namespace SmartLine\Entities;


class Localidad extends Entity
{
    protected $table = 'tbl_localidades';

    public function partido()
    {
        return $this->belongsTo(Partido::class);
    }

    public function domicilios()
    {
        return $this->hasMany(Domicilio::class);
    }

}
