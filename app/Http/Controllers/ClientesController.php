<?php namespace SmartLine\Http\Controllers;


use SmartLine\Entities\Cliente;
use SmartLine\Entities\EstadoCliente;
use SmartLine\Entities\EstadoVenta;
use SmartLine\Http\Requests\CreateClienteRequest;
use Illuminate\Http\Request;

class ClientesController extends Controller
{

    public function index()
    {
        $clientes = Cliente::with('estado')->get();
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        $estados = EstadoCliente::lists('nombre', 'id');
        return view('clientes.create', compact('estados'));
    }

    public function store(CreateClienteRequest $request)
    {
        $cliente = Cliente::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'direccion' => $request->direccion,
            'telefono' => $request->telefono,
            'celular' => $request->celular,
            'email' => $request->email,
            'dni' => $request->dni,
            'referencia' => $request->referencia,
            'observaciones' => $request->observaciones,
            'puntos' => $request->puntos,
            'estado_id' => $request->estado_id
        ]);
        if($cliente){
            return redirect()->route('clientes.index')->with('ok', 'Cliente creado con éxito');
        }else{ abort(400);}

    }

    public function show($id)
    {
        $cliente = Cliente::find($id);
        return view('clientes.show', compact('cliente'));
    }

    public function edit($id)
    {
        $cliente = Cliente::find($id);
        $cliente->editar = true;
        $estados = EstadoCliente::lists('nombre', 'id');
        return view('clientes.show', compact('cliente', 'estados'));
    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);

        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->direccion = $request->direccion;
        $cliente->telefono = $request->telefono;
        $cliente->celular = $request->celular;
        $cliente->email = $request->email;
        $cliente->dni = $request->dni;
        $cliente->referencia = $request->referencia;
        $cliente->observaciones = $request->observaciones;
        $cliente->puntos = $request->puntos;
        $cliente->estado_id = $request->estado_id;

        $cliente->save();

        return redirect()->back()->with('ok', 'Cliente editado con éxito');
    }

    public function compras($id)
    {
        $cliente = Cliente::find($id);
        $estadosVentas = EstadoVenta::lists('nombre', 'id');

        return view('clientes.compras', compact('cliente', 'estadosVentas'));
    }

    public function comprasFiltrar(Request $request, $id)
    {
        $cliente = Cliente::find($id);
        $estadosVentas = EstadoVenta::lists('nombre', 'id');

        if($request->estado != 'todas'){
            $estado = EstadoVenta::find($request->estado);
            $compras = $cliente->ventas->where('estado_id', $estado->id);
            $compras->title = $estado->estado_plural;
        }else{
            $compras = $cliente->ventas;
            $compras->title = 'todas';
        }

        return view('clientes.compras', compact('cliente', 'compras', 'estadosVentas'));
    }

    public function llamadas($id)
    {
        $cliente = Cliente::find($id);
        $llamadas = $cliente->llamadas;

        return view('clientes.llamadas', compact('cliente', 'llamadas'));
    }


}