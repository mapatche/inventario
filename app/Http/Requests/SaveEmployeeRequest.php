<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class SaveEmployeeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'first_name' => 'required|string|min:2|max:50',
            'last_name' => 'required|string|min:2|max:50',
            'phone' => 'nullable|string|regex:/^[0-9+\s\-()]{7,20}$/',
            'email' => 'required|email:rfc,dns|max:255|unique:empleados,email',
            'active' => 'required|boolean',
            'department_id' => 'required|integer|exists:departments,id',
        ];
    }
      public function messages(): array
    {
        return [
        'first_name.required'    => 'El nombre es obligatorio.',
        'first_name.string'      => 'El nombre debe ser un texto válido.',
        'first_name.min'         => 'El nombre debe tener al menos :min caracteres.',
        'first_name.max'         => 'El nombre no puede tener más de :max caracteres.',

        'last_name.required'     => 'El apellido es obligatorio.',
        'last_name.string'       => 'El apellido debe ser un texto válido.',
        'last_name.min'          => 'El apellido debe tener al menos :min caracteres.',
        'last_name.max'          => 'El apellido no puede tener más de :max caracteres.',

        'phone.string'           => 'El teléfono debe ser una cadena de texto.',
        'phone.regex'            => 'El formato del teléfono no es válido. Usa números, espacios, guiones o paréntesis.',

        'email.required'         => 'El correo electrónico es obligatorio.',
        'email.email'            => 'El formato del correo electrónico no es válido.',
        'email.max'              => 'El correo electrónico no puede tener más de :max caracteres.',
        'email.unique'           => 'Este correo electrónico ya está registrado en el sistema.',

        'active.required'        => 'Debes especificar si el empleado está activo o inactivo.',
        'active.boolean'         => 'El estado del empleado debe ser un valor booleano válido.',

        'department_id.required' => 'Debes seleccionar un departamento.',
        'department_id.integer'  => 'El departamento seleccionado no es válido.',
        'department_id.exists'   => 'El departamento seleccionado no existe en nuestro sistema.',
        ];
    }
}
