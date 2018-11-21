<?php

namespace SmartLine\Entities;


class EstadoTicket extends Entity
{
    protected $table = 'estados_tickets';

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

}
