<?php namespace SmartLine\Http\Controllers;


use Carbon\Carbon;
use SmartLine\Entities\EstadoProducto;
use SmartLine\Entities\Etapa;
use SmartLine\Entities\Institucion;
use SmartLine\Entities\UnidadMedida;
use SmartLine\Http\Requests\CreateEtapaRequest;
use SmartLine\Http\Requests\CreateProductoRequest;
use SmartLine\Entities\Producto;
use SmartLine\Entities\Marca;
use SmartLine\Entities\Categoria;
use SmartLine\Http\Repositories\ProductoRepo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
            return redirect()->back()->withErrors('La Categoría es obligatoria');
        }

        if($request->fecha_inicio)
            $fechaInicio = Carbon::createFromFormat('d/m/Y', $request->fecha_inicio)->toDateTimeString();

        if($request->fecha_finalizacion)
            $fechaFinalizacion = Carbon::createFromFormat('d/m/Y', $request->fecha_finalizacion)->toDateTimeString();

        $producto = Producto::create([
            'nombre' => $request->nombre,
            'descripcion' => $request->descripcion,
            'fecha_inicio' => (isset($fechaInicio))? $fechaInicio : null,
            'fecha_finalizacion' => (isset($fechaFinalizacion))? $fechaFinalizacion : null,
            'unidad_medida_id' => ($request->unidad_medida_id)? $request->unidad_medida_id : null,
            'cantidad_medida' => $request->cantidad_medida,
            'stock' => $request->stock,
            'estado_id' => $request->estado_id,
            'alerta_stock' => $request->alerta_stock,
            'marca_id' => ($request->marca_id)? $request->marca_id : null,
            'precio' => $request->precio,
            'institucion_id' => $request->institucion_id,
            'prospecto' => ($request->prospecto)? $request->prospecto : null,
        ]);

        $producto->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'create'
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

        return view('productos.pos-create', compact('producto'))->with('ok', 'Producto creado con éxito');
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
        $producto = $this->productoRepo->updateProducto($id, $request);

        if(!$producto)
            return redirect()->back()->withErrors('Ocurrió un error. No se pudo actualizar el Producto');

        return redirect()->route('productos.index')->with('ok', 'Producto editado con éxito');
    }

    public function updateStock(Request $request, $id)
    {
        $producto = Producto::find($id);

        $producto->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'update',
            'field' => 'stock',
            'former_value' => $producto->stock,
            'updated_value' => $request->stock
        ]);

        $producto->stock = $request->stock;
        $producto->save();

        return redirect()->back()->with('ok', 'Stock modificado con éxito');
    }

    public function etapas($id)
    {
        $producto = Producto::find($id);
        return view('productos.etapas', compact('producto'));
    }

    public function etapasStore(CreateEtapaRequest $request, $id)
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

    public function adminImagenes($id)
    {
        $producto = Producto::find($id);
        return view('productos.imagenes', compact('producto'));
    }

    public function destroy($id)
    {
        $producto = Producto::find($id);

        if($producto->ventas->count())
            return redirect()->route('productos.index')->withErrors('No se puede eliminar el Producto porque hay Ventas relacionadas a él. Proceda a desactivarlo');


        $producto->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'destroy'
        ]);

        $producto->forceDelete();

        return redirect()->route('productos.index')->with('ok', 'Producto eliminado con éxito');
    }

    public function changeState($id)
    {
        $message = $this->productoRepo->changeState($id);
        return redirect()->route('productos.index')->with('ok', 'El producto ha sido '.$message.' con éxito');
    }

    public function buscar(Request $request)
    {
        $valor = $request->get('valor');

        if(empty($valor)){
            return response()->json([]);
        }

        //$productos = Producto::where('nombre','like', '%'.$valor.'%')
        $productos = Producto::with('marca', 'categorias')
            ->where('nombre','like', '%'.$valor.'%')
            //->orWhere('descripcion', 'like','%'.$valor.'%')
            ->get();

        return response()->json($productos);

    }

    public function prospecto(Request $request)
    {
        $producto = Producto::find($request->producto_id);
        $prospecto = $producto->prospecto;

        return response()->json($prospecto);
    }

}