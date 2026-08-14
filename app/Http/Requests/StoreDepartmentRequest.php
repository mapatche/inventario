<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:30|unique:departments,name',
            'active' => 'nullable|boolean',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'El nombre del departamento es obligatorio.',
            'name.string'   => 'El nombre debe ser texto válido.',
            'name.max'      => 'El nombre no puede tener más de 30 caracteres.',
            'name.unique'   => 'Ese departamento ya existe, elije otro nombre.',
            'active.boolean' => 'El campo activo debe ser verdadero o falso.',
        ];
    }
}
