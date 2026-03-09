<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUsersCoursDappuieSitesClasseRequest extends FormRequest
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
            //
            'idUsers' => 'required|uuid|exists:users,id',
            'idCoursDappuie' => 'required|uuid|exists:coursdappuies,id',
            'idSites' => 'nullable|uuid|exists:sites,id',
            'idClasse' => 'nullable|uuid|exists:classes,id',
        ];
    }
}
