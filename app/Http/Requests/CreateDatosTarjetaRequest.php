<?php

namespace SmartLine\Http\Requests;

use Illuminate\Support\Facades\Input;
use SmartLine\Entities\MetodoPago;

class CreateDatosTarjetaRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $metodoPago = MetodoPago::find(Input::get('metodo_pago_id'));
        $required = ($metodoPago->slug == 'credito')? 'required' : '';
        return
            [
                'numero_tarjeta' => $required.'|numeric',
                'codigo_seguridad' => $required.'|numeric|max:9999',
                'fecha_expiracion' => $required,
                'titular' => $required
            ];
    }

    public function messages()
    {
        return
            [
                'numero_tarjeta.required' => 'El número de tarjeta es obligatorio',
                'numero_tarjeta.numeric' => 'El número de tarjeta debe ser un número',

                'codigo_seguridad.required' => 'El código de seguridad es obligatorio',
                'codigo_seguridad.numeric' => 'El código de seguridad debe ser un número',
                'codigo_seguridad.max' => 'El código de seguridad es incorrecto',

                'fecha_expiracion.required' => 'La fecha de expiración es obligatoria',

                'titular.required' => 'El titular de la tarjeta es obligatorio'
            ];
    }
}
