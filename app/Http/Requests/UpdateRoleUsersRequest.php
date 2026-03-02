<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRoleUsersRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'roles' => 'required|array',
            'roles.*' => 'exists:roles,id',
        ];
    }

    public function messages(): array
    {
        return [
            'roles.required' => 'Veuillez sélectionner au moins un rôle à retirer.',
            'roles.array' => 'Format de données invalide.',
            'roles.*.exists' => 'Un ou plusieurs rôles sélectionnés n\'existent pas.',
        ];
    }
}
