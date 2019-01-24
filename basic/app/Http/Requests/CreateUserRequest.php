<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateUserRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:3|confirmed',
            'role_id' => 'required|integer|exists:roles,id'
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'el campo correo es awebo',
            'name.required' => 'el nombre es obligatorio',
            'role_id.required' => 'el rol es awebo',
            'role_id.exists' => 'el rol no existe',
            'password.required' => 'el password es obligatorio',
            'password.confirmed' => 'el password no coincide',
            'password.min' => 'el password tiene que ser mas largo',
        ];
    }
}
