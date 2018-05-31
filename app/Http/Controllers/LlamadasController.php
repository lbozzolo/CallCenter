<?php

namespace SmartLine\Http\Controllers;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use SmartLine\Entities\EstadoProducto;
use SmartLine\Entities\Cliente;
use SmartLine\Entities\Llamada;
use SmartLine\Entities\Producto;
use SmartLine\Http\Requests;
use SmartLine\Http\Controllers\Controller;

class LlamadasController extends Controller
{
    use SoftDeletes;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //$llamadas = Llamada::where('tipo_llamada', 1)->get();
        $llamadas = Llamada::whereNull('reclamo_id')->where('tipo_llamada', 1)->get();
        $llamadas->title = 'Salientes';

        return view('llamadas.index', compact('llamadas'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexEntrantes()
    {
        //$llamadas = Llamada::where('tipo_llamada', 0)->where('clase_llamada', 0)->get();
        $llamadas = Llamada::whereNull('reclamo_id')->where('tipo_llamada', 0)->get();
        $llamadas->title = 'Entrantes';
        return view('llamadas.index', compact('llamadas'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexReclamos()
    {
        //$llamadas = Llamada::where('clase_llamada', 1)->get();
        $llamadas = Llamada::whereNotNull('reclamo_id')->get();
        $llamadas->title = 'Reclamos';

        return view('llamadas.index', compact('llamadas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    public function seleccionCliente()
    {
        $clientes = Cliente::with('estado')->get();
        return view('llamadas.seleccion-cliente', compact('clientes'));
    }

    public function seleccionProducto($idCliente)
    {
        $cliente = Cliente::find($idCliente);
        $productos = Producto::where('estado_id', EstadoProducto::where('slug', 'activo')->first()->id)->get();
        return view('llamadas.seleccion-producto', compact('productos', 'cliente'));
    }

    public function panel($idCliente, $idProducto)
    {
        $cliente = Cliente::find($idCliente);
        $producto = Producto::find($idProducto);

        return view('llamadas.panel', compact('cliente', 'producto'));
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
    public function show($id)
    {
        $llamada = Llamada::find($id);
        return view('llamadas.show', compact('llamada'));
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
