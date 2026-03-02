<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsersCoursappuieSiteClasseRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'userId' => 'sometimes|exists:users,id',
            'siteId' => 'sometimes|exists:sites,id',
            'coursAppuieId' => 'sometimes|exists:coursdappuies,id',
            'classeId' => 'sometimes|exists:classes,id',
        ];
    }

    public function messages(): array
    {
        return [
            'userId.exists' => 'L\'utilisateur sélectionné n\'existe pas.',
            'siteId.exists' => 'Le site sélectionné n\'existe pas.',
            'coursAppuieId.exists' => 'Le cours d\'appui sélectionné n\'existe pas.',
            'classeId.exists' => 'La classe sélectionnée n\'existe pas.',
        ];
    }
}
