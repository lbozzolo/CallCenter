<?php

namespace SmartLine\Http\Controllers;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Http\Request;
use SmartLine\Entities\EstadoCliente;
use SmartLine\Entities\EstadoProducto;
use SmartLine\Entities\Cliente;
use SmartLine\Entities\Llamada;
use SmartLine\Entities\Producto;
use SmartLine\Entities\Provincia;
use SmartLine\Entities\Partido;
use SmartLine\Entities\Localidad;
use SmartLine\Entities\EstadoVenta;
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
        $estados = EstadoCliente::lists('nombre', 'id');
        return view('llamadas.seleccion-cliente', compact('clientes', 'estados'));
    }

    public function seleccionProducto($idCliente)
    {
        $cliente = Cliente::find($idCliente);
        $productos = Producto::where('estado_id', EstadoProducto::where('slug', 'activo')->first()->id)->get();

        $estados = EstadoCliente::lists('nombre', 'id');
        $provincias = Provincia::lists('provincia', 'id');
        $partidos = Partido::lists('partido', 'id', 'codProvincia');
        $localidades = Localidad::lists('localidad', 'id', 'codProvincia');

        if($cliente->domicilio){
            if($cliente->domicilio->provincia){
                $provinciaCliente = Provincia::find($cliente->domicilio->provincia->id);
                $partidos = Partido::where('codProvincia', $provinciaCliente->codProvincia)->lists('partido', 'id', 'codProvincia');
            }
            if($cliente->domicilio->partido){
                $partidoCliente = Partido::find($cliente->domicilio->partido->id);
                $localidades = Localidad::where('idPartido', $partidoCliente->idPartido)->lists('localidad', 'id', 'codProvincia');
            }

        }

        return view('llamadas.seleccion-producto', compact('productos', 'cliente', 'estados', 'provincias', 'partidos', 'localidades'));
    }

    public function agregarProducto()
    {
        dd('agregar producto');
    }

    public function panel($idCliente, $idProducto)
    {
        $cliente = Cliente::find($idCliente);
        $producto = Producto::find($idProducto);
        $estados = EstadoCliente::lists('nombre', 'id');
        $provincias = Provincia::lists('provincia', 'id');
        $partidos = Partido::lists('partido', 'id', 'codProvincia');
        $localidades = Localidad::lists('localidad', 'id', 'codProvincia');

        if($cliente->domicilio){
            if($cliente->domicilio->provincia){
                $provinciaCliente = Provincia::find($cliente->domicilio->provincia->id);
                $partidos = Partido::where('codProvincia', $provinciaCliente->codProvincia)->lists('partido', 'id', 'codProvincia');
            }
            if($cliente->domicilio->partido){
                $partidoCliente = Partido::find($cliente->domicilio->partido->id);
                $localidades = Localidad::where('idPartido', $partidoCliente->idPartido)->lists('localidad', 'id', 'codProvincia');
            }

        }

        return view('llamadas.panel', compact('cliente', 'producto', 'estados', 'provincias', 'partidos', 'localidades'));
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
        //dd($llamada->reclamo);
        $tags = EstadoVenta::lists('nombre', 'slug');
        return view('llamadas.show', compact('llamada', 'tags'));
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
