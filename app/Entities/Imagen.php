<?php

namespace SmartLine\Entities;


class Imagen extends Entity
{
    protected $table = 'imagenes';

    protected $fillable = ['path', 'title', 'imageable_id', 'imageable_type', 'principal'];

    //Relationships
    public function imageable()
    {
        return $this->morphTo();
    }

}
