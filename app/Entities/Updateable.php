<?php

namespace SmartLine\Entities;


class Updateable extends Entity
{
    protected $table = 'updateables';

    protected $fillable = ['updateable_id', 'updateable_type', 'user_id', 'field', 'former_value', 'updated_value', 'reason', 'created_at', 'updated_at'];

    //Relationships
    public function updateable()
    {
        return $this->morphTo();
    }

}
