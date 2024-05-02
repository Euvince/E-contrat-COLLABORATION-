<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UniversiteStoreRequest extends FormRequest
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
            'code' => ['required', 'max:255', 'string', 'unique:universites,code'],
            'nom' => ['required', 'max:255', 'string', 'unique:universites,nom'],
            'adresse' => ['max:255', 'string', 'nullable'],
            'telephone' => ['max:255', 'string', 'nullable'],
            'siteweb' => ['max:255', 'url', 'nullable'],
            'email' => ['max:255', 'email', 'nullable', 'unique:universites,email'],
            'recteur' => ['max:255', 'string', 'nullable'],
            'comptable' => ['max:255', 'string', 'nullable'],
            'ville' => ['max:255', 'string', 'nullable'],
            'logo' => ['max:2048', 'image', 'nullable'],
        ];
    }
}
