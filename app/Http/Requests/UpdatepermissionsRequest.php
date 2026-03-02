<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatepermissionsRequest extends FormRequest
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
        // ✅ Récupérer l'ID de la permission depuis la route (c'est un string UUID)
        $permissionId = $this->route('permission');
        
        // ✅ DEBUG (optionnel)
        \Log::info('Update permission - ID:', ['id' => $permissionId, 'type' => gettype($permissionId)]);
        
        return [
            'nom' => [
                'required',
                'string',
                'max:255',
                // ✅ Pour UUID, on ignore l'ID actuel dans la règle unique
                Rule::unique('permissions', 'nom')->ignore($permissionId, 'id')
            ],
            'description' => 'nullable|string',
        ];
    }
    
    /**
     * Messages d'erreur personnalisés
     */
    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom de la permission est requis.',
            'nom.unique' => 'Ce nom de permission existe déjà.',
            'nom.max' => 'Le nom ne doit pas dépasser :max caractères.',
        ];
    }
}