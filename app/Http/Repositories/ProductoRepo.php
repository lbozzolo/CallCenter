<?php namespace SmartLine\Http\Repositories;

use Illuminate\Database\Eloquent\SoftDeletes;
use SmartLine\Entities\Producto;
use SmartLine\Entities\EstadoProducto;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProductoRepo extends BaseRepo
{
    use SoftDeletes;

    public function getModel()
    {
        return new Producto;
    }

    public function getProductosActivos()
    {
        return Producto::where('estado_id', EstadoProducto::where('slug', 'activo')->first()->id)->get();
    }

    public function getProductosInactivos()
    {
        $inactivo = EstadoProducto::where('slug', 'inactivo')->first();
        $productosInactivos = Producto::where('estado_id', $inactivo->id)->get();
        $softDeletes = Producto::onlyTrashed()->get();
        $productos = $softDeletes->merge($productosInactivos);

        return $productos;
    }

    public function changeState($id)
    {
        $producto = Producto::withTrashed()->where('id', $id)->first();
        $activo = EstadoProducto::where('slug', 'activo')->first();
        $inactivo = EstadoProducto::where('slug', 'inactivo')->first();

        if($producto->trashed()){

            $message = 'activado';
            $producto->restore();
            $producto->estado_id = $activo->id;
            $producto->save();

        }else{

            $message = 'desactivado';
            $producto->estado_id = $inactivo->id;
            $producto->save();
            $producto->delete();

        }

        return $message;
    }

    public function getProductoWithReclamos($id)
    {

        $productos = DB::table('productos')
            ->join('producto_venta', 'productos.id', '=', 'producto_venta.producto_id')
            ->join('reclamos', 'producto_venta.venta_id', '=', 'reclamos.venta_id')
            ->where('productos.id', '=', $id)
            ->select('productos.nombre', 'productos.id as productoId', 'reclamos.*')
            ->get();

        foreach($productos as $producto){
            $producto->created_at = Carbon::parse($producto->created_at)->format('d/m/Y');
            $producto->updated_at = Carbon::parse($producto->updated_at)->format('d/m/Y');
        }

        return $productos;

    }


}
