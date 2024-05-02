<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ClasseStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'nom' => ['required', 'max:255', 'string'],
            //'effectif' => ['required', 'max:255', 'string'],
            'niveau' => ['required', 'max:255', 'string'],
            'filiere_id' => ['required', 'exists:filieres,id', 'max:255', 'string'],
            'cycle_id' => ['required', 'exists:cycles,id', 'max:255', 'string'],
        ];
    }
}
