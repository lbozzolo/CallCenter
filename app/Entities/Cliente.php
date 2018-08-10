<?php

namespace SmartLine\Entities;

class Cliente extends Entity
{
    protected $table = 'clientes';
    protected $fillable = ['nombre', 'apellido', 'domicilio_id', 'telefono', 'celular', 'email', 'dni', 'referencia', 'observaciones', 'from_date', 'to_date', 'puntos', 'estado_id', 'created_at', 'updated_at'];


    public function getFullNameAttribute()
    {
        return $this->nombre.' '.$this->apellido;
    }

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

    public function getHorarioDesdeAttribute()
    {
        return date("h:i", strtotime($this->from_date));
    }

    public function getHorarioHastaAttribute()
    {
        return date("h:i", strtotime($this->to_date));
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
