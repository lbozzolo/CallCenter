<?php

namespace SmartLine\Http\Requests;

use SmartLine\Entities\EstadoCliente;

class CreateClienteRequest extends Request
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        $estados = EstadoCliente::all()->count();
        return
            [
                'nombre' => 'required|max:255',
                'apellido' => 'required|max:255',
                'direccion' => 'max:255',
                'telefono' => 'numeric',
                'celular' => 'required_without:telefono|numeric',
                'email' => 'email',
                'dni' => 'required|numeric',
                'referencia' => 'max:255',
                'observaciones' => 'max:255',
                'puntos' => 'numeric',
                'estado_id' => 'between:1,'.$estados,

                'numero' => 'numeric',
                'piso' => 'numeric',
                'codigo_postal' => 'numeric|max:4',
            ];
    }

    public function messages()
    {
        return
            [
                'nombre.required' => 'El nombre es obligatorio',
                'nombre.max' => 'El nombre no puede exceder los 255 caracteres',

                'apellido.required' => 'El apellido es obligatorio',
                'apellido.max' => 'El apellido no puede exceder los 255 caracteres',

                'direccion.max' => 'La dirección no debe exceder los 255 caracteres',

                //'telefono.required_without' => 'Debe ingresar al menos un teléfono o un celular',
                'telefono.numeric' => 'El teléfono debe ser un número',

                'celular.required_without' => 'Debe ingresar al menos un teléfono o un celular',
                'celular.numeric' => 'El celular debe ser un número',

                'email.email' => 'El formato del email es inválido',

                'dni.required' => 'El DNI es obligatorio',
                'dni.numeric' => 'El DNI es inválido. Debe ser un número',

                'referencia.max' => 'La referencia no puede exceder los 255 caracteres',

                'observaciones.max' => 'La referencia no puede exceder los 255 caracteres',

                'puntos.numeric' => 'Los puntos ingresados deben ser un número',

                'estado_id.between' => 'El estado ingresado es inválido',

                'numero.numeric' => 'El número tiene un formato incorrecto. Debe ser un número',

                'piso.numeric' => 'El piso debe ser un número',

                'codigo_postal.numeric' => 'El código postal debe ser un número',
                'codigo_postal.max' => 'El código postal no puede tener más de 4 caracteres',

            ];
    }
}
