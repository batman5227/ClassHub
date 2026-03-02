<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AffecterPermissionsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'permissions' => 'sometimes|array',
            'permissions.*' => [
                'nullable',
                'string',
                'exists:permissions,id'
            ]
        ];
    }

    public function messages(): array
    {
        return [
            'permissions.*.exists' => 'Une ou plusieurs permissions sélectionnées n\'existent pas',
            'permissions.*.string' => 'Format de permission invalide'
        ];
    }
    protected function prepareForValidation()
    {
        // Filtrer les valeurs vides ou '0' du tableau permissions
        if ($this->has('permissions')) {
            $permissions = array_filter($this->permissions, function($value) {
                return !empty($value) && $value !== '0' && $value !== 0;
            });

            $this->merge([
                'permissions' => array_values($permissions) // Réindexer le tableau
            ]);
        }
    }
}
