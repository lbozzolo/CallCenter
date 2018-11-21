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
                'body' => 'max:1000'
            ];
    }

    public function messages()
    {
        return
            [
                'subject.required' => 'El asunto es obligatorio',
                'subject.max' => 'El asunto no puede superar los 255 caracteres',
                'body.max' => 'La descripción no puede superar los 1000 caracteres',
            ];
    }
}
