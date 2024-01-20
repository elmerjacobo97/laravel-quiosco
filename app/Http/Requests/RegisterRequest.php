<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class RegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true; // change to true
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'string'],   
            'email' => ['required', 'email', 'string', 'unique:users,email'],
            'password' => ['required', 'string', 'confirmed', Password::min(8)->letters()->numbers()->symbols()],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'El nombre es obligatorio',
            'email.required' => 'El correo es obligatorio',
            'email.email' => 'El correo no es válido',
            'email.unique' => 'El correo ya existe',
            'password.required' => 'La contraseña es obligatoria',
            'password.confirmed' => 'La confirmación de la contraseña no coincide',
            'password.min' => 'La contraseña debe tener al menos 8 caracteres',
            'password.letters' => 'La contraseña debe tener al menos una letra',
            'password.numbers' => 'La contraseña debe tener al menos un número',
            'password.symbols' => 'La contraseña debe tener al menos un simbolo',
        ];
    }
}
