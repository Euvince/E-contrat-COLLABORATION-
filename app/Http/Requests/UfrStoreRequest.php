<?php

namespace App\Http\Requests;

use Illuminate\Support\Str;
use Illuminate\Foundation\Http\FormRequest;

class UfrStoreRequest extends FormRequest
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
            'code' => ['required', 'max:255', 'string','unique:ufrs,code'],
            'nom' => ['required', 'max:255', 'string','unique:ufrs,nom'],
            'adresse' => ['max:255', 'string','nullable'],
            'telephone' => ['max:255', 'string','nullable'],
            'siteweb' => ['max:255', 'url','nullable'],
            'email' => ['max:255', 'email','nullable','unique:ufrs,email'],
            'directeur' => ['max:255', 'string','nullable'],
            'ville' => ['max:255', 'string','nullable'],
            'logo' => ['image','nullable'],
            'universite_id' => ['required', 'exists:universites,id'],
        ];
    }
}
