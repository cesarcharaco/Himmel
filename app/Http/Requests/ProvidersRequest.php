<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProvidersRequest extends FormRequest
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
            'business_name' => 'required',
            'letter' => 'required',
            'rif' => 'required|numeric',
            'salesman' => 'required',
            'email' => 'required|email'
        ];
    }

    public function mesagges()
    {
        return [
            'business_name.required' => 'El NOmbre de la Empresa es obligatorio',
            'letter.required' => 'Debe seleccionar un literal del RIF',
            'rif.required' => 'El RIF es obligatorio',
            'rif.numeric' => 'El RIF sólo debe contener números',
            'salesman.required' => 'El Nombre del representante es obligatorio',
            'email.required' => 'El Correo es obligatorio',
            'email.email' => 'El Correo debe tener un formato válido'
        ];
    }
}
