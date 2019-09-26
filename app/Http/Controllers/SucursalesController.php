<?php namespace SmartLine\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use SmartLine\Entities\Sucursal;
use SmartLine\Http\Repositories\SucursalRepo;

class SucursalesController extends Controller
{

    protected $sucursalRepo;

    public function __construct(SucursalRepo $sucursalRepo)
    {
        $this->sucursalRepo = $sucursalRepo;
    }

    public function index()
    {
        $data['sucursales'] = Sucursal::all();
        return view('sucursales.index')->with($data);
    }

    public function create()
    {
        return view('sucursales.create');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), ['nombre' => 'required']);

        if ($validator->fails())
            return redirect()->back()->withErrors('El nombre es obligatorio');

        $sucursal = Sucursal::create([
            'nombre' => $request->nombre,
            'direccion' => ($request->direccion)? $request->direccion : null,
            'telefono' => ($request->telefono)? $request->telefono : null,
            'estado' => 1
        ]);

        $sucursal->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'create'
        ]);

        if(!$sucursal)
            return redirect()->back()->withErrors('Ocurrió un error. No se pudo crear la sucursal');

        return redirect()->route('sucursales.index')->with('ok', 'Sucursal creada con éxito');
    }

    public function edit($id)
    {
        $data['sucursal'] = Sucursal::find($id);
        return view('sucursales.edit')->with($data);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), ['nombre' => 'required']);

        if ($validator->fails())
            return redirect()->back()->withErrors('El nombre es obligatorio');

        $this->sucursalRepo->updateUser($id, $request);

        return redirect()->route('sucursales.index')->with('ok', 'Sucursal actualizada con éxito');
    }

    public function destroy($id)
    {
        $sucursal = Sucursal::find($id);

        $sucursal->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'delete'
        ]);

        $sucursal->delete();

        return redirect()->route('sucursales.index')->with('ok', 'La Sucursal ha sido eliminada con éxito');
    }

}