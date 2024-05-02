<?php

namespace Database\Seeders;

use App\Models\Cycle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CycleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cycles = [
            [
                'code' => 'L',
                'nom' => "Licence",
                'montant' => 5000,
            ],
            [
                'code' => 'M',
                'nom' => "Master",
                'montant' => 7500,
            ],
            [
                'code' => 'D',
                'nom' => "Doctorat",
                'montant' => 10000,
            ],
        ];
        foreach ($cycles as $cycle) {

            Cycle::create([
                'code' => $cycle['code'],
                'nom' => $cycle['nom'],
                'montant' => $cycle['montant'],
            ]);
        }
    }
}
