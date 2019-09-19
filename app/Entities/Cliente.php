<?php

namespace SmartLine\Entities;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cliente extends Entity
{
    use SoftDeletes;

    protected $table = 'clientes';
    protected $fillable = ['nombre', 'apellido', 'nombre_completo', 'domicilio_id', 'telefono', 'celular', 'email', 'username', 'dni', 'cuit', 'cuil',  'referencia', 'observaciones', 'from_date', 'to_date', 'puntos', 'estado_id', 'notificado', 'created_at', 'updated_at'];
    protected $dates = ['deleted_at'];

    public function hasCard($tipo = null)
    {
        return DatoTarjeta::whereHas('marca', function($q) use ($tipo){
            $q->where('tipo', '=', $tipo);
        })->count();
    }

    public function hasVentas()
    {
        return (count($this->ventas) > 0);
    }

    public function getFullNameAttribute()
    {
        $fullname = (!$this->nombre || !$this->apellido && $this->nombre_completo)? $this->nombre_completo : $this->nombre.' '.$this->apellido;
        return $fullname;
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

        $domicilio = $calle.$numero.$piso.strtoupper($departamento);
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

    public function asignacionActual()
    {
        $today = Carbon::now()->toDateString();

        $asignacion = Asignacion::where('cliente_id', $this->id)
            ->whereDate('created_at', 'like', $today)
            ->orderBy('id', 'desc')
            ->first();

        return $asignacion;
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

    // Scopes

    public function scopeCursos($query, $id)
    {
        $cursos = collect();
        $cliente = $query->find($id);

        foreach($cliente->ventas as $venta) {
            foreach ($venta->productos as $producto) {
                foreach ($producto->categorias as $categoria) {
                    if ($categoria->slug == 'cursos')
                        $cursos->push($producto);
                }
            }
        }

        return $cursos;
    }

    public function scopeCursosActivos($query)
    {
        $cliente = $query->find($this->id);
        return $cliente->activaciones->where('estado', 1);
    }

    /**
     * @return bool
     */
    public function isDisabled()
    {
        return $this->estado->slug == 'deshabilitado';
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

    public function activaciones()
    {
        return $this->hasMany(Activacion::class);
    }

    public function updateable()
    {
        return $this->morphMany(Updateable::class, 'updateable');
    }

}
