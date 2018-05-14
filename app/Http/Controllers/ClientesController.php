<?php namespace SmartLine\Http\Controllers;


use SmartLine\Entities\Categoria;
use SmartLine\Entities\Cliente;
use SmartLine\Entities\Domicilio;
use SmartLine\Entities\EstadoCliente;
use SmartLine\Entities\Llamada;
use SmartLine\Entities\Reclamo;
use SmartLine\Entities\EstadoVenta;
use SmartLine\Entities\Partido;
use SmartLine\Entities\Provincia;
use SmartLine\Entities\Localidad;
use SmartLine\Http\Requests\CreateClienteRequest;
use Illuminate\Http\Request;
use SmartLine\Http\Repositories\ClienteRepo;

class ClientesController extends Controller
{

    protected $clienteRepo;

    public function __construct(ClienteRepo $clienteRepo)
    {
        $this->clienteRepo = $clienteRepo;
    }

    public function index()
    {
        $clientes = Cliente::with('estado')->get();
        return view('clientes.index', compact('clientes'));
    }

    public function create()
    {
        $estados = EstadoCliente::lists('nombre', 'id');
        $provincias = Provincia::lists('provincia', 'id');
        return view('clientes.create', compact('estados', 'provincias'));
    }

    public function store(CreateClienteRequest $request)
    {
        $cliente = Cliente::create([
            'nombre' => $request->nombre,
            'apellido' => $request->apellido,
            'telefono' => $request->telefono,
            'celular' => $request->celular,
            'email' => $request->email,
            'dni' => $request->dni,
            'referencia' => $request->referencia,
            'observaciones' => $request->observaciones,
            'puntos' => $request->puntos,
            'estado_id' => $request->estado_id
        ]);

        $this->clienteRepo->updateOrCreateDomicilio($cliente->id, $request->all());

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
        $provincias = Provincia::lists('provincia', 'id');

        if($cliente->domicilio){
            $provinciaCliente = Provincia::find($cliente->domicilio->provincia->id);
            $partidoCliente = Partido::find($cliente->domicilio->partido->id);

            $partidos = Partido::where('codProvincia', $provinciaCliente->codProvincia)->lists('partido', 'id', 'codProvincia');
            $localidades = Localidad::where('idPartido', $partidoCliente->idPartido)->lists('localidad', 'id', 'codProvincia');
        }

        //return view('clientes.show', compact('cliente', 'estados', 'provincias', 'partidos', 'localidades'));
        return view('clientes.edit', compact('cliente', 'estados', 'provincias', 'partidos', 'localidades'));
    }

    public function selectAddress(Request $request)
    {
        $data = $request->all();
        return response()->json($data);

    }

    public function update(Request $request, $id)
    {
        $cliente = Cliente::find($id);

        $this->clienteRepo->updateOrCreateDomicilio($id, $request->all());

        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
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

    public function reclamos($id)
    {
        $cliente = Cliente::find($id);
        $reclamos = $cliente->reclamos;

        return view('clientes.reclamos', compact('cliente', 'reclamos'));
    }

    public function showReclamo($id, $idReclamo)
    {
        $cliente = Cliente::find($id);
        $reclamo = Reclamo::find($idReclamo);
        $reclamos = $cliente->reclamos;

        return view('clientes.show-reclamo', compact('cliente', 'reclamo', 'reclamos'));
    }

    public function showLlamada($id, $idReclamo, $idLlamada)
    {
        $cliente = Cliente::find($id);
        $reclamo = Reclamo::find($idReclamo);
        $reclamos = $cliente->reclamos;
        $llamada = Llamada::find($idLlamada);

        return view('clientes.show-llamada', compact('cliente', 'reclamo', 'reclamos', 'llamada'));
    }

    public function intereses($id)
    {
        $cliente = Cliente::find($id);
        $intereses = $cliente->intereses;
        $categorias = Categoria::lists('nombre', 'id');

        return view('clientes.intereses', compact('cliente', 'intereses', 'categorias'));
    }


}