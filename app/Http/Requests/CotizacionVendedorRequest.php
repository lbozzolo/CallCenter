<?php

namespace SmartLine\Http\Requests;

class CotizacionVendedorRequest extends Request
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return
            [
                'provincia' => 'required',
                'codigoPostal' => 'required',
                'peso' => 'required',
            ];
    }

    public function messages()
    {
        return
            [
                'provincia.required' => 'El campo "Provincia" es obligatorio',
                'codigoPostal.required' => 'El campo "Código Postal" es obligatorio',
                'peso.required' => 'El campo "Peso" es obligatorio',
            ];
    }
}
