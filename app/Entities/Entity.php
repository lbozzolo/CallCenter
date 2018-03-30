<?php namespace CallCenter\Entities;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{
    public static function getClass()
    {
        return get_class(new static);
    }

    public function getCreatedAtAttribute()
    {
        return date_format($this->created_at,"d/m/Y");
    }

}