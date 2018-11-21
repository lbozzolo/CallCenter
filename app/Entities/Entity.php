<?php namespace SmartLine\Entities;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{

    public static function getClass()
    {
        return get_class(new static);
    }

    public function getClassNameAttribute()
    {
        $start = ($this->getClass() == 'SmartLine\User')? 10 : 19;
        $class = substr($this->getClass(), $start);
        return config('sistema.updateables.entidades.'.$class);
    }

    public function getFechaCreadoAttribute()
    {
        return date_format($this->created_at,"d/m/Y");
    }

    public function getFechaEditadoAttribute()
    {
        return date_format($this->updated_at,"d/m/Y");
    }

    public function getHoraCreatedAttribute()
    {
        return date_format($this->updated_at,"H:i");
    }

    static function getModels()
    {
        return ['marca','banco', 'asignacion', 'categoria', 'cliente', 'datoTarjeta', 'ticket', 'etapa', 'formaPago', 'imagen', 'institucion', 'llamada', 'noticia', 'metodoPago', 'producto', 'promocion', 'reclamo', 'updateable', 'user', 'venta',];
    }

}