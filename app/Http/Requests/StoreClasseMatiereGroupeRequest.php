<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreClasseMatiereGroupeRequest extends FormRequest
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
            'classe_id' => 'required|uuid|exists:classes,id',
            'matiere_id' => 'required|uuid|exists:matieres,id',
            'groupe_id' => 'required|uuid|exists:groupes,id',
        ];
    }

    /**
     * Préparer les données pour la validation (optionnel)
     * Si vous voulez garder les noms originaux dans la base de données
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'idClasse' => $this->classe_id,
            'idMatiere' => $this->matiere_id,
            'idGroupe' => $this->groupe_id,
        ]);
    }
}
