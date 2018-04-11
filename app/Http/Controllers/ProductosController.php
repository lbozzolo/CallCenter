<?php namespace CallCenter\Http\Controllers;


use CallCenter\Http\Requests\CreateProductoRequest;
use CallCenter\Entities\Producto;

class ProductosController extends Controller
{

    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    public function create(){
        //
    }

    public function store(CreateProductoRequest $request){
        //
    }

    public function show($id){
        //
    }

    public function edit($id){
        //
    }

    public function update(CreateProductoRequest $request){
        //
    }

    public function destroy($id){
        //
    }

}