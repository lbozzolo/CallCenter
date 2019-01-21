<?php

namespace SmartLine\Entities;


use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Producto extends Entity
{

    use SoftDeletes;

    protected $table = 'productos';
    protected $fillable = ['nombre', 'descripcion', 'fecha_inicio', 'fecha_finalizacion', 'estado_id', 'unidad_medida_id', 'cantidad_medida', 'stock', 'alerta_stock', 'categoria_id', 'precio', 'marca_id', 'referencia', 'institucion_id', 'etapa_id', 'prospecto', 'created_at', 'updated_at'];
    protected $dates = ['deleted_at'];

    protected function priceInterestFee($cuotas = 1)
    {
        $interes = $this->precio * config('sistema.ventas.intereses.'.$cuotas) / 100;
        return $this->precio + $interes;
    }

    public function precioMasInteresCuota($numero_cuotas = 1, $cantidad_productos = 1)
    {
        $total = $this->priceInterestFee($numero_cuotas) * $cantidad_productos;
        return number_format($total, 2, ',', '.');
    }

    protected function priceByFee($cuotas = 1)
    {
        return $this->priceInterestFee($cuotas) / $cuotas;
    }

    public function precioPorCuota($cuotas = 1)
    {
        return number_format($this->priceByFee($cuotas), 2, ',', '.');
    }

    public function getReclamosAttribute()
    {
        return DB::table('productos')
            ->join('producto_venta', 'productos.id', '=', 'producto_venta.producto_id')
            ->join('reclamos', 'producto_venta.venta_id', '=', 'reclamos.venta_id')
            ->where('productos.id', '=', $this->id)
            ->select('productos.nombre', 'productos.id as productoId', 'reclamos.*')
            ->get();
    }

    public function getFechaInicioFormattedAttribute()
    {
        return Carbon::parse($this->fecha_inicio)->format('d/m/Y');
    }

    public function getFechaFinalizacionFormattedAttribute()
    {
        return Carbon::parse($this->fecha_finalizacion)->format('d/m/Y');
    }

    public function getNombrePrecioAttribute()
    {
        return $this->nombre.' ($'.$this->precio.')';
    }

    //Relationships

    public function estado()
    {
        return $this->belongsTo(EstadoProducto::class);
    }

    public function institucion()
    {
        return $this->belongsTo(Institucion::class);
    }

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class)->withPivot('categoria_id');
    }

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function unidadMedida()
    {
        return $this->belongsTo(UnidadMedida::class);
    }

    public function ventas()
    {
        return $this->belongsToMany(Venta::class)->withPivot('observaciones');
    }

    public function etapas()
    {
        return $this->hasMany(Etapa::class);
    }

    public function images()
    {
        return $this->morphMany(Imagen::class, 'imageable');
    }

    public function updateable()
    {
        return $this->morphMany(Updateable::class, 'updateable');
    }

}
