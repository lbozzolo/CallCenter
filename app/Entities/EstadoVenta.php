<?php

namespace SmartLine\Entities;

class EstadoVenta extends Entity
{
    protected $table = 'estados_ventas';


    public function getEstadoPluralAttribute()
    {
        return config('sistema.ventas.estados.'.$this->slug);
    }

    public function isInArray($array = [])
    {
        foreach($array as $item){
            if($this->slug == $item)
                return true;
        }
        return false;
    }

    public function getName($id)
    {
        return $this->find($id)->nombre;
    }

    public function getSlug($id)
    {
        return $this->find($id)->slug;
    }

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }

    public function updateable()
    {
        return $this->morphMany(Updateable::class, 'updateable');
    }

}
