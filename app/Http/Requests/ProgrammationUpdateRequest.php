<?php

namespace App\Http\Requests;

use App\Rules\DateRule;
use Illuminate\Foundation\Http\FormRequest;

class ProgrammationUpdateRequest extends FormRequest
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
            'enseignant1' => ['nullable'],
            'date_debut1' => ['nullable ',''],
            'date_fin1' => ['nullable','' ,new DateRule,],
            'heure_debut1' => ['nullable','date_format:H:i' ],
            'heure_fin1' => ['date_format:H:i','nullable',new DateRule,],
            'composition1' => 'date_format:d/m/Y H:i|nullable',
            'salle1' => 'string|nullable',
            'enseignant2' => 'nullable',
            'date_debut2' => [' nullable',''],
            'date_fin2' => ['nullable', '',new DateRule,],
            'heure_debut2' => 'date_format:H:i|nullable',
            'heure_fin2' => ['nullable','date_format:H:i', new DateRule],
            'composition2' => 'date_format:d/m/Y H:i|nullable',
            'salle2' => 'string|nullable',

        ];
    }
}
