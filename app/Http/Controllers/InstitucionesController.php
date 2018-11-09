<?php

namespace SmartLine\Http\Controllers;

use Illuminate\Http\Request;

use SmartLine\Entities\EstadoInstitucion;
use SmartLine\Entities\Institucion;
use SmartLine\Http\Requests\CreateInstitucionRequest;
use SmartLine\Http\Requests;
use SmartLine\Http\Controllers\Controller;

class InstitucionesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $instituciones = Institucion::all();
        $estados = EstadoInstitucion::lists('id');
        return view('instituciones.index', compact('instituciones', 'estados'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateInstitucionRequest $request)
    {
        Institucion::create([
            'nombre' => $request->nombre,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'email' => $request->email,
            'url' => $request->url,
            'responsable' => $request->responsable,
            'descripcion' => $request->descripcion,
            'estado_id' => $request->estado_id
        ]);

        return redirect()->route('instituciones.index')->with('ok', 'Intitución creada con éxito');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $institucion = Institucion::find($id);
        return view('instituciones.show', compact('institucion'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $institucion = Institucion::find($id);
        $instituciones = Institucion::all();
        $estados = EstadoInstitucion::lists('id');
        return view('instituciones.edit', compact('institucion', 'estados', 'instituciones'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CreateInstitucionRequest $request, $id)
    {
        $institucion = Institucion::find($id);

        $institucion->nombre = $request->nombre;
        $institucion->direccion = $request->direccion;
        $institucion->telefono = $request->telefono;
        $institucion->email = $request->email;
        $institucion->url = $request->url;
        $institucion->responsable = $request->responsable;
        $institucion->descripcion = $request->descripcion;
        $institucion->estado_id = $request->estado_id;

        $institucion->save();

        return redirect()->route('instituciones.index')->with('ok', 'Institución editada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $institucion = Institucion::find($id);
        $institucion->delete();

        return redirect()->route('instituciones.index')->with('ok', 'Institución eliminada con éxito');
    }
}
