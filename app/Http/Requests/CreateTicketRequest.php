<?php

namespace SmartLine\Http\Requests;

class CreateTicketRequest extends Request
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return
            [
                'subject' => 'required|max:255',
                'body' => 'max:1000',
                'modulo' => 'required'
            ];
    }

    public function messages()
    {
        return
            [
                'subject.required' => 'El asunto es obligatorio',
                'subject.max' => 'El asunto no puede superar los 255 caracteres',

                'body.max' => 'La descripción no puede superar los 1000 caracteres',

                'modulo.required' => 'Debe especificar el módulo al que hace referencia el ticket'
            ];
    }
}
