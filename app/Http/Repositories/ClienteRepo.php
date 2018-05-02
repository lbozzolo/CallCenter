<?php namespace SmartLine\Http\Repositories;

use Illuminate\Database\Eloquent\SoftDeletes;
use SmartLine\Entities\Cliente;
use SmartLine\Entities\EstadoProducto;
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


}
