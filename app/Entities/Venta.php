<?php

namespace SmartLine\Entities;

use SmartLine\User;

class Venta extends Entity
{
    protected $table = 'ventas';
    protected $fillable = ['user_id', 'cliente_id', 'producto_id', 'estado_id', 'metodo_pago_id', 'forma_pago_id', 'observaciones', 'etapa_id', 'promocion_id', 'created_at', 'updated_at'];


    protected function subtotal()
    {
        $subtotal = 0;
        $metodosPagoVenta = $this->metodoPagoVenta()->get();
        foreach($metodosPagoVenta as $metodoPagoVenta){
            $subtotal += $metodoPagoVenta->importeMasPromocionMasIVA();
        }

        return $subtotal;
    }

    protected function iva()
    {
        return  21 * $this->subtotal() / 100;
    }

    protected function sumaSubtotalProductos()
    {
        $productos = $this->productos;
        $total = $productos->sum(function ($producto) {
            return $producto->precio;
        });
        return $total;
    }

    protected function sumaProductosIVA()
    {
        return 21 * $this->sumaSubTotalProductos() / 100;
    }

    protected function sumaTotalProductos()
    {
        return $this->sumaSubtotalProductos() + $this->sumaProductosIVA();
    }

    protected function diferencia()
    {
        return $this->sumaSubtotalProductos() - $this->subtotal() / 1.21;
    }

    protected function diferenciaConAjuste()
    {
        return $this->sumaTotalProductos() - $this->total();
    }

    public function total()
    {
        return $this->subtotal() - $this->ajuste;
    }

    public function getIVAAttribute()
    {
        return number_format($this->iva(), 2, ',', '.');
    }

    public function getSumaProductosIVAAttribute()
    {
        return number_format($this->sumaProductosIVA(), 2, ',', '.');
    }

    public function getSubtotalAttribute()
    {
        return number_format($this->subtotal(), '2', ',', '.');
    }

    public function getImporteTotalAttribute()
    {
        return number_format($this->total(), 2, ',', '.');
    }

    public function getImporteParaAjustarAttribute()
    {
        return $this->total();
    }

    public function getSumaSubtotalProductosAttribute()
    {
        return number_format($this->sumaSubtotalProductos(), 2, ',', '.');
    }

    public function getSumaTotalProductosAttribute()
    {
        return number_format($this->sumaTotalProductos(), 2, ',', '.');
    }

    public function getDiferenciaAttribute()
    {
        return $this->diferencia();
    }

    public function getDiferenciaConAjusteAttribute()
    {
        return $this->diferenciaConAjuste();
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
        return $this->belongsToMany(Producto::class)->withPivot('observaciones');
    }

    public function llamada()
    {
        return $this->belongsTo(Llamada::class);
    }

    public function cliente()
    {
        return $this->belongsTo(Cliente::class);
    }

    public function metodoPagoVenta()
    {
        return $this->hasMany(MetodoPagoVenta::class);
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
