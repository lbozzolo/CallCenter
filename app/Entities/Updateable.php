<?php

namespace SmartLine\Entities;


use SmartLine\User;

class Updateable extends Entity
{
    protected $table = 'updateables';

    protected $fillable = ['updateable_id', 'updateable_type', 'user_id', 'action', 'field', 'former_value', 'updated_value', 'reason', 'created_at', 'updated_at'];

    //Relationships
    public function updateable()
    {
        return $this->morphTo();
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

}
