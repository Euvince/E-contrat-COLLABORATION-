<?php

namespace Database\Seeders;

use App\Models\Ufr;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UfrSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ufrs = [
            // Université d'Abomey-Calavi
            [
                'code' => 'ENEAM',
                'nom' => "Ecole Nationale d'Economie Appliquée et de Management",
                'logo' => '',
                'universite_id' => 1,
            ],
            [
                'code' => 'EPAC',
                'nom' => "Ecole Polytechnique d'Abomey-Calavi",
                'universite_id' => 1,
            ],
            [
                'code' => 'FSA',
                'nom' => "Faculté des Sciences Agronomiques",
                'universite_id' => 1,
            ],
            [
                'code' => 'FSS',
                'nom' => "Faculté des Sciences de la Santé",
                'universite_id' => 1,
            ],
            [
                'code' => 'ENAM',
                'nom' => "Ecole Nationale d'Administration et de Magistrature",
                'universite_id' => 1,
            ],
            [
                'code' => 'ENSTIC',
                'nom' => "Ecole Nationale des Sciences et Techniques de l'Information et de la
                Communication",
                'universite_id' => 1,
            ],
            [
                'code' => 'INMeS',
                'nom' => "Institut National Médico-Sanitaire",
                'universite_id' => 1,
            ],
            [
                'code' => 'INE',
                'nom' => "Institut National de l'Eau",
                'universite_id' => 1,
            ],
            [
                'code' => 'IFRI',
                'nom' => "Institut de Formation et de Recherche en Informatique",
                'universite_id' => 1,
            ],
            [
                'code' => 'INJEPS',
                'nom' => "Institut National de la Jeunesse, de l'Education Physique et du Sport",
                'universite_id' => 1,
            ],
            [
                'code' => 'HERCI',
                'nom' => "Haute Ecole Régionale de Commerce International",
                'universite_id' => 1,
            ],
            [
                'code' => 'ENS-UAC',
                'nom' => "Ecole Normale Supérieure",
                'universite_id' => 1,
            ],
            [
                'code' => 'CIFRED',
                'nom' => "Centre inter-facultaire de Formation et de Recherche en environnement pour le Développement durable",
                'universite_id' => 1,
            ],
            [
                'code' => 'CEFORP',
                'nom' => "Centre de Formation et de Recherche en matière de Population",
                'universite_id' => 1,
            ],
            [
                'code' => 'IGATE',
                'nom' => "Institut de Géographie de l'Aménagement du Territoire et de l'Environnement",
                'universite_id' => 1,
            ],
            [
                'code' => 'IMSP',
                'nom' => "Institut de Mathématiques et de Sciences Physiques",
                'universite_id' => 1,
            ],
            [
                'code' => 'EUSCE',
                'nom' => "Ecole Universitaire pour la Standardisation des Connaissances Endogènes",
                'universite_id' => 1,
            ],
            [
                'code' => 'ESHCE',
                'nom' => "Ecole des Sciences de l'Homme et des Civilisations Etrangères",
                'universite_id' => 1,
            ],
            [
                'code' => 'ISA',
                'nom' => "Institut de Sociologie et d'Anthropologie",
                'universite_id' => 1,
            ],
            [
                'code' => 'IPSE',
                'nom' => "Institut de Psychologie et des Sciences de l'Education",
                'universite_id' => 1,
            ],
            [
                'code' => 'INMAAC',
                'nom' => "Institut National des Métiers d'Art, d'Archéologie et de la Culture",
                'universite_id' => 1,
            ],
            [
                'code' => 'FADESP',
                'nom' => "Faculté de Droit et Sciences Politiques",
                'universite_id' => 1,
            ],
            [
                'code' => 'FASEG-UAC',
                'nom' => "Faculté des Sciences Economiques et de Gestion",
                'universite_id' => 1,
            ],
            [
                'code' => 'FAST-UAC',
                'nom' => "Faculté des Sciences et Techniques",
                'universite_id' => 1,
            ],
            [
                'code' => 'FASHS',
                'nom' => "Faculté des Sciences Humaines et Sociales",
                'universite_id' => 1,
            ],
            [
                'code' => 'FLLAC',
                'nom' => "Faculté des Lettres Langues Arts et Communication",
                'universite_id' => 1,
            ],
            [
                'code' => 'ILACI',
                'nom' => "Institut de Langue Arabe et Culture Islamique",
                'universite_id' => 1,
            ],
            [
                'code' => 'CIPMA',
                'nom' => "Chaire Internationale en Physique, Mathématique et Application",
                'universite_id' => 1,
            ],
            [
                'code' => 'IRSP',
                'nom' => "Institut Régional de Santé Publique",
                'universite_id' => 1,
            ],
            [
                'code' => 'CONFICIUS',
                'nom' => "Institut Confucius",
                'universite_id' => 1,
            ],
            [
                'code' => 'FOADel-UVA',
                'nom' => "Centre de Formation ouverte et à distance en ligne de l'Université virtuelle africaine",
                'universite_id' => 1,
            ],
            [
                'code' => 'CEBELAE',
                'nom' => "Centre Béninois des Langues Etrangères",
                'universite_id' => 1,
            ],


            // Université de Parakou
            [
                'code' => 'FA',
                'nom' => "Faculté d'Agronomie",
                'universite_id' => 2,
            ],
            [
                'code' => 'FM',
                'nom' => "Faculté de Médecine",
                'universite_id' => 2,
            ],
            [
                'code' => 'ENATSE',
                'nom' => "Ecole Nationale de formation des Techniciens Supérieurs en Santé Publique et Surveillance Epidémiologique",
                'universite_id' => 2,
            ],
            [
                'code' => 'IUT-UP',
                'nom' => "Institut Universitaire de Technologie",
                'universite_id' => 2,
            ],
            [
                'code' => 'ENSPD',
                'nom' => "Ecole Nationale de Statistique, de Planification et de Démographie",
                'universite_id' => 2,
            ],
            [
                'code' => 'IFSIO',
                'nom' => "Institut de Formation en Soins Infirmiers et Obstétricaux",
                'universite_id' => 2,
            ],
            [
                'code' => 'FDSP',
                'nom' => "Faculté de Droit et de Sciences Politiques",
                'universite_id' => 2,
            ],
            [
                'code' => 'FASEG-UP',
                'nom' => "Faculté des Sciences Economiques et de Gestion",
                'universite_id' => 2,
            ],
            [
                'code' => 'FLASH-UAC',
                'nom' => "Faculté des Lettres Arts et Sciences Humaines",
                'universite_id' => 2,
            ],

            // Université Nationale d'Agriculture

            [
                'code' => 'EHAEV',
                'nom' => "Ecole d'Horticulture et d'Aménagement des Espaces Verts",
                'universite_id' => 4,
            ],
            [
                'code' => 'EGPVS',
                'nom' => "Ecole de Gestion et de Production Végétale et Semencière",
                'universite_id' => 4,
            ],
            [
                'code' => 'EMACoM',
                'nom' => "Ecole de Machinisme Agricole et de Construction Mécanique",
                'universite_id' => 4,
            ],
            [
                'code' => 'ENSTCTPA',
                'nom' => "Ecole Nationale des Sciences et Techniques de Conservation et de
                Transformation des Produits Agricoles",
                'universite_id' => 4,
            ],
            [
                'code' => 'EAQ',
                'nom' => "Ecole d'Aquaculture",
                'universite_id' => 4,
            ],
            [
                'code' => 'EGESE',
                'nom' => "Ecole de Gestion et d'Exploitation des Systèmes d'Elevage",
                'universite_id' => 4,
            ],
            [
                'code' => 'EFIB',
                'nom' => "Ecole de Foresterie et d'Ingénierie du Bois",
                'universite_id' => 4,
            ],
            [
                'code' => 'ESVR',
                'nom' => "Ecole de Sociologie et de Vulgarisation Rurales",
                'universite_id' => 4,
            ],
            [
                'code' => 'EAPA',
                'nom' => "Ecole d'Agrobusiness et de Politique Agricole",
                'universite_id' => 4,
            ],

            // UNSTIM

            [
                'code' => 'ESTBR',
                'nom' => "Ecole des Sciences et Techniques du Bâtiment et de la Route",
                'universite_id' => 3,
            ],
            [
                'code' => 'FAST-UNSTIM',
                'nom' => "Faculté des Sciences et Techniques",
                'universite_id' => 3,
            ],
            [
                'code' => 'ENSET',
                'nom' => "Ecole Normale Supérieure de l'Enseignement Technique",
                'universite_id' => 3,
            ],
            [
                'code' => 'IUT-UNSTIM',
                'nom' => "Institut Universitaire de Technologie",
                'universite_id' => 3,
            ],
            [
                'code' => 'ENS-UNSTIM',
                'nom' => "Ecole Normale Supérieure",
                'universite_id' => 3,
            ],
            [
                'code' => 'INSPEI',
                'nom' => "Institut des Classes Préparatoires aux Etudes d'Ingénieurs",
                'universite_id' => 3,
            ],
        ];

        foreach ($ufrs as $ufr) {
            Ufr::create([
                'code' => $ufr['code'],
                'nom' => $ufr['nom'],
                'universite_id' => $ufr['universite_id'],
                'logo' => Str::lower($ufr['code']) . '.png',
            ]);
        }
    }
}
