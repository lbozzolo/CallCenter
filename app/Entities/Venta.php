<?php

namespace SmartLine\Entities;

use SmartLine\User;
use Illuminate\Database\Eloquent\SoftDeletes;

class Venta extends Entity
{
    use SoftDeletes;

    protected $table = 'ventas';
    protected $fillable = ['user_id', 'cliente_id', 'producto_id', 'estado_id', 'metodo_pago_id', 'forma_pago_id', 'observaciones', 'etapa_id', 'promocion_id', 'created_at', 'updated_at'];
    protected $dates = ['deleted_at'];

    // Nuevas funciones

    public function total($numero_cuotas = 1)
    {
        return ($this->subtotalProducts($numero_cuotas) == 0) ? $this->subtotalProducts($numero_cuotas) : $this->subtotalProducts($numero_cuotas) + $this->gastosEnvio($numero_cuotas) - $this->ajuste;
    }

    public function totalPorCuotas($numero_cuotas = 1)
    {
        return number_format($this->total($numero_cuotas), 2, ',', '.');
    }

    public function subtotalProducts($cuotas)
    {
        $interes = $this->sumaSubtotalProductos() * config('sistema.ventas.intereses.'.$cuotas) / 100;
        return $this->sumaSubtotalProductos() + $interes;
    }

    public function subtotalProductos($cuotas)
    {
        return number_format($this->subtotalProducts($cuotas), 2, ',', '.');
    }

    protected function gastosEnvio($numero_cuotas)
    {
        $gastosEnvio = config('sistema.ventas.gastosEnvio');
        $interes = config('sistema.ventas.intereses.'.$numero_cuotas);
        $porcentaje = $interes * $gastosEnvio / 100;
        return $gastosEnvio + $porcentaje;
    }

    public function gastosEnvioMasInteres($numero_cuotas = 1)
    {
        return number_format($this->gastosEnvio($numero_cuotas), 2, ',', '.');
        //return $gastosEnvio + $porcentaje;
    }

    public function restante($numero_cuotas = 1)
    {
        $restante = $this->total($numero_cuotas) - $this->subtotal();
        return number_format($restante, 2, ',', '.');
    }

    public function sumaMetodosDePago()
    {
        return $this->metodoPagoVenta()->sum('importe');
    }

    public function getSumaMetodosDePagoAttribute()
    {
        $metodosDePagoVenta = $this->metodoPagoVenta()->sum('importe');
        return number_format($metodosDePagoVenta, 2, ',', '.');
    }

    public function diferenciaMetodosPagoSumaProductos($numero_cuotas = 1)
    {
        return $this->total($numero_cuotas) - $this->sumaMetodosDePago();
    }

    public function reclamosPorEstado($slug = null)
    {
        $estado = EstadoReclamo::where('slug', $slug)->first();

        return Venta::whereHas('reclamos', function ($query) use ($estado) {
            $query->where('estado_id', '=', $estado->id)->where('venta_id', '=', $this->id);
        })->get();
    }

    /**
     * @param string $status
     * @return bool
     */
    public function statusIs($status = '')
    {
        return $this->estado->slug == $status;
    }


    // Viejas funciones

    protected function subtotal()
    {
        $subtotal = 0;
        $metodosPagoVenta = $this->metodoPagoVenta()->get();
        foreach($metodosPagoVenta as $metodoPagoVenta){
            //$subtotal += $metodoPagoVenta->importeMasPromocionMasIVA();
            $subtotal += $metodoPagoVenta->importeMasPromocion();
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
        //return $this->sumaSubtotalProductos() + $this->sumaProductosIVA();
        return $this->sumaSubtotalProductos();
    }

    protected function diferencia()
    {
        return $this->sumaSubtotalProductos() - $this->subtotal() / 1.21;
    }

//    protected function diferenciaConAjuste()
//    {
//        return ($this->sumaTotalProductos() > $this->total())? $this->sumaTotalProductos() - $this->total() : $this->total() - $this->sumaTotalProductos();
//    }

//    public function total()
//    {
//        return $this->subtotal() - $this->ajuste;
//    }

    public function getIVAAttribute()
    {
        return number_format($this->iva(), 2, ',', '.');
    }

    public function getReclamosAbiertosAttribute()
    {
        $reclamoAbierto = EstadoReclamo::where('slug', 'abierto')->first();
        return $this->reclamos->where('estado_id', $reclamoAbierto->id)->count();
    }

    // Mutators

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

//    public function getDiferenciaConAjusteAttribute()
//    {
//        return $this->diferenciaConAjuste();
//    }


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
