<?php

namespace SmartLine\Http\Controllers;

use Illuminate\Http\Request;

use SmartLine\Entities\Reclamo;
use SmartLine\Http\Requests;
use SmartLine\Http\Controllers\Controller;

class ReclamosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reclamos = Reclamo::all();
        return view('reclamos.index', compact('reclamos'));
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

        if($reclamoFecha)
            $reclamoFecha = Reclamo::with('venta.cliente', 'venta.producto', 'venta.reclamos')->where('id', $reclamoFecha)->first();

        return view('reclamos.show', compact('reclamo', 'reclamoFecha'));
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
