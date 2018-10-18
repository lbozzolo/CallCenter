<?php

namespace SmartLine\Entities;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class Cliente extends Entity
{
    protected $table = 'clientes';
    protected $fillable = ['nombre', 'apellido', 'nombre_completo', 'domicilio_id', 'telefono', 'celular', 'email', 'dni', 'referencia', 'observaciones', 'from_date', 'to_date', 'puntos', 'estado_id', 'created_at', 'updated_at'];


    public function hasCard($tipo = null)
    {
        return DatoTarjeta::whereHas('marca', function($q) use ($tipo){
            $q->where('tipo', '=', $tipo);
        })->count();
    }

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
        return date("H:i", strtotime($this->from_date));
    }

    public function getHorarioHastaAttribute()
    {
        return date("H:i", strtotime($this->to_date));
    }

    public function getUltimaAccionAttribute()
    {
        $response = '';
        if($this->ventas->count() > 0){
            $venta = $this->ventas->sortByDesc('updated_at')->first();
            $response = date_format($venta->updated_at,"d/m/Y - H:i").' hs';
        }
        return $response;
    }

    public function getOperadorAsignadoAttribute()
    {
        $today = Carbon::now()->toDateString();

        $asignacion = Asignacion::where('cliente_id', $this->id)
            ->whereDate('created_at', 'like', $today)
            ->orderBy('id', 'desc')
            ->first();

        $operador = ($asignacion)? $asignacion->operador->fullname : '--';

        return $operador;
    }

    public function getAsignacionActualAttribute()
    {
        $today = Carbon::now()->toDateString();

        $asignacion = Asignacion::where('cliente_id', $this->id)
            ->whereDate('created_at', 'like', $today)
            ->orderBy('id', 'desc')
            ->first();

        return $asignacion;
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

    public function datosTarjeta()
    {
        return $this->hasMany(DatoTarjeta::class);
    }

    public function asignaciones()
    {
        return $this->hasMany(Asignacion::class);
    }

}
