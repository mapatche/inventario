<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveBrandRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|min:3|max:30|unique:brands,name',
            'active' => 'sometimes|boolean'
        ];
    }


    public function messages()
    {
        return [
                'name.required'    => 'El nombre es obligatorio.',
                'name.string'      => 'El nombre debe ser un texto válido.',
                'name.min'         => 'El nombre debe tener al menos :min caracteres.',
                'name.max'         => 'El nombre no puede tener más de :max caracteres.',
                'name.unique'      => 'Ese nombre ya esta en uso.',
                ];
    }

}
