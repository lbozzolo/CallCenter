<?php

namespace SmartLine\Entities;

class Banco extends Entity
{
    protected $table = 'bancos';


    public function datosTarjeta()
    {
        return $this->hasMany(DatoTarjeta::class);
    }

    public function formasPago()
    {
        return $this->hasMany(FormaPago::class);
    }

}
