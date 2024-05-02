<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UfrUpdateRequest extends FormRequest
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
            'code' => ['required', 'max:255', 'string'],
            'nom' => ['required', 'max:255', 'string'],
            'adresse' => ['max:255', 'string','nullable'],
            'telephone' => ['max:255', 'string','nullable'],
            'siteweb' => ['max:255', 'url','nullable'],
            'email' => ['max:255', 'email','nullable'],
            'directeur' => ['max:255', 'string','nullable'],
            'ville' => ['max:255', 'string','nullable'],
            'logo' => ['image','nullable'],
            'universite_id' => ['required', 'exists:universites,id'],
        ];
    }
}
