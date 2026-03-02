<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSitesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nom' => 'required|string|max:255|unique:sites,nom',
            'localisation' => 'required|string',
            'idCoursDappuie' => 'nullable|exists:coursdappuies,id',
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom du site est obligatoire.',
            'nom.unique' => 'Ce nom de site existe déjà.',
            'nom.max' => 'Le nom ne doit pas dépasser :max caractères.',
            'localisation.required' => 'La localisation est obligatoire.',
            'idCoursDappuie.exists' => 'Le cours d\'appui sélectionné n\'existe pas.',
        ];
    }
}
