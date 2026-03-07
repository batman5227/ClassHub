<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCoursRequest extends FormRequest
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
            'nom' => 'required|string|max:255|unique:cours,nom,' . $this->cours->id,
            'idMatiere' => 'required|exists:matieres,id',
        ];
    }

    /**
     * Get custom messages for validator errors.
     */
    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom du cours est obligatoire',
            'nom.unique' => 'Ce nom de cours existe déjà',
            'nom.max' => 'Le nom ne doit pas dépasser 255 caractères',
            'idMatiere.required' => 'La matière est obligatoire',
            'idMatiere.exists' => 'La matière sélectionnée n\'existe pas',
        ];
    }
}
