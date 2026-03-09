<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAnneeScolaireRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            //
            'annee' => 'required|string|max:255|unique:annee_scolaires,annee,' . $this->route('anneeScolaire')->id,
            'date_debut' => 'required|date',
            'date_fin' => 'required|date|after:date_debut',
            'is_active' => 'boolean',
        ];
    }
}
