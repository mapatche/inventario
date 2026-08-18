<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SaveDepartmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $departmentId = $this->route('department') ? $this->route('department')->id : null;

        $isUpdating = $departmentId !== null;

        return [
            'name'   => [
                $isUpdating ? 'sometimes' : 'required',
                'string',
                'max:30',
                Rule::unique('departments', 'name')->ignore($departmentId) // Evita el choque del unique
            ],
            'active' => ['sometimes', 'boolean'],
        ];
    }

    public function messages(): array
    {
        return [
            'uuid.unique'     => 'Ese UUID ya está registrado.',
            'name.required'   => 'El nombre del departamento es obligatorio.',
            'name.max'        => 'El nombre no debe pasar de 30 caracteres.',
            'name.unique'     => 'Ese departamento ya existe.',
            'active.boolean'  => 'El campo activo debe ser verdadero o falso.',
        ];
    }
}
