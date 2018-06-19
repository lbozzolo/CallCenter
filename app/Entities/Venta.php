<?php

namespace SmartLine\Entities;

use SmartLine\User;

class Venta extends Entity
{
    protected $table = 'ventas';
    protected $fillable = ['user_id', 'cliente_id', 'producto_id', 'estado_id', 'metodo_pago_id', 'forma_pago_id', 'observaciones', 'etapa_id', 'promocion_id', 'created_at', 'updated_at'];


    public function getEstadoPluralAttribute()
    {
        return config('sistema.ventas.estados.'.$this->estado->slug);
    }

    public function getImporteTotalAttribute($total = null)
    {
        if($this->interes())
            $total = $this->total() + $this->interes();

        if($this->descuento())
            $total = $this->total() - $this->descuento();

        //return $total;
        return number_format($total, 2, ',', '.');
    }

    protected function total($total = 0)
    {
        foreach($this->productos as $producto){
            $total = $total + $producto->precio;
        }
        return $total;
    }

    protected function cuotas()
    {
        //return ($this->datosTarjeta->formaPago)? $this->datosTarjeta->formaPago : null;
        return $this->datosTarjeta->formaPago;
    }

    protected function interes()
    {
        $cuotas = $this->cuotas();
        $resto = ($cuotas && $cuotas->interes)? $cuotas->interes * $this->total() / 100 : null;

        return $resto;
    }

    protected function descuento()
    {
        $cuotas = $this->cuotas();
        $resto = ($cuotas && $cuotas->descuento)? $cuotas->descuento * $this->total() / 100 : null;

        return $resto;
    }

    public function getInteresVentaAttribute()
    {
        return number_format($this->interes(), 2, ',', '.');
    }

    public function getDescuentoVentaAttribute()
    {
        return number_format($this->descuento(), 2, ',', '.');
    }

    public function getTotalVentaAttribute()
    {
        return number_format($this->total(), 2, ',', '.');
    }

    public function getFormerStatusAttribute()
    {
        return $this->updateable->where('field', 'estado_id')->last()->former_value;
    }

    // Relationships
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function estado()
    {
        return $this->belongsTo(EstadoVenta::class);
    }

    public function productos()
    {
        return $this->belongsToMany(Producto::class);
    }

    public function llamada()
    {
        return $this->belongsTo(Llamada::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function metodoPago()
    {
        return $this->belongsTo(MetodoPago::class);
    }

    public function formaPago()
    {
        return $this->belongsTo(FormaPago::class);
    }

    public function datosTarjeta()
    {
        return $this->hasOne(DatoTarjeta::class);
    }

    public function promocion()
    {
        return $this->belongsTo(Promocion::class);
    }

    public function etapa()
    {
        return $this->belongsTo(Etapa::class);
    }

    public function reclamos()
    {
        return $this->hasMany(Reclamo::class);
    }

    public function updateable()
    {
        return $this->morphMany('\SmartLine\Entities\Updateable', 'updateable');
    }
}
