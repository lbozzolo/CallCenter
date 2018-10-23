<?php namespace SmartLine\Http\Controllers;


use Maatwebsite\Excel\Facades\Excel;
use SmartLine\Entities\Categoria;
use SmartLine\Entities\Cliente;
use SmartLine\Entities\DatoTarjeta;
use SmartLine\Entities\EstadoCliente;
use SmartLine\Entities\Llamada;
use SmartLine\Entities\Reclamo;
use SmartLine\Entities\EstadoVenta;
use SmartLine\Entities\Partido;
use SmartLine\Entities\Provincia;
use SmartLine\Entities\Localidad;
use SmartLine\Http\Requests\CreateClienteRequest;
use Illuminate\Http\Request;
use Carbon\Carbon;
use SmartLine\Http\Repositories\ClienteRepo;
use Illuminate\Support\Facades\Response;
use SmartLine\Http\Requests\CreateDatosTarjetaRequest;

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
        $desde = ($request->from_date)? $request->from_date : Carbon::parse($request->from_date)->startOfDay()->format('H:i:s');
        $hasta = ($request->to_date)? $request->to_date : Carbon::parse($request->to_date)->startOfDay()->format('H:i:s');

        $cliente = Cliente::create([
            'nombre' => ($request->nombre)? $request->nombre : '',
            'apellido' => ($request->apellido)? $request->apellido : '',
            'telefono' => ($request->telefono)? $request->telefono : '',
            'celular' => ($request->celular)? $request->celular : '',
            'email' => ($request->email)? $request->email : '',
            'dni' => ($request->dni)? $request->dni : '',
            'referencia' => ($request->referencia)? $request->referencia : '',
            'observaciones' => ($request->observaciones)? $request->observaciones : '',
            'from_date' => $desde,
            'to_date' => $hasta,
            'puntos' => ($request->puntos)? $request->puntos : '',
            'estado_id' => ($request->estado_id)? $request->estado_id : '',
        ]);

        $this->clienteRepo->updateOrCreateDomicilio($cliente->id, $request->all());

        if($cliente){
            return redirect()->route('clientes.index')->with('ok', 'Cliente creado con éxito');
        }else{ abort(400);}

    }

    public function show($id)
    {
        $cliente = Cliente::with('domicilio.localidad', 'domicilio.provincia')->where('id', $id)->first();
        return view('clientes.show', compact('cliente'));
    }

    public function edit($id)
    {
        $cliente = Cliente::find($id);
        $cliente->editar = true;
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

        $desde = ($request->from_date)? $request->from_date : Carbon::parse($request->from_date)->startOfDay()->format('H:i:s');
        $hasta = ($request->to_date)? $request->to_date : Carbon::parse($request->to_date)->startOfDay()->format('H:i:s');

        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->telefono = $request->telefono;
        $cliente->celular = $request->celular;
        $cliente->email = $request->email;
        $cliente->dni = $request->dni;
        $cliente->referencia = $request->referencia;
        $cliente->observaciones = $request->observaciones;
        $cliente->from_date = $desde;
        $cliente->to_date = $hasta;
        $cliente->puntos = $request->puntos;
        $cliente->estado_id = $request->estado_id;

        $cliente->save();

        if($request->has('redirect-back'))
            return redirect()->back()->with('ok', 'Cliente editado con éxito');

        return redirect()->route('clientes.show', $cliente->id)->with('ok', 'Cliente editado con éxito');
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

    public function importacion()
    {
        return view('clientes.importacion');
    }

    public function importacionUpload(Request $request)
    {
        $file = $request->excel_file;
        $estado = EstadoCliente::where('slug', '=', 'nuevo')->first()->id;

        Excel::load($file, function($reader) use ($estado) {

            foreach ($reader->get() as $cliente) {
                if(!is_null($cliente->nombre) || !is_null($cliente->apellido) || !is_null($cliente->fullname) || !is_null($cliente->mail) || !is_null($cliente->telefono) || !is_null($cliente->dni)){

                    $checkedDNI = null;
                    if($cliente->dni) {
                        $checkedDNI = (!Cliente::where('dni', '=', $cliente->dni)->first()) ? $cliente->dni : null;
                    }

                    Cliente::create([
                        'nombre' => $cliente->nombre,
                        'apellido' => $cliente->apellido,
                        'nombre_completo' => $cliente->fullname,
                        'email' => $cliente->mail,
                        'telefono' => $cliente->telefono,
                        'dni' => $checkedDNI,
                        'estado_id' => $estado
                    ]);

                }
            }

        });

        return redirect()->route('clientes.index')->with('ok', 'Se han insertado los clientes con éxito');

    }

    public function downloadExcel()
    {
        $file = public_path('clientes.xls');
        $headers = array('Content-Type: application/vnd.ms-excel',);

        return Response::download($file, 'clientes_nuevos.xls', $headers);
    }

    public function agregarTarjeta(CreateDatosTarjetaRequest $request, $id)
    {
        $cliente = Cliente::find($id);

        $fechaExpiracion = ($request->fecha_expiracion)? Carbon::createFromFormat('d/m/Y', $request->fecha_expiracion)->toDateTimeString() : null;

        $datosTarjeta = $cliente->datosTarjeta()->create([
            'marca_id' => $request->marca_id,
            'banco_id' => $request->banco_id,
            'numero_tarjeta' => $request->numero_tarjeta,
            'codigo_seguridad' => $request->codigo_seguridad,
            'titular' => $request->titular,
            'fecha_expiracion' => $fechaExpiracion,
        ]);

        if(!$datosTarjeta)
            return redirect()->back()->withErrors('No se pudo asociar la tarjera');

        return redirect()->back()->with('ok', 'Nueva tarjeta asociada con éxito');

    }

    public function eliminarTarjeta(Request $request, $id)
    {
        $datoTarjeta = DatoTarjeta::find($id);
        $datoTarjeta->delete();

        return redirect()->back()->with('ok', 'Tarjeta eliminada con éxito');
    }


}