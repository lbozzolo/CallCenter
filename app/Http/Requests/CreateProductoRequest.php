<?php

namespace SmartLine\Http\Requests;

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

                'nombre' => 'required|max:255',
                'descripcion' => 'max:1000',
                'estado_id' => 'required',
                //'fecha_finalizacion' => 'after:fecha_inicio',
                'unidad_medida_id' => 'exists:unidades_medida,id',
                'cantidad_medida' => 'numeric|min:0|max:100000',
                'stock' => 'numeric|min:0|max:100000',
                'alerta_stock' => 'numeric|min:0|max:100000',
                'marca_id' => 'exists:marcas,id',
                'precio' => 'numeric|min:0|max:100000',
                'institucion_id' => 'exists:instituciones,id',

            ];
    }

    public function messages()
    {
        return
            [

                'nombre.required' => 'El nombre es obligatorio',
                'nombre.max' => 'El nombre no puede exceder los 255 caracteres',

                'descripcion.max' => 'La descripción no puede exceder los 1000 caracteres',

                'fecha_finalizacion.after' => 'La fecha de finalización debe ser posterior a la fecha de inicio',

                'estado_id.required' => 'El estado es requerido',

                'unidad_medida_id.exists' => 'La unidad de medida especificada no existe',

                'cantidad_medida.numeric' => 'La cantidad debe ser un número',
                'cantidad_medida.min' => 'La cantidad no puede ser menor a 0',
                'cantidad_medida.max' => 'La cantidad no puede ser mayor a 100000',

                'stock.numeric' => 'El stock debe ser un número',
                'stock.min' => 'El stock no puede ser menor a 0',
                'stock.max' => 'El stock no puede ser mayor a 100000',

                'alerta_stock.numeric' => 'La alerta de stock debe ser un número',
                'alerta_stock.min' => 'La alerta de stock no puede ser menor a 0',
                'alerta_stock.max' => 'La alerta de stock no puede ser mayor a 100000',

                'marca_id.exists' => 'La marca seleccionada no existe',

                'precio.numeric' => 'El precio debe ser un número',
                'precio.min' => 'El precio no puede ser menor a 0',
                'precio.max' => 'El precio no puede ser mayor a 100000',

                'institucion_id.exists' => 'La institución especificada no existe',

            ];
    }
}
