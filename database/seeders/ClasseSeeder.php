<?php

namespace Database\Seeders;

use App\Models\Classe;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClasseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $classes = [
            [
                'code' => 'IG1-A',
                'nom' => "IG1-A",
                'filiere_id' => 1,
                'cycle_id' => 1,
                'niveau' => 1,
            ],
            [
                'code' => 'IG1-B',
                'nom' => "IG1-B",
                'filiere_id' => 1,
                'cycle_id' => 1,
                'niveau' => 1,
            ],
            [
                'code' => 'IG2-A',
                'nom' => "IG2-A",
                'filiere_id' => 1,
                'cycle_id' => 1,
                'niveau' => 2,
            ],
            [
                'code' => 'IG2-B',
                'nom' => "IG2-B",
                'filiere_id' => 1,
                'cycle_id' => 1,
                'niveau' => 2,
            ],
            [
                'code' => 'IG3-AIP',
                'nom' => "IG3-AIP",
                'filiere_id' => 2,
                'cycle_id' => 1,
                'niveau' => 3,
            ],
            [
                'code' => 'IG3-ARI',
                'nom' => "IG3-ARI",
                'filiere_id' => 3,
                'cycle_id' => 1,
                'niveau' => 3,
            ],
        ];
        foreach ($classes as $classe) {

            Classe::create([
                'code' => $classe['code'],
                'nom' => $classe['nom'],
                'niveau' => $classe['niveau'],
                'filiere_id' => $classe['filiere_id'],
                'cycle_id' => $classe['cycle_id'],
            ]);
        }
    }
}
