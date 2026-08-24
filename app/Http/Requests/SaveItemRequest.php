<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveItemRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        $itemId = $this->route('item') ? $this->route('item')->id : null;
        $isUpdating = $itemId !== null;

        return [
            'model' => 'required|string|min:3|max:20',
            'serial' => [
                'required',
                'string',
                'min:3',
                'max:20',
                $isUpdating ? 'unique:items,serial,'.$itemId : 'unique:items,serial,',
            ],
            'notes' => 'nullable|string|max:255',
            'type_id' => 'required|integer|exists:types,id',
            'brand_id' => 'required|integer|exists:brands,id',
            'active' => 'sometimes|boolean',
        ];
    }

    public function messages()
    {
        return [
            'model.required' => 'El modelo es obligatorio.',
            'model.string' => 'El modelo debe ser un texto válido.',
            'model.min' => 'El modelo debe tener al menos :min caracteres.',
            'model.max' => 'El modelo no puede tener más de :max caracteres.',

            'serial.required' => 'El serial es obligatorio.',
            'serial.string' => 'El serial debe ser un texto válido.',
            'serial.min' => 'El serial debe tener al menos :min caracteres.',
            'serial.max' => 'El serial no puede tener más de :max caracteres.',
            'serial.unique' => 'El serial debe ser unico.',

            'notes.max' => 'Las notas no puede tener más de :max caracteres.',
            'notes.string' => 'Las notas deben ser cadenas de texto.',

            'type_id.required' => 'El tipo es requerido',
            'type_id.integer' => 'Debe ser un numero',
            'type_id.exists' => 'No existe el tipo que deseas asignar.',

            'brand_id.required' => 'La marca es requerida',
            'brand_id.integer' => 'Debe ser un numero',
            'brand_id.exists' => 'No existe la marca que deseas asignar.',

            'active.boolean' => 'Debe ser booleano.',

        ];
    }
}
