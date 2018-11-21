<?php

namespace SmartLine\Entities;


use SmartLine\User;

class TicketComment extends Entity
{
    protected $table = 'tickets_comments';
    protected $fillable = ['user_id', 'ticket_id', 'body'];


    // Relationships

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

}
