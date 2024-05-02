<?php

namespace Database\Seeders;

use App\Models\Departement;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DepartementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departements = [
            [
                'code' => 'IG',
                'nom' => "Informatique de Gestion",
                'ufr_id' => 1,
            ],

            [
                'code' => 'STAT',
                'nom' => "Statistiques",
                'ufr_id' => 1,
            ],

            [
                'code' => 'PLAN',
                'nom' => "Planification du Développement",
                'ufr_id' => 1,
            ],

            [
                'code' => 'MO',
                'nom' => "Management des Organisations",
                'ufr_id' => 1,
            ],
        ];
        foreach ($departements as $departement) {

            Departement::create([
                'code' => $departement['code'],
                'nom' => $departement['nom'],
                'ufr_id' => $departement['ufr_id'],
            ]);
        }
    }
}
