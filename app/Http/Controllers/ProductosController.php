<?php namespace SmartLine\Http\Controllers;


use SmartLine\Entities\EstadoProducto;
use SmartLine\Entities\Etapa;
use SmartLine\Entities\Institucion;
use SmartLine\Entities\Promocion;
use SmartLine\Entities\UnidadMedida;
use SmartLine\Http\Requests\CreateProductoRequest;
use SmartLine\Entities\Producto;
use SmartLine\Entities\Marca;
use SmartLine\Entities\Categoria;
use SmartLine\Http\Repositories\ProductoRepo;
use Illuminate\Http\Request;

class ProductosController extends Controller
{
    protected $productoRepo;

    public function __construct(ProductoRepo $productoRepo)
    {
        $this->productoRepo = $productoRepo;
    }

    public function index()
    {
        $productos = $this->productoRepo->getProductosActivos();
        return view('productos.index', compact('productos'));
    }

    public function indexInactivos()
    {
        $productos = $this->productoRepo->getProductosInactivos();
        return view('productos.index', compact( 'productos'));
    }

    public function create()
    {
        $data['categorias'] = Categoria::whereNull('parent_id')->get()->lists('nombre', 'id');
        $data['subcategorias'] = Categoria::has('parent')->get()->lists('nombre', 'id');
        $data['unidadesMedida'] = UnidadMedida::lists('nombre', 'id');
        $data['estados'] = EstadoProducto::lists('id');
        $data['instituciones'] = Institucion::lists('nombre', 'id');
        $data['marcas'] = Marca::lists('nombre', 'id');

        return view('productos.create')->with($data);
    }

    public function store(CreateProductoRequest $request)
    {
        if(count($request->categoria_id) == 1 && $request->categoria_id == ''){
            return redirect()->back()->withErrors('La categoría es obligatoria');
        }

        /*$fechaInicio = date('d/m/Y', strtotime($request->fecha_inicio));
        $fechaFinalizacion = date('d/m/Y', strtotime($request->fecha_finalizacion));*/

        $producto = Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => ($request->fecha_inicio)? $request->fecha_inicio : null,
            'fecha_finalizacion' => ($request->fecha_finalizacion)? $request->fecha_finalizacion : null,
            'unidad_medida_id' => ($request->unidad_medida_id)? $request->unidad_medida_id : null,
            'cantidad_medida' => $request->cantidad_medida,
            'stock' => $request->stock,
            'estado_id' => $request->estado_id,
            'alerta_stock' => $request->alerta_stock,
            'marca_id' => ($request->marca_id)? $request->marca_id : null,
            'precio' => $request->precio,
            'institucion_id' => $request->institucion_id,
        ]);

        if($request->categoria_id){
            foreach(array_filter($request->categoria_id) as $categoria){
                $producto->categorias()->attach($categoria);
            }
        }

        if($request->subcategoria_id){
            foreach(array_filter($request->subcategoria_id) as $categoria){
                $producto->categorias()->attach($categoria);
            }
        }

        return redirect()->route('productos.index')->with('ok', 'Producto creado con éxito');
    }

    public function show($id)
    {
        $producto = Producto::find($id);
        return view('productos.show', compact('producto'));
    }

    public function edit($id)
    {
        $data['producto'] = Producto::find($id);
        $data['categoriasActuales'] = $data['producto']->categorias()->get()->lists('id');
        $data['categorias'] = Categoria::whereNull('parent_id')->get()->lists('nombre', 'id');
        $data['subcategorias'] = Categoria::has('parent')->get()->lists('nombre', 'id');
        $data['unidadesMedida'] = UnidadMedida::lists('nombre', 'id');
        $data['estados'] = EstadoProducto::lists('id');
        $data['instituciones'] = Institucion::lists('nombre', 'id');
        $data['marcas'] = Marca::lists('nombre', 'id');

        return view('productos.edit')->with($data);
    }

    public function update(CreateProductoRequest $request, $id)
    {
        $producto = Producto::find($id);

        $producto->nombre = $request->nombre;
        $producto->descripcion = $request->descripcion;
        $producto->fecha_inicio = ($request->fecha_inicio)? $request->fecha_inicio : null;
        $producto->fecha_finalizacion = ($request->fecha_finalizacion)? $request->fecha_finalizacion : null;
        $producto->estado_id = $request->estado_id;
        $producto->unidad_medida_id = $request->unidad_medida_id;
        $producto->cantidad_medida = $request->cantidad_medida;
        $producto->stock = $request->stock;
        $producto->alerta_stock = $request->alerta_stock;
        $producto->marca_id = ($request->marca_id)? $request->marca_id : null;
        $producto->precio = $request->precio;
        $producto->institucion_id = $request->institucion_id;

        $producto->save();

        return redirect()->route('productos.index')->with('ok', 'Producto editado con éxito');
    }

    public function etapas($id)
    {
        $producto = Producto::find($id);
        return view('productos.etapas', compact('producto'));
    }

    public function etapasStore(Request $request, $id)
    {
        $producto = Producto::find($id);
        $ultimaEtapa = $producto->etapas->last();
        $etapa = Etapa::create([
            'nombre' => $request->nombre,
            'dias_pendiente' => ($request->dias_pendiente)? $request->dias_pendiente : null,
            'etapa_anterior_id' => ($ultimaEtapa)? $ultimaEtapa->id : null,
            'producto_id' => $id
        ]);

        if($ultimaEtapa) {
            $ultimaEtapa->etapa_proxima_id = $etapa->id;
            $ultimaEtapa->save();
        }

        return redirect()->back()->with('ok', 'Etapa creada con éxito');
    }

    public function destroy($id)
    {
        $producto = Producto::find($id);

        if($producto->ventas->count())
            return redirect()->route('productos.index')->withErrors('No se puede eliminar el producto porque hay ventas relacionadas a él. Proceda a desactivarlo');

        $producto->forceDelete();

        return redirect()->route('productos.index')->with('ok', 'Producto eliminado con éxito');
    }

    public function changeState($id)
    {
        $message = $this->productoRepo->changeState($id);
        return redirect()->route('productos.index')->with('ok', 'El producto ha sido '.$message.' con éxito');
    }

}