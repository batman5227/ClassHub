<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateUsersRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {

        $userId = $this->route('user');
        // Récupérer l'ID de l'utilisateur depuis la route
        $userId = $this->route('user') ?? $this->route('users');

        return [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'telephone' => 'required|string|unique:users,telephone,' . $userId,
            'password' => 'nullable|string|min:8',
            'email' => 'required|email|unique:users,email,' . $userId,
            'status' => 'required|in:actif,inactif',
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($userId)
            ],
            'telephone' => [
                'required',
                'string',
                'max:20',
                Rule::unique('users', 'telephone')->ignore($userId)
            ],
            'password' => 'nullable|string|min:8|confirmed',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:5048',
            'status' => 'required|in:actif,inactif',
        ];
    }

    public function messages(): array
    {
        return [
            'nom.required' => 'Le nom est obligatoire.',
            'nom.max' => 'Le nom ne doit pas dépasser :max caractères.',
            'prenom.required' => 'Le prénom est obligatoire.',
            'prenom.max' => 'Le prénom ne doit pas dépasser :max caractères.',
            'email.required' => 'L\'email est obligatoire.',
            'email.email' => 'Veuillez fournir une adresse email valide.',
            'email.unique' => 'Cet email est déjà utilisé par un autre utilisateur.',
            'telephone.required' => 'Le téléphone est obligatoire.',
            'telephone.unique' => 'Ce numéro de téléphone est déjà utilisé.',
            'telephone.max' => 'Le téléphone ne doit pas dépasser :max caractères.',
            'password.min' => 'Le mot de passe doit contenir au moins :min caractères.',
            'password.confirmed' => 'La confirmation du mot de passe ne correspond pas.',
            'photo.image' => 'Le fichier doit être une image.',
            'photo.mimes' => 'L\'image doit être au format :values.',
            'photo.max' => 'L\'image ne doit pas dépasser 5 Mo.',
            'status.required' => 'Le statut est obligatoire.',
            'status.in' => 'Le statut doit être "actif" ou "inactif".',
        ];
    }
}
