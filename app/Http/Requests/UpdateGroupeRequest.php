<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateGroupeRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255',
            'idClasse' => 'required|uuid|exists:classes,id',
            'nom' => [
                'required',
                'string',
                'max:255',
            ],
            'idClasse' => 'required|exists:classes,id',
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom du groupe est obligatoire.',
            'nom.max' => 'Le nom ne doit pas dépasser :max caractères.',
            'idClasse.required' => 'La classe est obligatoire.',
            'idClasse.exists' => 'La classe sélectionnée n\'existe pas.',
        ];
    }
}
