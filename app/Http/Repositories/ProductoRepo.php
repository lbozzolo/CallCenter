<?php namespace SmartLine\Http\Repositories;

use Illuminate\Database\Eloquent\SoftDeletes;
use SmartLine\Entities\Producto;
use SmartLine\Entities\EstadoProducto;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

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

        $firstDateInicio = new Carbon($producto->fecha_inicio);
        $secondDateInicio = Carbon::createFromFormat('d/m/Y', $request->fecha_inicio);
        $firstDateInicio->setTime(12, 0, 0);
        $secondDateInicio->setTime(12, 0, 0);

        $firstDateFinalizacion = new Carbon($producto->fecha_inicio);
        $secondDateFinalizacion = Carbon::createFromFormat('d/m/Y', $request->fecha_inicio);
        $firstDateFinalizacion->setTime(12, 0, 0);
        $secondDateFinalizacion->setTime(12, 0, 0);

        if($request['nombre'] && $request['nombre'] != $producto->nombre){
            $producto->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'nombre',
                'former_value' => $producto->nombre,
                'updated_value' => $request['nombre']
            ]);
            $producto->nombre = $request['nombre'];
        }

        if($request['descripcion'] && $request['descripcion'] != $producto->descripcion){
            $producto->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'descripcion',
                'former_value' => $producto->descripcion,
                'updated_value' => $request['descripcion']
            ]);
            $producto->descripcion = $request['descripcion'];
        }

        if($request['fecha_inicio'] && $firstDateInicio != $secondDateInicio){
            $producto->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'fecha_inicio',
                'former_value' => $producto->fecha_inicio,
                'updated_value' => $fechaInicio
            ]);
            $producto->fecha_inicio = $fechaInicio;
        }

        if($request['fecha_finalizacion'] && $firstDateFinalizacion != $secondDateFinalizacion){
            $producto->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'fecha_finalizacion',
                'former_value' => $producto->fecha_finalizacion,
                'updated_value' => $fechaFinalizacion
            ]);
            $producto->fecha_finalizacion = $fechaFinalizacion;
        }

        if($request['estado_id'] && $request['estado_id'] != $producto->estado_id){
            $producto->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'estado_id',
                'former_value' => $producto->estado_id,
                'updated_value' => $request['estado_id']
            ]);
            $producto->estado_id = $request['estado_id'];
        }

        if($request['unidad_medida_id'] && $request['unidad_medida_id'] != $producto->unidad_medida_id){
            $producto->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'unidad_medida_id',
                'former_value' => $producto->unidad_medida_id,
                'updated_value' => $request['unidad_medida_id']
            ]);
            $producto->unidad_medida_id = $request['unidad_medida_id'];
        }

        if($request['cantidad_medida'] && $request['cantidad_medida'] != $producto->cantidad_medida){
            $producto->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'cantidad_medida',
                'former_value' => $producto->cantidad_medida,
                'updated_value' => $request['cantidad_medida']
            ]);
            $producto->cantidad_medida = $request['cantidad_medida'];
        }

        if($request['stock'] && $request['stock'] != $producto->stock){
            $producto->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'stock',
                'former_value' => $producto->stock,
                'updated_value' => $request['stock']
            ]);
            $producto->stock = $request['stock'];
        }

        if($request['alerta_stock'] && $request['alerta_stock'] != $producto->alerta_stock){
            $producto->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'alerta_stock',
                'former_value' => $producto->alerta_stock,
                'updated_value' => $request['alerta_stock']
            ]);
            $producto->alerta_stock = $request['alerta_stock'];
        }

        if($request['marca_id'] && $request['marca_id'] != $producto->marca_id){
            $producto->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'marca_id',
                'former_value' => $producto->marca_id,
                'updated_value' => $request['marca_id']
            ]);
            $producto->marca_id = $request['marca_id'];
        }

        if($request['precio'] && $request['precio'] != $producto->precio){
            $producto->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'precio',
                'former_value' => $producto->precio,
                'updated_value' => $request['precio']
            ]);
            $producto->precio = $request['precio'];
        }

        //dd($request['institucion_id']);
        if($request['institucion_id'] && $request['institucion_id'] != $producto->institucion_id){
            $producto->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'institucion_id',
                'former_value' => $producto->institucion_id,
                'updated_value' => $request['institucion_id']
            ]);
            $producto->institucion_id = $request['institucion_id'];
        }

        if($request['prospecto'] && $request['prospecto'] != $producto->prospecto){
            $producto->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'prospecto',
                'former_value' => $producto->prospecto,
                'updated_value' => $request['prospecto']
            ]);
            $producto->prospecto = $request['prospecto'];
        }

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

            $producto->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'estado_id',
                'former_value' => $producto->estado_id,
                'updated_value' => $activo->id
            ]);

            $producto->estado_id = $activo->id;
            $producto->save();

        }else{

            $message = 'desactivado';

            $producto->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'estado_id',
                'former_value' => $producto->estado_id,
                'updated_value' => $inactivo->id
            ]);

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
