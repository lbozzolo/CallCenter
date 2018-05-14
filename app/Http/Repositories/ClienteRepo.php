<?php namespace SmartLine\Http\Repositories;

use Illuminate\Database\Eloquent\SoftDeletes;
use SmartLine\Entities\Cliente;
use SmartLine\Entities\Domicilio;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClienteRepo extends BaseRepo
{
    use SoftDeletes;

    public function getModel()
    {
        return new Cliente;
    }

    public function getClienteWithReclamos($id)
    {

        $clientes = DB::table('clientes')
            ->join('ventas', 'clientes.id', '=', 'ventas.cliente_id')
            ->join('reclamos', 'ventas.id', '=', 'reclamos.venta_id')
            ->where('clientes.id', '=', $id)
            ->select('clientes.nombre', 'clientes.id as clienteId', 'reclamos.*')
            ->orderBy('created_at')
            ->get();

        foreach($clientes as $cliente){
            $cliente->created_at = Carbon::parse($cliente->created_at)->format('d/m/Y');
            $cliente->updated_at = Carbon::parse($cliente->updated_at)->format('d/m/Y');
        }

        return $clientes;

    }

    public function updateOrCreateDomicilio($id, $request = [])
    {
        $cliente = Cliente::find($id);
        $domicilio = $cliente->domicilio()->first();

        if($domicilio){

            $domicilio->calle = $request['calle'];
            $domicilio->numero = $request['numero'];
            $domicilio->piso = $request['piso'];
            $domicilio->departamento = $request['departamento'];
            $domicilio->codigo_postal = $request['codigo_postal'];
            $domicilio->entre_calles = $request['entre_calles'];
            $domicilio->localidad_id = $request['localidad'];
            $domicilio->partido_id = $request['partido'];
            $domicilio->provincia_id = $request['provincia'];
            $domicilio->save();

        }else{

            Domicilio::create([
                'cliente_id' => $cliente->id,
                'calle' => $request['calle'],
                'numero' => $request['numero'],
                'piso' => $request['piso'],
                'departamento' => $request['departamento'],
                'codigo_postal' => $request['codigo_postal'],
                'entre_calles' => $request['entre_calles'],
                'localidad_id' => $request['localidad'],
                'partido_id' => $request['partido'],
                'provincia_id' => $request['provincia'],
            ]);

        }
    }


}
