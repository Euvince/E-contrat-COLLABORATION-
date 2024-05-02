<?php

namespace Database\Seeders;

use App\Models\Banque;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BanqueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $banques = [
            [
                'code' => 'BOA',
                'nom' => "BANK OF AFRICA",
            ],
            [
                'code' => 'ATLANTIQUE',
                'nom' => "BANQUE ATLANTIQUE",
            ],
            [
                'code' => 'BSIC',
                'nom' => "BANQUE SAHELO-SAHARIENNE POUR L’INVESTISSEMENT ET LE COMMERCE",
            ],
            [
                'code' => 'NSIA',
                'nom' => "NSIA BANQUE",
            ],
            [
                'code' => 'ECOBANK',
                'nom' => "ECOBANK",
            ],
            [
                'code' => 'ORABANK',
                'nom' => "ORABANK",
            ],
            [
                'code' => 'SGB',
                'nom' => "SOCIETE GENERALE BENIN",
            ],
            [
                'code' => 'UBA',
                'nom' => "UNITED BANK FOR AFRICA",
            ],
            [
                'code' => 'CCEI',
                'nom' => "BANGE BANK ex CCEI BANK",
            ],
            [
                'code' => 'BGFI',
                'nom' => "BGFI BANK",
            ],
            [
                'code' => 'BIIC',
                'nom' => "BANQUE INTERNATIONALE POUR L’INDUSTRIE ET LE COMMERCE ",
            ],
            [
                'code' => 'CORIS',
                'nom' => "CORIS BANK INTERNATIONAL",
            ],
            [
                'code' => 'CBAO',
                'nom' => "CBAO, GROUPE ATTIJARIWAFA BANK",
            ],
            [
                'code' => 'SONIBANK',
                'nom' => "SOCIETE NIGERIENNE DE BANK",
            ],
        ];
        foreach ($banques as $banque) {

            Banque::create([
                'code' => $banque['code'],
                'nom' => $banque['nom'],
            ]);
        }
    }
}
