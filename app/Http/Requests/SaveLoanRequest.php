<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveLoanRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'notes' => 'nullable|string|max:255',
            'active' => 'sometimes|boolean',
            'employee_id' => 'required|integer|exists:employee,id',
            'item_id' => 'required|integer|exists:item,id',
        ];
    }

    public function messages()
    {
        return [
            'notes.max' => 'Las notas no puede tener más de :max caracteres.',
            'notes.string' => 'Las notas deben ser cadenas de texto.',

            'employee_id.required' => 'El empleado es requerido',
            'employee_id.integer' => 'Debe ser un numero',
            'employee_id.exists' => 'No existe el empleado que deseas asignar.',

            'item_id.required' => 'El item es requerido',
            'item_id.integer' => 'Debe ser un numero',
            'item_id.exists' => 'No existe el item que deseas asignar.',

            'active.boolean' => 'Debe ser booleano.',
        ];
    }
}
