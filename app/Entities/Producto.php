<?php

namespace SmartLine\Entities;


use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Entity
{

    use SoftDeletes;

    protected $table = 'productos';
    protected $fillable = ['nombre', 'descripcion', 'fecha_inicio', 'fecha_finalizacion', 'estado_id', 'unidad_medida_id', 'cantidad_medida', 'stock', 'alerta_stock', 'categoria_id', 'precio', 'marca_id', 'referencia', 'institucion_id', 'created_at', 'updated_at'];
    protected $dates = ['deleted_at'];


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
        return $this->hasMany(Venta::class);
    }

    public function images()
    {
        return $this->morphMany(Imagen::class, 'imageable');
    }
}
