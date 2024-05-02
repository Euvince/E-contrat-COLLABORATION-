<?php

namespace Database\Seeders;

use App\Models\Ecue;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class EcueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /* SEMESTRE 1 */

        $ecues = [
            [
                'code' => '1MTH1101',
                'nom' => "Algèbre linéaire",
            ],
            [
                'code' => '2MTH1101',
                'nom' => "Analyse mathématiques",
            ],

            [
                'code' => '1ECO1102',
                'nom' => "Économie générale",
            ],
            [
                'code' => '2ECO1102',
                'nom' => "Économie d'entreprise",
            ],
            [
                'code' => '1CPT1103',
                'nom' => "Cadre conceptuel de la comptabilité",
            ],
            [
                'code' => '2CPT1103',
                'nom' => "Technique et opérations comptables",
            ],
            [
                'code' => '1INF1104',
                'nom' => "Initiaton au système d'exploitation (Windows)",
            ],
            [
                'code' => '2INF1104',
                'nom' => "Bureautique",
            ],
            [
                'code' => '1INF1105',
                'nom' => "Initiation à l'algorithmique",
            ],
            [
                'code' => '1MTH1106',
                'nom' => "Mathématique pour l'informatique",
            ],
            [
                'code' => '1TCC1107',
                'nom' => "Technique de l'expression écrite et orale",
            ],
            [
                'code' => '1MGT1108',
                'nom' => "Initiation à l'entrepreneuriat",
            ],

            /* SEMESTRE 2 */

            [
                'code' => '1MTH1201',
                'nom' => "Algèbre linéaire approfondie",
            ],
            [
                'code' => '2MTH1201',
                'nom' => "Analyse mathématique approfondie",
            ],
            [
                'code' => '1FIN1202',
                'nom' => "Mathématiques financières",
            ],
            [
                'code' => '2FIN1202',
                'nom' => "Analyse financière",
            ],
            [
                'code' => '1CPT1203',
                'nom' => "Théorie de l'information et codage",
            ],
            [
                'code' => '2CPT1203',
                'nom' => "Structure et fonctionnement de l'ordinateur",
            ],
            [
                'code' => '1INF1204',
                'nom' => "Programmation en Python",
            ],
            [
                'code' => '2INF1204',
                'nom' => "Atelier de programmation",
            ],
            [
                'code' => '1INF1205',
                'nom' => "Système Linux",
            ],
            [
                'code' => '1INF1206',
                'nom' => "Principes et outils du web design",
            ],
            [
                'code' => '2INF1206',
                'nom' => "Atelier de web design",
            ],
            [
                'code' => '1ANG1207',
                'nom' => "Anglais général",
            ],
            [
                'code' => '1TCC1208',
                'nom' => "Attitude comportementale",
            ],


            /* SEMESTRE 3 */

            [
                'code' => '1MTH1302',
                'nom' => "Statistique descriptive et Probabilité",
            ],
            [
                'code' => '2MTH1302',
                'nom' => "Statistique inférentielle",
            ],
            [
                'code' => '1CPT1303',
                'nom' => "Comptabilité analytique de gestion",
            ],
            [
                'code' => '2CPT1303',
                'nom' => "Gestion budgétaire et prévisionnelle",
            ],
            [
                'code' => '1INF1301',
                'nom' => "Théorie des bases de données",
            ],
            [
                'code' => '2INF1301',
                'nom' => "Système de gestion de bases de données",
            ],
            [
                'code' => '1INF1304',
                'nom' => "Principal de la maintenance informatique",
            ],
            [
                'code' => '2INF1304',
                'nom' => "Atelier de maintenance informatique",
            ],
            [
                'code' => '1INF1305',
                'nom' => "Structures de données",
            ],
            [
                'code' => '1MGT1506',
                'nom' => "Entrepreneuriat",
            ],
            [
                'code' => '1ROP1307',
                'nom' => "Recherche opérationnelle",
            ],
            [
                'code' => '1TCC1308',
                'nom' => "Rédaction administrative",
            ],

            /* SEMESTRE 4 */

            [
                'code' => '1INF1401',
                'nom' => "Bases des réseaux informatiques",
            ],
            [
                'code' => '2INF1401',
                'nom' => "Atelier des réseaux informatiques",
            ],
            [
                'code' => '1DRV1402',
                'nom' => "Introduction au droit",
            ],
            [
                'code' => '2DRV1402',
                'nom' => "Droit du numérique",
            ],
            [
                'code' => '1INF1403',
                'nom' => "Web dynamique",
            ],
            [
                'code' => '1INF1404',
                'nom' => "Outils d'analyse et de conception orientée objet avec UML",
            ],
            [
                'code' => '2INF1404',
                'nom' => "Projet de synthèse en informatique de gestion",
            ],
            [
                'code' => '1INF1405',
                'nom' => "Stage de programmation",
            ],
            [
                'code' => '1INF1406',
                'nom' => "Interface graphique en Python",
            ],
            [
                'code' => '2INF1406',
                'nom' => "Interactions avec les bases de données en Python",
            ],
            [
                'code' => '1ANG1407',
                'nom' => "Anglais des affaires",
            ],
            [
                'code' => '1TCC1408',
                'nom' => "Attitude comportementale",
            ],


            /*SEMESTRE 5*/

            /*AIP*/

            [
                'code' => '1INF1501',
                'nom' => "Principes de l'administration des bases de données",
            ],
            [
                'code' => '2INF1501',
                'nom' => "Atelier d'administration de bases de données: Oracle",
            ],
            [
                'code' => '1INF1502',
                'nom' => "Représentation des connaissances",
            ],
            [
                'code' => '2INF1502',
                'nom' => "Langage de l'intelligence artificielle",
            ],
            [
                'code' => '1INF1503',
                'nom' => " Principes des systèmes d'exploitation",
            ],
            [
                'code' => '2INF1503',
                'nom' => "Systèmes embarqués et temps réel",
            ],
            [
                'code' => '1INF1504',
                'nom' => " Principes de la programmation en JAVA",
            ],
            [
                'code' => '2INF1504',
                'nom' => "Atelier de programmation en JAVA",
            ],
            [
                'code' => '1INF1505',
                'nom' => "Théorie des langages",
            ],
            [
                'code' => '2INF1505',
                'nom' => "Techniques de compilation",
            ],
            [
                'code' => '1DRV1506',
                'nom' => "Droit des TIC",
            ],
            [
                'code' => '1GES1507',
                'nom' => "Gestion budgétaire",
            ],
            [
                'code' => '2GES1507',
                'nom' => "Gestion prévisionnelle",
            ],
            [
                'code' => '1INF1508',
                'nom' => "Principes et méthodes de la Cryptographie",
            ],
            [
                'code' => '2INF1508',
                'nom' => "Atelier de Sécurité informatique",
            ],
            [
                'code' => '1TCC1509',
                'nom' => "Technique de recherche d'emploi",
            ],
            [
                'code' => '1ANG1510',
                'nom' => "Anglais appliqué à l'informatique",
            ],

            /*ARI*/

            [
                'code' => '1INF1501',
                'nom' => " Principes des systèmes d'exploitation",
            ],
            [
                'code' => '2INF1501',
                'nom' => "Systèmes embarqués et temps réel",
            ],
            [
                'code' => '1INF1502',
                'nom' => "Principes de l'administration des bases de données",
            ],
            [
                'code' => '2INF1502',
                'nom' => "Atelier d'administration de bases de données: Oracle",
            ],
            [
                'code' => '1INF1503',
                'nom' => "Représentation des connaissances",
            ],
            [
                'code' => '2INF1503',
                'nom' => "Langage de l'intelligence artificielle",
            ],
            [
                'code' => '1INF1504',
                'nom' => "Service réseaux sous Windows",
            ],
            [
                'code' => '2INF1504',
                'nom' => "Service réseaux sous Linux",
            ],
            [
                'code' => '1GEL1505',
                'nom' => "Principes et concepts de l'electricité"
            ],
            [
                'code' => '2GEL1505',
                'nom' => "Atelier de mesure électrique",
            ],
            [
                'code' => '1DRV1506',
                'nom' => "Droit des TIC",
            ],
            [
                'code' => '1GES1507',
                'nom' => "Gestion budgétaire",
            ],
            [
                'code' => '2GES1507',
                'nom' => "Gestion prévisionnelle",
            ],
            [
                'code' => '1INF1508',
                'nom' => "Principes et méthodes de la Cryptographie",
            ],
            [
                'code' => '2INF1508',
                'nom' => "Atelier de Sécurité informatique",
            ],
            [
                'code' => '1TCC1509',
                'nom' => "Technique de recherche d'emploi",
            ],
            [
                'code' => '1ANG1510',
                'nom' => "Anglais appliqué à l'informatique",
            ],


            /*SEMESTRE 6*/

            /*AIP*/

            [
                'code' => '1INF1601',
                'nom' => "UML approfondi",
            ],
            [
                'code' => '2INF1601',
                'nom' => "Projet tuteuré",
            ],
            [
                'code' => '1INF1602',
                'nom' => "Ergonomie des applications",
            ],
            [
                'code' => '2INF1602',
                'nom' => "Développement d'applications mobiles",
            ],
            [
                'code' => '1TCC1603',
                'nom' => "Stage",
            ],
            [
                'code' => '2TCC1603',
                'nom' => "Soutenance de mémoire",
            ],
            [
                'code' => '1TCC1604',
                'nom' => "Méthodologie de recherche",
            ],
            [
                'code' => '1TCC1605',
                'nom' => "Attitude comportementale 3",
            ],



             /*ARI*/

            [
                'code' => '1INF1601',
                'nom' => "Electronique analogique",
            ],
            [
                'code' => '2INF1601',
                'nom' => "Electronique numérique",
            ],
            [
                'code' => '1INF1602',
                'nom' => "Commutation, routage, VPN et internet",
            ],
            [
                'code' => '2INF1602',
                'nom' => "Projet de synthèse en réseaux informatiques",
            ],
            [
                'code' => '1INF1603',
                'nom' => "Sécurité des réseaux informatiques",
            ],
            [
                'code' => '1TCC1604',
                'nom' => "Stage",
            ],
            [
                'code' => '2TCC1604',
                'nom' => "Soutenance de mémoire",
            ],
            [
                'code' => '1TCC1605',
                'nom' => "Méthodologie de recherche",
            ],
            [
                'code' => '1TCC1606',
                'nom' => "Attitude comportementale 3",
            ],


        ];
        foreach ($ecues as $ecue) {

            Ecue::create([
                'code' => $ecue['code'],
                'nom' => $ecue['nom'],
            ]);
        }
    }
}
