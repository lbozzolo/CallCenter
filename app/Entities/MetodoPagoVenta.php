<?php

namespace SmartLine\Entities;


class MetodoPagoVenta extends Entity
{
    protected $table = 'metodo_pago_venta';
    protected $fillable = ['venta_id', 'metodopago_id', 'datostarjeta_id', 'importe'];
    public $timestamps = false;

    protected function iva()
    {
        return  21 * $this->importeMasPromocion() / 100;
    }

    public function importeMasPromocion()
    {
        $total = $this->importe;

        if($this->interes())
            $total += $this->interes();

        if($this->descuento())
            $total -= $this->descuento();

        return $total;
    }

    protected function numeroCuotas()
    {
        return ($this->datosTarjeta && $this->datosTarjeta->formaPago)? $this->datosTarjeta->formaPago : null;
    }

    protected function interes()
    {
        $cuotas = $this->numeroCuotas();
        $resto = ($cuotas && $cuotas->interes)? $cuotas->interes * $this->importe / 100 : null;

        return $resto;
    }

    protected function descuento()
    {
        $cuotas = $this->numeroCuotas();
        $resto = ($cuotas && $cuotas->descuento)? $cuotas->descuento * $this->importe / 100 : null;

        return $resto;
    }

    //--------------------------------------------------------------------------------------------------------------------------
    // Mutators
    //--------------------------------------------------------------------------------------------------------------------------

    public function getImporteTotalAttribute()
    {
        $total = $this->importeMasPromocion();
        return number_format($total, 2, ',', '.');
    }

    public function getIVAAttribute()
    {
        return number_format($this->iva(), 2, ',', '.');
    }

    public function getValorCuotaAttribute()
    {
        $total = $this->importeMasPromocion();
        $cuotas = $this->numeroCuotas();
        $valorCuota = $total / $cuotas->cuota_cantidad;
        return number_format($valorCuota, '2', ',', '.');
    }

    public function getInteresVentaAttribute()
    {
        return ($this->interes())? number_format($this->interes(), 2, ',', '.') : null;
    }

    public function getDescuentoVentaAttribute()
    {
        return ($this->descuento())? number_format($this->descuento(), 2, ',', '.') : null;
    }


    //--------------------------------------------------------------------------------------------------------------------------
    // Relationships
    //--------------------------------------------------------------------------------------------------------------------------


    public function datosTarjeta()
    {
        return $this->belongsTo(DatoTarjeta::class, 'datostarjeta_id');
    }

    public function venta()
    {
        return $this->belongsTo(Venta::class);
    }

    public function metodoPago()
    {
        return $this->belongsTo(MetodoPago::class, 'metodopago_id');
    }


}
