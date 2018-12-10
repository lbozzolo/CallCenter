<?php namespace SmartLine\Http\Repositories;

use SmartLine\Entities\FormaPago;
use Illuminate\Support\Facades\Auth;

class FormaPagoRepo extends BaseRepo
{
    public function getModel()
    {
        return new FormaPago();
    }

    public function getFormaPago($tarjetaId, $bancoId, $cuotaCantidad)
    {
        return FormaPago::where('marca_tarjeta_id', $tarjetaId)
            ->where('banco_id', $bancoId)
            ->where('cuota_cantidad', $cuotaCantidad)
            ->first();
    }

    public function updateFormaPago($id, $request)
    {
        $formaPago = FormaPago::find($id);

        if($request->interes_descuento == 'interes')
            $request['interes'] = $request->valor;

        if($request->interes_descuento == 'descuento')
            $request['descuento'] = $request->valor;

        if($request['marca_tarjeta_id'] && $request['marca_tarjeta_id'] != $formaPago->marca_tarjeta_id){
            $formaPago->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'marca_tarjeta_id',
                'former_value' => $formaPago->marca_tarjeta_id,
                'updated_value' => $request['marca_tarjeta_id']
            ]);
            $formaPago->marca_tarjeta_id = $request['marca_tarjeta_id'];
        }

        if($request['cuota_cantidad'] && $request['cuota_cantidad'] != $formaPago->cuota_cantidad){
            $formaPago->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'cuota_cantidad',
                'former_value' => $formaPago->cuota_cantidad,
                'updated_value' => $request['cuota_cantidad']
            ]);
            $formaPago->cuota_cantidad = $request['cuota_cantidad'];
        }

        if($request['interes'] && $request['interes'] != $formaPago->interes){
            $formaPago->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'interes',
                'former_value' => $formaPago->interes,
                'updated_value' => $request['interes']
            ]);
            $formaPago->interes = $request['interes'];
            $formaPago->descuento = null;
        }

        if($request['descuento'] && $request['descuento'] != $formaPago->descuento){
            $formaPago->updateable()->create([
                'user_id' => Auth::user()->id,
                'action' => 'update',
                'field' => 'descuento',
                'former_value' => $formaPago->descuento,
                'updated_value' => $request['descuento']
            ]);
            $formaPago->descuento = $request['descuento'];
            $formaPago->interes = null;
        }

        $formaPago->save();

        return $formaPago;
    }


}
