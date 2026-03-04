<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUsersCoursappuieSiteClasseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'userId' => 'required|exists:users,id',
            'siteId' => 'required|exists:sites,id',
            'coursAppuieId' => 'required|exists:coursdappuies,id',
            'classeId' => 'required|exists:classes,id',
        ];
    }

    public function messages(): array
    {
        return [
            'userId.required' => 'L\'utilisateur est obligatoire.',
            'userId.exists' => 'L\'utilisateur sélectionné n\'existe pas.',
            'siteId.required' => 'Le site est obligatoire.',
            'siteId.exists' => 'Le site sélectionné n\'existe pas.',
            'coursAppuieId.required' => 'Le cours d\'appui est obligatoire.',
            'coursAppuieId.exists' => 'Le cours d\'appui sélectionné n\'existe pas.',
            'classeId.required' => 'La classe est obligatoire.',
            'classeId.exists' => 'La classe sélectionnée n\'existe pas.',
        ];
    }
}
