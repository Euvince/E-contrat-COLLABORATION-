<?php

namespace Database\Seeders;

use App\Models\Annee;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AnneeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $annees = [
            [
                'nom' => '2023-2024',
                'debut' => "2023-10-01",
                'fin' => "2024-07-31",
            ]
        ];
        foreach ($annees as $annee) {

            Annee::create([
                'nom' => $annee['nom'],
                'debut' => $annee['debut'],
                'fin' => $annee['fin'],
            ]);
        }
    }
}
