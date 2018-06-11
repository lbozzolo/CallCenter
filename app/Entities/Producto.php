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


    public function getReclamosAttribute()
    {
        return DB::table('productos')
            ->join('ventas', 'productos.id', '=', 'ventas.producto_id')
            ->join('reclamos', 'ventas.id', '=', 'reclamos.venta_id')
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
        return $this->belongsToMany(Venta::class);
    }

    public function etapas()
    {
        return $this->hasMany(Etapa::class);
    }

    public function images()
    {
        return $this->morphMany(Imagen::class, 'imageable');
    }
}
