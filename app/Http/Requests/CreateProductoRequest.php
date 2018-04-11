<?php

namespace CallCenter\Http\Requests;

class CreateProductoRequest extends Request
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return
            [

            ];
    }

    public function messages()
    {
        return
            [

            ];
    }
}
