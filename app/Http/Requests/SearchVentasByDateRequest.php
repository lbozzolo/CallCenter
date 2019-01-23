<?php

namespace SmartLine\Http\Requests;

class SearchVentasByDateRequest extends Request
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return
            [
                'fecha_desde' => 'required',
                'fecha_hasta' => 'required',
            ];
    }

    public function messages()
    {
        return
            [
                'fecha_desde.required' => 'Elija una fecha de inicio para su búsqueda',
                'fecha_hasta.required' => 'Elija una fecha de finalización para su búsqueda',
            ];
    }
}
