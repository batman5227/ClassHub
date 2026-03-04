<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSitesRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // ✅ Récupérer l'ID depuis la route (car le model binding n'est pas encore fait)
        $siteId = $this->route('sites'); // ou $this->route('sites') selon ta route

        return [

            'nom' => 'required|string|max:255',
            'localisation' => 'required|string|max:255',
            'idCoursDappuie' => 'required|uuid|exists:coursdappuies,id',
            'nom' => [
                'required',
                'string',
                'max:255',
                Rule::unique('sites', 'nom')->ignore($siteId, 'id')
            ],
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
