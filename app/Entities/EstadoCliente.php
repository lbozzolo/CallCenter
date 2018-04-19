<?php

namespace SmartLine\Entities;


class EstadoCliente extends Entity
{
    protected $table = 'estados_clientes';


    public function clientes()
    {
        return $this->hasMany(Cliente::class);
    }

}
