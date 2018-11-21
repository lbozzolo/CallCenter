<?php

namespace SmartLine\Entities;


use SmartLine\User;

class Ticket extends Entity
{
    protected $table = 'tickets';
    protected $fillable = ['user_id', 'level_id', 'estado_id', 'modulo', 'subject', 'body'];
    protected $modulos = ['ASIGNACIONES', 'AUDITORÍA', 'CATEGORÍAS', 'CLIENTES', 'FACTURACIÓN', 'LOGÍSTICA', 'MÉTODOS DE PAGO', 'MOVIMIENTOS', 'NOTICIAS', 'POSTVENTA', 'PRODUCTOS', 'RECLAMOS', 'USUARIOS', 'VENTAS', 'OTROS'];


    public function modulo($id)
    {
        return $this->modulos[$id];
    }

    public function isOpen()
    {
        $estado = EstadoTicket::find($this->estado_id);
        return ($estado->slug == 'abierto')? true : false;
    }

    // Relationships

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function comments()
    {
        return $this->hasMany(TicketComment::class);
    }

}
