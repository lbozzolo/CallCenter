<?php

namespace SmartLine\Entities;


class Provincia extends Entity
{
    protected $table = 'tbl_provincias';

    public function partidos()
    {
        return $this->hasMany(Partido::class);
    }

    public function domicilios()
    {
        return $this->hasMany(Domicilio::class);
    }

}
