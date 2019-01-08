<?php namespace SmartLine\Http\Repositories;

use SmartLine\Entities\Asignacion;
use Carbon\Carbon;
use Illuminate\Http\Request;
use SmartLine\Entities\Cliente;

class AsignacionRepo extends BaseRepo
{
    public function getModel()
    {
        return new Asignacion;
    }

    protected $today;

    public function __construct()
    {
        $this->today = Carbon::now()->toDateString();
    }

    public function asignacionesActuales()
    {
        return Asignacion::whereDate('created_at', 'like', $this->today)
            ->orderBy('id', 'desc')
            ->get();
    }

    public function reasignaciones()
    {
        return Asignacion::whereDate('created_at', 'like', $this->today)
            ->has('motivo')
            ->orderBy('id', 'desc')
            ->get();
    }

    public function arrayToCollection($clientes = [])
    {
        $datos = collect();
        foreach($clientes as $key => $value){
            $datos->push( Cliente::find($value) );
        }
        return $datos;
    }


}
