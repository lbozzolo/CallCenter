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

    public function updateProducto($id, $request)
    {
        $producto = Producto::find($id);

        $fechaInicio = Carbon::createFromFormat('d/m/Y', $request->fecha_inicio)->toDateTimeString();
        $fechaFinalizacion = Carbon::createFromFormat('d/m/Y', $request->fecha_finalizacion)->toDateTimeString();

//        if($request['calle'] && $request['calle'] != $domicilio->calle){
//            $domicilio->updateable()->create([
//                'user_id' => Auth::user()->id,
//                'action' => 'update',
//                'field' => 'calle',
//                'former_value' => $domicilio->calle,
//                'updated_value' => $request['calle']
//            ]);
//            $domicilio->calle = $request['calle'];
//        }

        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->fecha_inicio = ($request->fecha_inicio)? $fechaInicio : null;
        $producto->fecha_finalizacion = ($request->fecha_finalizacion)? $fechaFinalizacion : null;
        $producto->estado_id = $request->estado_id;
        $producto->unidad_medida_id = $request->unidad_medida_id;
        $producto->cantidad_medida = $request->cantidad_medida;
        $producto->stock = $request->stock;
        $producto->alerta_stock = $request->alerta_stock;
        $producto->marca_id = ($request->marca_id)? $request->marca_id : null;
        $producto->precio = $request->precio;
        $producto->institucion_id = $request->institucion_id;
        $producto->prospecto = ($request->prospecto)? $request->prospecto : null;

        $producto->categorias()->sync($request->categorias_id);

        $producto->save();

        return $producto;
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
