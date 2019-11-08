<?php

namespace SmartLine\Entities;


use SmartLine\User;

class Updateable extends Entity
{
    protected $table = 'updateables';

    protected $fillable = ['updateable_id', 'updateable_type', 'related_model_id', 'related_model_type', 'user_id', 'action', 'field', 'former_value', 'updated_value', 'reason', 'created_at', 'updated_at'];


    public function actionSpanish($action)
    {
        switch ($action){
            case 'activate':
                return 'activación';
                break;
            case 'lock':
                return 'desactivación';
                break;
            case 'add':
                return 'agregado';
                break;
            case 'create':
                return 'creación';
                break;
            case 'update':
                return 'actualización';
                break;
            case 'notifyCoefix':
                return 'notifiación COEFIX';
                break;
            case 'notifyCourses':
                return 'notifiación nuevos cursos';
                break;
            default:
                return $action;
        }
    }


    //Relationships

    public function updateable()
    {
        return $this->morphTo();
    }

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function estadoVenta()
    {
        return $this->belongsTo(EstadoVenta::class, 'updated_value');
    }

    public function metodoPagoVenta()
    {
        return $this->belongsTo(MetodoPagoVenta::class, 'related_model_id');
    }

    public function producto()
    {
        return $this->belongsTo(Producto::class, 'related_model_id');
    }

    public function responsable()
    {
        return $this->belongsTo(User::class, 'related_model_id');
    }

    public function sucursal()
    {
        return $this->belongsTo(Sucursal::class, 'related_model_id');
    }

}
