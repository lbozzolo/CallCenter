<?php

namespace SmartLine\Http\Controllers;

use Illuminate\Http\Request;

use SmartLine\Entities\EstadoReclamo;
use SmartLine\Entities\Producto;
use SmartLine\Entities\Reclamo;
use SmartLine\Entities\Cliente;
use SmartLine\Entities\Venta;
use SmartLine\Http\Repositories\ProductoRepo;
use SmartLine\Http\Repositories\ClienteRepo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use SmartLine\Http\Requests\CreateReclamoRequest;

class ReclamosController extends Controller
{
    protected $productoRepo;
    protected $clienteRepo;

    public function __construct(ProductoRepo $productoRepo, ClienteRepo $clienteRepo)
    {
        $this->productoRepo = $productoRepo;
        $this->clienteRepo = $clienteRepo;
    }

    public function index()
    {
        $reclamos = Reclamo::with('estado', 'venta', 'venta.cliente')->get();
         return view('reclamos.index', compact('reclamos'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexProductos()
    {
        $productos = Producto::all();
        return view('reclamos.index-productos', compact('ventas', 'productos'));
    }

    public function indexClientes()
    {
        $clientes = Cliente::all();
        return view('reclamos.index-clientes', compact('clientes'));
    }

    public function indexVentas()
    {
        $ventas = Venta::with(['cliente' => function ($query) {
            $query->get(['nombre', 'apellido', 'id']);
        },
        'user' => function ($query) {
            $query->get(['id', 'nombre', 'apellido']);
        },
        'productos' => function ($query) {
            $query->get(['productos.id', 'nombre']);
        },
        'estado' => function ($query) {
            $query->get(['id', 'slug', 'nombre']);
        }])->get(['id', 'estado_id', 'cliente_id', 'user_id', 'created_at']);

        return view('reclamos.index-ventas', compact('ventas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $venta = Venta::find($id);
        return view('reclamos.crear', compact('venta'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateReclamoRequest $request, $id)
    {
        $venta = Venta::find($id);

        $reclamo = Reclamo::create([
            'venta_id' => $id,
            'titulo' => ($request->titulo)? $request->titulo : null,
            'descripcion' => ($request->descripcion)? $request->descripcion : null,
            'estado_id' => 1,
            'solucionado' => 0,
            'owner_id' => Auth::user()->id
        ]);

        if(!$reclamo)
            return redirect()->back()->withErrors('Ocurrió un error. No se pudo crear el reclamo.');

        $reclamo->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'create'
        ]);

        $venta->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'add',
            'related_model_id' => $reclamo->id,
            'related_model_type' => 'reclamo'
        ]);

        return redirect()->back()->with('ok', 'Reclamo creado con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = null, $reclamoFecha = null)
    {
        $reclamo = Reclamo::with('venta.cliente', 'venta.productos', 'venta.reclamos')->where('id', $id)->first();
        $reclamoFecha = ($reclamoFecha)? Reclamo::with('venta.cliente', 'venta.productos', 'venta.reclamos')->where('id', $reclamoFecha)->first() : null;

        return view('reclamos.show', compact('reclamo', 'reclamoFecha'));
    }

    public function showReclamosProductos($id = null, $reclamoFecha = null)
    {
        $producto = Producto::find($id);
        $reclamos = $this->productoRepo->getProductoWithReclamos($id);
        $reclamoFecha = ($reclamoFecha)? Reclamo::with('venta.cliente', 'venta.productos', 'venta.reclamos')->where('id', $reclamoFecha)->first() : null;
        $reclamoFecha->tipo = 'producto';

        return view('reclamos.show-producto-reclamos', compact('producto', 'reclamos', 'reclamoFecha'));
    }

    public function showReclamosClientes($id = null, $reclamoFecha = null)
    {
        $cliente = Cliente::find($id);
        $reclamos = $this->clienteRepo->getClienteWithReclamos($id);
        $reclamoFecha = ($reclamoFecha)? Reclamo::with('venta.cliente', 'venta.productos', 'venta.reclamos')->where('id', $reclamoFecha)->first() : null;
        $reclamoFecha->tipo = 'cliente';

        return view('reclamos.show-cliente-reclamos', compact('cliente', 'reclamos', 'reclamoFecha'));
    }

    public function reclamosProductos($id)
    {
        $producto = Producto::find($id);
        $reclamos = $this->productoRepo->getProductoWithReclamos($id);
        return view('reclamos.show-producto-reclamos', compact('producto', 'reclamos'));
    }

    public function reclamosClientes($id)
    {
        $cliente = Cliente::find($id);
        $reclamos = $this->clienteRepo->getClienteWithReclamos($id);
        return view('reclamos.show-cliente-reclamos', compact('cliente', 'reclamos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function descriptionUpdate(Request $request, $id)
    {
        $messages = [
            'descripcion.max' => 'No puede escribir más de 1000 caracteres en la descripción. Usted escribió '.strlen($request->descripcion),
            'title.max' => 'No puede escribir más de 255 caracteres en el título. Usted escribió '.strlen($request->titulo),
        ];

        $validator = Validator::make($request->all(), [
            'descripcion' => 'max:1000',
            'titulo' => 'max:255'
        ], $messages);

        if ($validator->fails())
            return redirect()->back()->withErrors($validator)->withInput();

        $reclamo = Reclamo::find($id);

        if($request['descripcion'] && $request['descripcion'] != $reclamo->descripcion){
            $reclamo->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'descripcion',
                'former_value' => $reclamo->descripcion,
                'updated_value' => $request->descripcion
            ]);
            $reclamo->descripcion = $request->descripcion;
        }

        if($request['titulo'] && $request['titulo'] != $reclamo->titulo){
            $reclamo->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'titulo',
                'former_value' => $reclamo->titulo,
                'updated_value' => $request->titulo
            ]);
            $reclamo->titulo = $request->titulo;
        }

        $reclamo->save();

        return redirect()->back()->with('ok', 'Descripción editada con éxito');
    }

    public function changeStatus($id)
    {
        $reclamo = Reclamo::find($id);
        $venta = $reclamo->venta;
        $estado = ($reclamo->estado->slug == 'abierto')? EstadoReclamo::where('slug', 'cerrado')->first() : EstadoReclamo::where('slug', 'abierto')->first();

        if(!$estado)
            return redirect()->back()->withErrors('Ocurrió un error. No se pudo cambiar el Estado del Reclamo.');

        $reclamo->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'update',
            'field' => 'estado_id',
            'former_value' => $reclamo->estado_id,
            'updated_value' => $estado->id
        ]);

        $venta->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'update',
            'related_model_id' => $reclamo->id,
            'related_model_type' => 'reclamo',
            'field' => 'estado_id',
            'former_value' => $reclamo->estado_id,
            'updated_value' => $estado->id
        ]);

        $reclamo->estado()->associate($estado);
        $reclamo->save();

        return redirect()->back();
    }

    public function changeSolucionado($id)
    {
        $reclamo = Reclamo::find($id);
        $venta = $reclamo->venta;
        $valorSolucionado = ($reclamo->solucionado == config('sistema.reclamos.SOLUCIONADO.solucionado'))? config('sistema.reclamos.SOLUCIONADO.sinsolucion') : config('sistema.reclamos.SOLUCIONADO.solucionado');

        if($valorSolucionado == null && $valorSolucionado != 0)
            return redirect()->back()->withErrors('Ocurrió un error. No se pudo cambiar el valor de la solución.');

        $reclamo->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'update',
            'field' => 'solucionado',
            'former_value' => $reclamo->solucionado,
            'updated_value' => $valorSolucionado
        ]);

        $venta->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'update',
            'related_model_id' => $reclamo->id,
            'related_model_type' => 'reclamo',
            'field' => 'solucionado',
            'former_value' => $reclamo->solucionado,
            'updated_value' => $valorSolucionado
        ]);

        $reclamo->solucionado = $valorSolucionado;
        $reclamo->save();

        return redirect()->back();
    }

    public function derivar(Request $request, $id)
    {
        $reclamo = Reclamo::find($id);
        $venta = $reclamo->venta;

        $updateableResponsable = [
            'user_id' => Auth::user()->id,
            'action' => 'update',
            'field' => 'responsable_id',
            'former_value' => $reclamo->responsable_id,
            'updated_value' => $request->user_id
        ];

        $updateableDerivador = [
            'user_id' => Auth::user()->id,
            'action' => 'update',
            'field' => 'derivador_id',
            'former_value' => $reclamo->derivador_id,
            'updated_value' => Auth::user()->id
        ];

        $venta->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'update',
            'related_model_id' => $reclamo->id,
            'related_model_type' => 'reclamo',
            'field' => 'responsable_id',
            'former_value' => $reclamo->responsable_id,
            'updated_value' => $request->responsable_id
        ]);

        $reclamo->responsable_id = $request->user_id;
        $reclamo->derivador_id = Auth::user()->id;
        $reclamo->save();

        $reclamo->updateable()->create($updateableResponsable);
        $reclamo->updateable()->create($updateableDerivador);

        return redirect()->back()->with('ok', 'Reclamo derivado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $reclamo = Reclamo::find($id);
        $venta = $reclamo->venta;

        $reclamo->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'delete'
        ]);

        $venta->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'delete',
            'related_model_id' => $reclamo->id,
            'related_model_type' => 'reclamo',
        ]);

        $reclamo->delete();

        return redirect()->back()->with('ok', 'Reclamo eliminado con éxito');
    }
}
