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
            'idMatiere' => 'required|uuid|exists:matieres,id',
            'idClasse' => 'required|uuid|exists:classes,id',
            'idGroupe' => 'required|uuid|exists:groupes,id',
        ];
    }
}
