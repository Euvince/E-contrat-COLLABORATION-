<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class DateRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //date debut <date fin
        if ($attribute === 'date_fin2') {
            if ($value < request()->input('date_debut2')) {
                $fail("La date de fin doit être superieure à la date de debut");
            }
        }

        //date debut <date fin
        if ($attribute === 'date_fin1') {
            if ($value < request()->input('date_debut1')) {
                $fail("La date de fin doit être superieure à la date de debut");
            }
        }


        // heure_debut < heure_fin
        if ($attribute === 'heure_fin1') {
            if ($value < request()->input('heure_debut1')) {
                $fail("L'heure de fin doit être superieure à l'heure de debut");
            }
        }
        if ($attribute === 'heure_fin2') {
            if ($value < request()->input('heure_debut2')) {
                $fail("L'heure de fin doit être superieure à l'heure de debut");
            }
        }

    }
}
