<?php namespace SmartLine\Http\Repositories;

use Illuminate\Database\Eloquent\SoftDeletes;
use SmartLine\Entities\Cliente;
use SmartLine\Entities\Domicilio;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use SmartLine\Entities\DatoTarjeta;
use SmartLine\Entities\ValidateCreditCard;
use SmartLine\Entities\EstadoCliente;

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

    public function updateCliente($id, $request)
    {
        $cliente = Cliente::find($id);
        $desde = ($request->from_date)? $request->from_date : Carbon::parse($request->from_date)->startOfDay()->format('H:i:s');
        $hasta = ($request->to_date)? $request->to_date : Carbon::parse($request->to_date)->startOfDay()->format('H:i:s');

        $cliente->nombre = $request->nombre;
        $cliente->apellido = $request->apellido;
        $cliente->telefono = $request->telefono;
        $cliente->celular = $request->celular;
        $cliente->email = $request->email;
        $cliente->username = str_slug(strtolower($request->nombre[0].$request->apellido));
        $cliente->dni = $request->dni;
        $cliente->cuit = $request->cuit;
        $cliente->cuil = $request->cuil;
        $cliente->referencia = $request->referencia;
        $cliente->observaciones = $request->observaciones;
        $cliente->from_date = $desde;
        $cliente->to_date = $hasta;
        $cliente->puntos = $request->puntos;
        $cliente->estado_id = $request->estado_id;

        $cliente->save();

        return $cliente;
    }

    public function updateTarjeta($id, $request)
    {
        $tarjeta = DatoTarjeta::find($id);
        $fechaExpiracion = ($request->fecha_expiracion)? Carbon::createFromFormat('d/m/Y', '01/'.$request->fecha_expiracion)->toDateTimeString() : null;

        $firstDate = new Carbon($tarjeta->fecha_expiracion);
        $secondDate = Carbon::createFromFormat('d/m/Y', '01/'.$request->fecha_expiracion);
        $firstDate->setTime(12, 0, 0);
        $secondDate->setTime(12, 0, 0);


        if($request['marca_id'] && $request['marca_id'] != $tarjeta->marca_id){
            $tarjeta->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'marca_id',
                'former_value' => $tarjeta->marca_id,
                'updated_value' => $request['marca_id']
            ]);
            $tarjeta->marca_id = $request['marca_id'];
        }

        if($request['banco_id'] && $request['banco_id'] != $tarjeta->banco_id){
            $tarjeta->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'banco_id',
                'former_value' => $tarjeta->banco_id,
                'updated_value' => $request['banco_id']
            ]);
            $tarjeta->banco_id = $request['banco_id'];
        }

        if($request['numero_tarjeta'] && $request['numero_tarjeta'] != $tarjeta->numero_tarjeta){
            $tarjeta->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'numero_tarjeta',
                'former_value' => $tarjeta->numero_tarjeta,
                'updated_value' => $request['numero_tarjeta']
            ]);
            $tarjeta->numero_tarjeta = $request['numero_tarjeta'];
        }

        if($request['codigo_seguridad'] && $request['codigo_seguridad'] != $tarjeta->codigo_seguridad){
            $tarjeta->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'codigo_seguridad',
                'former_value' => $tarjeta->codigo_seguridad,
                'updated_value' => $request['codigo_seguridad']
            ]);
            $tarjeta->codigo_seguridad = $request['codigo_seguridad'];
        }

        if($request['titular'] && $request['titular'] != $tarjeta->titular){
            $tarjeta->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'titular',
                'former_value' => $tarjeta->titular,
                'updated_value' => $request['titular']
            ]);
            $tarjeta->titular = $request['titular'];
        }

        if($request['fecha_expiracion'] && $firstDate != $secondDate){
            $tarjeta->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'fecha_expiracion',
                'former_value' => $tarjeta->fecha_expiracion,
                'updated_value' => $fechaExpiracion
            ]);
            $tarjeta->fecha_expiracion = $fechaExpiracion;
        }

        $tarjeta->save();

        return $tarjeta;
    }

    public function validateCreditCard($numeroTarjeta)
    {
        $validateFormat = ValidateCreditCard::validateFormatCreditCard($numeroTarjeta);
        $validateLuhn = ValidateCreditCard::calculateLuhn($numeroTarjeta);

        return ($validateFormat && $validateLuhn)? true : false;
    }

    public function updateOrCreateDomicilio($id, $request = [])
    {
        $cliente = Cliente::find($id);
        $domicilio = $cliente->domicilio()->first();

        if($domicilio){


            if($request['calle'] && $request['calle'] != $domicilio->calle){
                $domicilio->updateable()->create([
                    'user_id' => Auth::user()->id,
                    'action' => 'update',
                    'field' => 'calle',
                    'former_value' => $domicilio->calle,
                    'updated_value' => $request['calle']
                ]);
                $domicilio->calle = $request['calle'];
            }
            //$domicilio->calle = ($request['calle'])? $request['calle'] : '';

            if($request['numero'] && $request['numero'] != $domicilio->numero){
                $domicilio->updateable()->create([
                    'user_id' => Auth::user()->id,
                    'action' => 'update',
                    'field' => 'numero',
                    'former_value' => $domicilio->numero,
                    'updated_value' => $request['numero']
                ]);
                $domicilio->numero = $request['numero'];
            }
            //$domicilio->numero = ($request['numero'])? $request['numero'] : null;

            if($request['piso'] && $request['piso'] != $domicilio->piso){
                $domicilio->updateable()->create([
                    'user_id' => Auth::user()->id,
                    'action' => 'update',
                    'field' => 'piso',
                    'former_value' => $domicilio->piso,
                    'updated_value' => $request['piso']
                ]);
                $domicilio->piso = $request['piso'];
            }
            //$domicilio->piso = ($request['piso'])? $request['piso'] : null;

            if($request['departamento'] && $request['departamento'] != $domicilio->departamento){
                $domicilio->updateable()->create([
                    'user_id' => Auth::user()->id,
                    'action' => 'update',
                    'field' => 'departamento',
                    'former_value' => $domicilio->departamento,
                    'updated_value' => $request['departamento']
                ]);
                $domicilio->departamento = $request['departamento'];
            }
            //$domicilio->departamento = ($request['departamento'])? $request['departamento'] : '';

            if($request['codigo_postal'] && $request['codigo_postal'] != $domicilio->codigo_postal){
                $domicilio->updateable()->create([
                    'user_id' => Auth::user()->id,
                    'action' => 'update',
                    'field' => 'codigo_postal',
                    'former_value' => $domicilio->codigo_postal,
                    'updated_value' => $request['codigo_postal']
                ]);
                $domicilio->codigo_postal = $request['codigo_postal'];
            }
            //$domicilio->codigo_postal = ($request['codigo_postal'])? $request['codigo_postal'] : null;

            if($request['entre_calles'] && $request['entre_calles'] != $domicilio->entre_calles){
                $domicilio->updateable()->create([
                    'user_id' => Auth::user()->id,
                    'action' => 'update',
                    'field' => 'entre_calles',
                    'former_value' => $domicilio->entre_calles,
                    'updated_value' => $request['entre_calles']
                ]);
                $domicilio->entre_calles = $request['entre_calles'];
            }
            //$domicilio->entre_calles = ($request['entre_calles'])? $request['entre_calles'] : '';

            if($request['barrio'] && $request['barrio'] != $domicilio->barrio){
                $domicilio->updateable()->create([
                    'user_id' => Auth::user()->id,
                    'action' => 'update',
                    'field' => 'barrio',
                    'former_value' => $domicilio->barrio,
                    'updated_value' => $request['barrio']
                ]);
                $domicilio->barrio = $request['barrio'];
            }
            //$domicilio->barrio =  ($request['barrio'])? $request['barrio'] : '';

            if(array_key_exists('localidad', $request) && $request['localidad'] != '' && $request['localidad'] && $request['localidad'] != $domicilio->localidad_id){
                $domicilio->updateable()->create([
                    'user_id' => Auth::user()->id,
                    'action' => 'update',
                    'field' => 'localidad',
                    'former_value' => $domicilio->localidad_id,
                    'updated_value' => $request['localidad']
                ]);
                $domicilio->localidad_id = $request['localidad'];
            }
            //$domicilio->localidad_id = (array_key_exists('localidad', $request) && $request['localidad'] != '')? $request['localidad'] : null;

            if(array_key_exists('partido', $request) && $request['partido'] != '' && $request['partido'] && $request['partido'] != $domicilio->partido_id){
                $domicilio->updateable()->create([
                    'user_id' => Auth::user()->id,
                    'action' => 'update',
                    'field' => 'partido',
                    'former_value' => $domicilio->partido_id,
                    'updated_value' => $request['partido']
                ]);
                $domicilio->partido_id = $request['partido'];
            }
            //$domicilio->partido_id = (array_key_exists('partido', $request) && $request['partido'] != '')? $request['partido'] : null;

            if(array_key_exists('provincia', $request) && $request['provincia'] != '' && $request['provincia'] && $request['provincia'] != $domicilio->provincia_id){
                $domicilio->updateable()->create([
                    'user_id' => Auth::user()->id,
                    'action' => 'update',
                    'field' => 'provincia',
                    'former_value' => $domicilio->provincia_id,
                    'updated_value' => $request['provincia']
                ]);
                $domicilio->provincia_id = $request['provincia'];
            }
            //$domicilio->provincia_id = (array_key_exists('provincia', $request) && $request['provincia'] != '')? $request['provincia'] : null;

            $domicilio->save();

            return $domicilio;


        }else{

            $nuevoDomicilio = Domicilio::create([
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

            $nuevoDomicilio->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'create'
            ]);

            return $nuevoDomicilio;

        }
    }

    /**
     * @param $id
     * @param null $reason
     * @return mixed
     */

    public function disable($id, $reason = null)
    {
        $cliente = Cliente::find($id);

        $deshabilitado = EstadoCliente::where('slug', 'deshabilitado')->first();

        $cliente->updateable()->create([
            'user_id' => Auth::user()->id,
            'action' => 'update',
            'field' => 'estado_id',
            'former_value' => $cliente->estado->nombre,
            'updated_value' => $deshabilitado->nombre,
            'reason' => $reason
        ]);

        $cliente->estado_id = $deshabilitado->id;
        $cliente->save();

        return $cliente;
    }


}
