<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClientsRequest extends FormRequest
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
            'letter' => 'required',
            'rif' => 'required|numeric',
            'address' => 'required',
            'email' => 'required|email'
        ];
    }

    public function mesaages()
    {
        return [
            'name.required' => 'El Nombre del Cliente no debe estar vacío',
            'letter.required' => 'Debe seleccionar un literal del RIF',
            'rif.required' => 'El RIF no debe estar vacío',
            'rif.numeric' => 'El RIF sólo deb contener números',
            'address.required' => 'Debe Ingresar la dirección del cliente',
            'email.required' => 'El Correo no debe estar vacío',
            'email.email' => 'El Correo debe tener el formato correcto'
        ];
    }
}
