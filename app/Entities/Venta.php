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

    public function getImporteTotalAttribute()
    {
        $total = $this->importeMasPromocion() + $this->iva();
        return number_format($total, 2, ',', '.');
    }

    public function getIVAAttribute()
    {
        return number_format($this->iva(), 2, ',', '.');
    }

    public function getHasCuotasAttribute()
    {
        return $this->numeroCuotas();
    }

    public function getValorCuotaAttribute()
    {
        $total = $this->importeMasPromocion() + $this->iva();
        $cuotas = $this->numeroCuotas();
        $valorCuota = $total / $cuotas->cuota_cantidad;
        return number_format($valorCuota, '2', ',', '.');
    }

    protected function iva()
    {
        return  21 * $this->importeMasPromocion() / 100;
    }

    protected function importeMasPromocion()
    {
        $total = $this->total();

        if($this->interes())
            $total += $this->interes();

        if($this->descuento())
            $total -= $this->descuento();

        return $total;
    }

    protected function total($total = 0)
    {
        foreach($this->productos as $producto){
            $total += $producto->precio;
        }
        return $total;
    }

    protected function numeroCuotas()
    {
        return ($this->datosTarjeta && $this->datosTarjeta->formaPago)? $this->datosTarjeta->formaPago : null;
    }

    protected function interes()
    {
        $cuotas = $this->numeroCuotas();
        $resto = ($cuotas && $cuotas->interes)? $cuotas->interes * $this->total() / 100 : null;

        return $resto;
    }

    protected function descuento()
    {
        $cuotas = $this->numeroCuotas();
        $resto = ($cuotas && $cuotas->descuento)? $cuotas->descuento * $this->total() / 100 : null;

        return $resto;
    }

    public function getInteresVentaAttribute()
    {
        return ($this->interes())? number_format($this->interes(), 2, ',', '.') : null;
    }

    public function getDescuentoVentaAttribute()
    {
        return ($this->descuento())? number_format($this->descuento(), 2, ',', '.') : null;
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
        return $this->belongsToMany(MetodoPago::class, 'metodo_pago_venta', 'venta_id', 'metodopago_id');
    }

    public function formaPago()
    {
        return $this->belongsTo(FormaPago::class);
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
