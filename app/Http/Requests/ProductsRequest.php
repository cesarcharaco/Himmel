<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'existence' => 'required|numeric',
            'unity' => 'required',
            'price' => 'required|numeric',
            'stock_min' => 'required|numeric',
            'stock_max' => 'required|numeric'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El Nombre del producto es obligatorio',
            'existence.required' => 'La Existencia es obligatoria',
            'existence.numeric' => 'La Existencia sólo debe contener números',
            'unity.required' => 'Debe seleccionar una Unidad de medida',
            'price.required' => 'El Precio es obligatorio',
            'price.numeric' => 'El Precio solo debe contener números',
            'stock_min.required' => 'El Stock Mínimo es obligatorio',
            'stock_min.numeric' => 'El Stock Mínimo sólo debe contener números',
            'stock_max.required' => 'El Stock Máximo es obligatorio',
            'stock_max.numeric' => 'El Stock Máximo sólo debe contener números'
        ];
    }
}
