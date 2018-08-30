<?php

namespace SmartLine\Http\Controllers;

use Illuminate\Http\Request;

use SmartLine\Entities\EstadoReclamo;
use SmartLine\Entities\Producto;
use SmartLine\Entities\Reclamo;
use SmartLine\Entities\Cliente;
use SmartLine\Http\Repositories\ProductoRepo;
use SmartLine\Http\Repositories\ClienteRepo;
use Illuminate\Support\Facades\Validator;
use SmartLine\Http\Requests;
use SmartLine\Http\Controllers\Controller;

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

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('reclamos.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id = null, $reclamoFecha = null)
    {
        $reclamo = Reclamo::with('venta.cliente', 'venta.producto', 'venta.reclamos')->where('id', $id)->first();
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
        $this->validate($request, ['descripcion' => 'max:1000', 'titulo' => 'max:255']);

        $reclamo = Reclamo::find($id);
        $reclamo->descripcion = $request->descripcion;
        $reclamo->titulo = $request->titulo;
        $reclamo->save();

        return redirect()->back()->with('ok', 'Descripción editada con éxito');
    }

    public function changeStatus($id)
    {
        $reclamo = Reclamo::find($id);
        $estado = ($reclamo->estado->slug == 'abierto')? EstadoReclamo::where('slug', 'cerrado')->first() : EstadoReclamo::where('slug', 'abierto')->first();
        $reclamo->estado()->associate($estado);
        $reclamo->save();

        return redirect()->back();
    }

    public function changeSolucionado($id)
    {
        $reclamo = Reclamo::find($id);
        $reclamo->solucionado = ($reclamo->solucionado == config('sistema.reclamos.SOLUCIONADO.solucionado'))? config('sistema.reclamos.SOLUCIONADO.sinsolucion') : config('sistema.reclamos.SOLUCIONADO.solucionado');
        $reclamo->save();

        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
