<?php namespace SmartLine\Entities;

use Illuminate\Database\Eloquent\Model;

class Entity extends Model
{

    public static function getClass()
    {
        return get_class(new static);
    }

    public function getFechaCreadoAttribute()
    {
        return date_format($this->created_at,"d/m/Y");
    }

    public function getFechaEditadoAttribute()
    {
        return date_format($this->updated_at,"d/m/Y");
    }

    static function getModels()
    {
        return ['marca','banco', 'categoria', 'cliente', 'datoTarjeta', 'etapa', 'formaPago', 'imagen', 'institucion', 'llamada', 'metodoPago', 'producto', 'promocion', 'reclamo', 'user', 'venta',];
    }

}