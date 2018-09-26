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
        //dd($request);

        if($domicilio){

            $domicilio->calle = ($request['calle'])? $request['calle'] : '';
            $domicilio->numero = ($request['numero'])? $request['numero'] : null;
            $domicilio->piso = ($request['piso'])? $request['piso'] : null;
            $domicilio->departamento = ($request['departamento'])? $request['departamento'] : '';
            $domicilio->codigo_postal = ($request['codigo_postal'])? $request['codigo_postal'] : null;
            $domicilio->entre_calles = ($request['entre_calles'])? $request['entre_calles'] : '';
            $domicilio->barrio =  ($request['barrio'])? $request['barrio'] : '';
            $domicilio->localidad_id = (array_key_exists('localidad', $request) && $request['localidad'] != '')? $request['localidad'] : null;
            $domicilio->partido_id = (array_key_exists('partido', $request) && $request['partido'] != '')? $request['partido'] : null;
            $domicilio->provincia_id = (array_key_exists('provincia', $request) && $request['provincia'] != '')? $request['provincia'] : null;

            /*if(array_key_exists('localidad', $request))
                $domicilio->localidad_id = ($request['localidad'] != '')? $request['localidad'] : null;

            if(array_key_exists('partido', $request))
                $domicilio->partido_id = ($request['partido'] != '')? $request['partido'] : null;

            if(array_key_exists('provincia', $request))
                $domicilio->provincia_id = ($request['provincia'] != '')? $request['provincia'] : null;*/

            $domicilio->save();

        }else{

            Domicilio::create([
                'cliente_id' => $cliente->id,
                'calle' => ($request['calle'])? $request['calle'] : '',
                'numero' => ($request['numero'])? $request['numero'] : null,
                'piso' => ($request['piso'])? $request['piso'] : null,
                'departamento' => ($request['departamento'])? $request['departamento'] : '',
                'codigo_postal' => ($request['codigo_postal'])? $request['codigo_postal'] : null,
                'entre_calles' => ($request['entre_calles'])? $request['entre_calles'] : '',
                'barrio' => ($request['barrio'])? $request['barrio'] : '',
                'localidad_id' => (array_key_exists('localidad', $request) && $request['localidad'] != '')? $request['localidad'] : null,
                'partido_id' => (array_key_exists('partido', $request) && $request['partido'] != '')? $request['partido'] : null,
                'provincia_id' => (array_key_exists('provincia', $request) && $request['provincia'] != '')? $request['provincia'] : null,
            ]);

        }
    }


}
