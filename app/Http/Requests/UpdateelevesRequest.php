<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateelevesRequest extends FormRequest
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
        $eleveId = $this->route('elefe');

        return [
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:eleves,email,' . $eleveId,
            'telephoneParent' => 'required|string|max:20',
            'idClasse' => 'required|uuid|exists:classes,id',
            'idSites' => 'required|uuid|exists:sites,id',
            'idCoursDappuie' => 'required|uuid|exists:coursdappuies,id',
        ];
    }
}
