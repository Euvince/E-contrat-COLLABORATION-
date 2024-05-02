<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Grade;

class GradeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $grades = [
            [
                'code' => 'Aucun',
                'nom' => "Aucun",
            ],
            [
                'code' => 'A',
                'nom' => "Assistant",
            ],
            [
                'code' => 'MA',
                'nom' => "Maître-Assistant",
            ],[
                'code' => 'CR',
                'nom' => "Chargé de Recherche",
            ],
            [
                'code' => 'MC',
                'nom' => "Maître de Conférence",
            ],[
                'code' => 'MR',
                'nom' => "Maître de Recherche",
            ],
            [
                'code' => 'PT',
                'nom' => "Professeur Titulaire",
            ],
            [
                'code' => 'DR',
                'nom' => "Directeur de Recherche",
            ],
        ];
        foreach ($grades as $grade) {

            Grade::create([
                'code' => $grade['code'],
                'nom' => $grade['nom'],
            ]);
        }
    }
}
