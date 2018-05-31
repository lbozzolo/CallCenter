<?php

namespace SmartLine\Entities;

use Illuminate\Support\Facades\DB;

class Cliente extends Entity
{
    protected $table = 'clientes';
    protected $fillable = ['nombre', 'apellido', 'domicilio_id', 'telefono', 'celular', 'email', 'dni', 'referencia', 'observaciones', 'puntos', 'estado_id', 'created_at', 'updated_at'];


    public function getFullNameAttribute()
    {
        return $this->nombre.' '.$this->apellido;
    }

    /*public function getReclamosAttribute()
    {
        return DB::table('clientes')
            ->join('ventas', 'clientes.id', '=', 'ventas.cliente_id')
            ->join('reclamos', 'ventas.id', '=', 'reclamos.venta_id')
            ->where('clientes.id', '=', $this->id)
            ->select('clientes.nombre', 'clientes.id as clienteId', 'reclamos.*')
            ->get();
    }*/

    public function getReclamosAttribute()
    {
        return Reclamo::whereHas('venta', function($query){
            $query->where('cliente_id', '=', $this->id);
        })->get();
    }

    public function getAddressAttribute()
    {
        $calle = ($this->domicilio && $this->domicilio->calle)? $this->domicilio->calle.' ' : '';
        $numero = ($this->domicilio && $this->domicilio->numero)? $this->domicilio->numero.' ' : '';
        $piso = ($this->domicilio && $this->domicilio->piso)? $this->domicilio->piso.'° ' : '';
        $departamento = ($this->domicilio && $this->domicilio->departamento)? $this->domicilio->departamento : '';
        $domicilio = $calle.$numero.$piso.$departamento;
        return $domicilio;
    }

    //Relationships
    public function estado()
    {
        return $this->belongsTo(EstadoCliente::class);
    }

    public function ventas()
    {
        return $this->hasMany(Venta::class);
    }

    public function llamadas()
    {
        return $this->hasMany(Llamada::class);
    }

    public function domicilio()
    {
        return $this->hasOne(Domicilio::class);
    }

    public function datosEnvio()
    {
        return $this->hasOne(Domicilio::class);
    }

}
