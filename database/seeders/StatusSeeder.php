<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $agentPermanent = Status::create([
            'nom' => "Agent Permanent de l'Etat",
        ]);
        $agentContractuel = Status::create([
            'nom' => "Agent Contractuel de l'Etat",
        ]);
        $fonctionnaire = Status::create([
            'nom' => "Fonctionnaire du privé",
        ]);
        $agentConventione = Status::create([
            'nom' => "Agent Conventionné",
        ]);
    }
}
