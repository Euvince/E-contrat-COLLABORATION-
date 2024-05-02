<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateEnseignantRequest extends FormRequest
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
            'nom' => ['required', 'max:191', 'string'],
            'prenoms' => ['required', 'max:191', 'string'],
            'adresse' => ['required', 'max:191', 'string'],
            'telephone' => ['required', 'max:191', 'string'],
            'civilite' => ['required', 'max:191', 'string'],
            'npi' => ['required', 'max:191', 'string'],
            'banque_id' => ['required', 'max:10', 'integer', 'exists:banques,id'],
            'compte' => ['required', 'max:191', 'string'],
            'ifu' => ['required', 'numeric'],
            'nationalite' => ['required', 'max:191', 'string'],
            'sexe' => ['required', 'max:191', 'string'],
            'email' => ['required', 'max:191', 'string', 'email'],
            'profession' => ['required', 'max:191', 'string'],
            'date_naissance' => ['required', 'date', 'before:today'],
            'slug' => ['max:191', 'string'],
            'lieu_naissance' => ['required', 'max:191', 'string'],
            'structure_origine' => ['required','max:191', 'string'],
            'corps_cames' => ['max:191', 'string'],
            'annee_inscription_cames' => ['string', 'before:today'],
            'premiere_annee_collaboration' => ['string', 'max:'.date('Y')],
            'corps_fonction_publique' => ['required','max:191', 'string'],
            'grade_id' => ['required','max:10'],
            'status_id' => ['required','max:10'],
            'indice' => ['required','max:191', 'string'],
            'nb_enfants' => ['required','integer'],
            'poste_administratif' => ['max:191', 'string'],
            'date_prise_service' => ['date','before:today'],
            'diplome_recrutement' => ['max:191', 'string'],
            'specialite_diplome_recrutement' => ['required', 'max:191', 'string'],
            'diplome_actuel' => ['required','max:191', 'string'],
            'specialite_diplome_actuel' => ['required','max:191', 'string'],
        ];
    }
}
