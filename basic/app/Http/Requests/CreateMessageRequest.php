<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateMessageRequest extends FormRequest
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
            'nombre' => 'required',
            'correo' => 'required|email',
            'mensaje' => 'required|min:5',
            'telefono' => 'required|numeric|digits_between:10,15'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'nombre.required' => 'el campo del nombre es awebo',
            'correo.required' => 'el correo es obligatorio',
            'correo.email' => 'eso no es un correo we',
            'mensaje.required' => 'el mensaje es a huevo',
            'mensaje.min' => 'escribe un poco mas porfa. :P',
            'telefono.required' => 'un teléfono donde localizarte ;)',
            'telefono.min' => 'telefono no válido',
            'telefono.max' => 'telefono muy largo',
            'telefono.numeric' => 'los teléfonos solo llevan números porfi ;)',
        ];
    }
}
