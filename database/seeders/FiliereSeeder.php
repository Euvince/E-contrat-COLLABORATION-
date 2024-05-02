<?php

namespace Database\Seeders;

use App\Models\Filiere;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FiliereSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $filieres = [
            // Département Informatique

            [
                'code' => 'IG',
                'nom' => "Informatique de Gestion",
                'departement_id' => 1,
            ],
            [
                'code' => 'AIP',
                'nom' => "Analyse Informatique et Programmation",
                'departement_id' => 1,
            ],
            [
                'code' => 'ARI',
                'nom' => "Administration de Réseaux Informatiques",
                'departement_id' => 1,
            ],

            // Département Statistiques

            [
                'code' => 'SDS',
                'nom' => "Statistiques Démographiques et Sociales",
                'departement_id' => 2,
            ],
            [
                'code' => 'SES',
                'nom' => "Statistiques Economiques et Sectorielles",
                'departement_id' => 2,
            ],

            // Département Planification

            [
                'code' => 'PGP',
                'nom' => "Planification et Gestion des Projets",
                'departement_id' => 3,
            ],
            [
                'code' => 'DLR',
                'nom' => "Développement Local et Régional",
                'departement_id' => 3,
            ],
            [
                'code' => 'EGE',
                'nom' => "Economie et Gestion de l'Environnement",
                'departement_id' => 3,
            ],

            // Département Management des Organisations

            [
                'code' => 'GFC',
                'nom' => "Gestion Financière et Comptable",
                'departement_id' => 4,
            ],
            [
                'code' => 'FC',
                'nom' => "Finances et Comptabilité",
                'departement_id' => 4,
            ],
            [
                'code' => 'GC',
                'nom' => "Gestion Commerciale",
                'departement_id' => 4,
            ],
            [
                'code' => 'ACFV',
                'nom' => "Action Commerciale et Force de Vente",
                'departement_id' => 4,
            ],
            [
                'code' => 'CI',
                'nom' => "Commerce International",
                'departement_id' => 4,
            ],
            [
                'code' => 'GBA',
                'nom' => "Gestion des Banques et Assurances",
                'departement_id' => 4,
            ],
            [
                'code' => 'MF',
                'nom' => "Marché Financier",
                'departement_id' => 4,
            ],
            [
                'code' => 'BM',
                'nom' => "Banque et Micro-finance",
                'departement_id' => 4,
            ],
            [
                'code' => 'BA',
                'nom' => "Banque et Assurance",
                'departement_id' => 4,
            ],
            [
                'code' => 'TL',
                'nom' => "Transport et Logistique",
                'departement_id' => 4,
            ],
            [
                'code' => 'TT',
                'nom' => "Transports Terrestres",
                'departement_id' => 4,
            ],
            [
                'code' => 'TA',
                'nom' => "Transports Aéroportuaires",
                'departement_id' => 4,
            ],
            [
                'code' => 'TF',
                'nom' => "Transports Ferroviaires",
                'departement_id' => 4,
            ],
            [
                'code' => 'L',
                'nom' => "Logistiques",
                'departement_id' => 4,
            ],
            [
                'code' => 'GRH',
                'nom' => "Gestion des Ressources Humaines",
                'departement_id' => 4,
            ],
        ];
        foreach ($filieres as $filiere) {

            Filiere::create([
                'code' => $filiere['code'],
                'nom' => $filiere['nom'],
                'departement_id' => $filiere['departement_id'],
            ]);
        }
    }
}
