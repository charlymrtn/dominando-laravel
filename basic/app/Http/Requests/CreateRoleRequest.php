<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRoleRequest extends FormRequest
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
            'key' => 'required|string|min:3|max:10',
            'name' => 'required|string|min:10|max:20',
            'description' => 'nullable|string|min:10|max:40'
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
            'key.required' => 'el campo llave es awebo',
            'name.required' => 'el nombre es obligatorio',
            'key.min' => 'la llave debe ser mas larga',
            'name.min' => 'la llave debe ser mas larga',
            'description.min' => 'la llave debe ser mas larga',
        ];
    }
}
