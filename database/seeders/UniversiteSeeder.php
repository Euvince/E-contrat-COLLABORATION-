<?php

namespace Database\Seeders;

use App\Models\Universite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UniversiteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $universites = [
            [
                'code' => 'UAC',
                'nom' => "Université d'Abomey-Calavi",
                'siteweb' => "https://www.uac.bj/",
                'recteur' => "Félicien Avlessi",
            ],
            [
                'code' => 'UP',
                'nom' => 'Université de Parakou',
                'siteweb' => "http://www.univ-parakou.bj/",
                'recteur' => "Bertrand SOGBOSSI BOCCO",
            ],

            [
                'code' => 'UNSTIM',
                'nom' => "Université Nationale des Sciences, de Techonologies et d'Ingéneurie Mathématique'",
                'siteweb' => "https://www.unstim.bj/",
                'recteur' => "Gérard GBEGAN",
            ],

            [
                'code' => 'UNA',
                'nom' => "Université Nationale d'Agriculture",
                'siteweb' => "https://www.una.bj/",
                'recteur' => "AGOSSOU Bruno Djossa",
            ],
        ];
        foreach ($universites as $universite) {

            Universite::create([
                'code' => $universite['code'],
                'nom' => $universite['nom'],
                'siteweb' => $universite['siteweb'],
                'recteur' => $universite['recteur'],
            ]);
        }
    }
}
