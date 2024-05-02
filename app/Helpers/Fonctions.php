<?php

use App\Models\Ufr;
use App\Models\Classe;
use App\Models\Contrat;
use App\Models\Annee;
use App\Models\Cahier;
use App\Models\Cours;
use App\Models\Cycle;
use App\Models\Departement;
use App\Models\Ue;
use App\Models\Ecue;
use App\Models\User;
use App\Models\Enseignant;
use App\Models\Programmation;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;


function showEtat($etat)
{
    if ($etat == 0) {
        return "Programmé";
    } else if ($etat == 1) {
        return "En cours";
    } else if ($etat == 2) {
        return "Terminé";
    } else if ($etat == 3) {
        return "Payé";
    } else {
        return "Inconnu";
    }
}
function getUfr()
{
    $user = Auth::user();
    if ($user->hasRole('Administrateur')) {
        return Ufr::find(session()->get('UFR_ID'));
    } else if (!$user->hasRole('Responsable')) {
        return Ufr::find($user->ufr_id);
    } else {
        return null;
    }
}

function getClasse()
{
    $user = Auth::user();
    if ($user->hasRole('Responsable')) {
        return Classe::find($user->classe_id);
    } else {
        return Classe::find(session()->get('CLASSE_ID'));
    }
}

function getAnnee()
{
    if (session()->has('ANNEE_ID')) {
        $annee = Annee::find(session()->get('ANNEE_ID'));
    } else {
        $annee = Annee::orderBy('id', 'desc')->first();
        session()->put('ANNEE_ID', $annee ? $annee->id : null);
    }
    return $annee;
}

function getLastAnnee()
{
    $annee = Annee::orderBy('id', 'desc')->first();
    return $annee;
}

function archive()
{
    $annees = Annee::where('id', '<>', getLastAnnee()->id)->orderBy('nom', 'desc')->get();
    return $annees;
}

function getSemestre($niveau)
{
    $debut = 1 + 2 * ($niveau - 1);
    return array($debut, $debut + 1);
}

function getCoursByClasseBySemestre($classe_id, $semestre)
{
    $params = ['classe_id' => $classe_id, 'semestre' => $semestre];
    return Cours::where($params)->get();
}

function getProgrammationByClasseBySemestre($classe_id, $semestre)
{
    $params = ['classe_id' => $classe_id, 'semestre' => $semestre, 'annee_id' => getAnnee()->id];
    return Programmation::where($params)->get();
}

function getEcueByClasseBySemestre($classe_id, $semestre)
{
    $cours = DB::select("SELECT programmations.id, ue_id, code_ue, ecue1 as ecue_id, code_ecue1 as code_ecue, heure_theorique1 as heure_theorique, heure_execute1 as heure_execute, etat1 as etat, date_debut1 as date_debut, date_fin1 as date_fin from programmations where ecue1 is not null and classe_id=" . $classe_id . " and semestre=". $semestre ." and annee_id=". getAnnee()->id ."
                         UNION
                         SELECT programmations.id, ue_id, code_ue, ecue2 as ecue_id, code_ecue1 as code_ecue, heure_theorique2 as heure_theorique, heure_execute2 as heure_execute, etat2 as etat, date_debut2 as date_debut, date_fin2 as date_fin from programmations where ecue2 is not null and classe_id=" . $classe_id . " and semestre=". $semestre ." and annee_id=". getAnnee()->id);
   return $cours;
}

function getEcueByClasse($classe_id)
{
    $cours = DB::select("SELECT programmations.id, ue_id, code_ue, ecue1 as ecue_id, code_ecue1 as code_ecue, heure_theorique1 as heure_theorique, heure_execute1 as heure_execute, etat1 as etat, date_debut1 as date_debut, date_fin1 as date_fin from programmations where ecue1 is not null and classe_id=" . $classe_id  . " and annee_id=" . getAnnee()->id . "
                         UNION
                         SELECT programmations.id, ue_id, code_ue, ecue2 as ecue_id, code_ecue2 as code_ecue, heure_theorique2 as heure_theorique, heure_execute2 as heure_execute, etat2 as etat, date_debut2 as date_debut, date_fin2 as date_fin from programmations where ecue2 is not null and classe_id=" . $classe_id  . " and annee_id=" . getAnnee()->id);
    return $cours;
}

function getEcueTermineByClasseBySemestre($classe_id, $semestre)
{
    $cours = DB::select("SELECT ue_id, code_ue, ecue1 as ecue_id, code_ecue1 as code_ecue, heure_theorique1 as heure_theorique, heure_execute1 as heure_execute, etat1 as etat, date_debut1 as date_debut, date_fin1 as date_fin from programmations where etat1=2 and classe_id=" . $classe_id . " and semestre=" . $semestre . " and annee_id=" . getAnnee()->id . "
                         UNION
                         SELECT ue_id, code_ue, ecue2 as ecue_id, code_ecue2 as code_ecue, heure_theorique2 as heure_theorique, heure_execute2 as heure_execute, etat2 as etat, date_debut2 as date_debut, date_fin2 as date_fin from programmations where etat2=2 and  classe_id=" . $classe_id . " and semestre=" . $semestre . " and annee_id=" . getAnnee()->id);
    return $cours;
}

function getEnseignantsByUfr($ufr_id)
{
    $enseignants = DB::table('enseignants')
        ->join('exercer', 'enseignants.id', '=', 'exercer.enseignant_id')
        ->where('exercer.ufr_id', '=', $ufr_id)
        ->get();
    return $enseignants;
}

function getContratByUfr($ufr_id)
{
    $contrats = Contrat::with('enseignant.exercer')
        ->whereHas('enseignant.exercer', function ($query) use ($ufr_id) {
            $query->where('ufr_id', $ufr_id)
                ->where('annee_id', getAnnee()->id);
        })
        ->get();
    return $contrats;
}

function getContratByUfrByEnseignant($ufr_id, $enseignant_id)
{
    $contrats = Contrat::with('enseignant.exercer')
        ->whereHas('enseignant.exercer', function ($query) use ($ufr_id, $enseignant_id) {
            $query->where('ufr_id', $ufr_id)
                ->where('enseignant_id', $enseignant_id)
                ->where('annee_id', getAnnee()->id);
        })
        ->get();
    return $contrats;
}

function resumeCours($cours)
{
    $resume = [
        'heures_theoriques' => 0,
        'details' => [],
    ];

    foreach ($cours as $cycle) {
        if (!empty($cycle) && is_array($cycle)) {
            foreach ($cycle as $item) {
                if (isset($item->heure_theorique) && is_numeric($item->heure_theorique)) {
                    $resume['heures_theoriques'] += $item->heure_theorique;
                    $resume['details'][] = [
                        'cours_id' => $item->cours_id,
                        'ue_id' => $item->ue_id,
                        'ecue_id' => $item->ecue_id,
                        'contrat_id' => $item->contrat_id,
                        'classe_id' => $item->classe_id,
                        'semestre' => $item->semestre,
                        'montant' => $item->montant,
                        'heure_theorique' => $item->heure_theorique,
                        'heure_execute' => $item->heure_execute,
                        'etat' => $item->etat,
                        'date_debut' => $item->date_debut,
                        'date_fin' => $item->date_fin,
                    ];
                }
            }
        }
    }

    return $resume;
}


function getCoursByContrat($contrat_id)
{
    $cours = DB::select("SELECT ue_id, ecue1 as ecue_id, contrat1_id as contrat_id, classe_id, semestre, montant, heure_theorique1 as heure_theorique, heure_execute1 as heure_execute, etat1 as etat, date_debut1 as date_debut, date_fin1 as date_fin from programmations where contrat1_id=" . $contrat_id . "
                        UNION
                        SELECT ue_id, ecue2 as ecue_id, contrat2_id as contrat_id, classe_id, semestre, montant, heure_theorique2 as heure_theorique, heure_execute2 as heure_execute, etat2 as etat, date_debut2 as date_debut, date_fin2 as date_fin from programmations where contrat2_id=" . $contrat_id);
    return $cours;
}
function getCoursByEnseignantByCycleByUfr($enseignant_id, $cycle_id, $ufr_id)
{
    $cours = DB::select("SELECT programmations.id as cours_id, ue_id, ecue1 as ecue_id, contrat1_id as contrat_id, classe_id, semestre, montant, heure_theorique1 as heure_theorique, heure_execute1 as heure_execute, etat1 as etat, date_debut1 as date_debut, date_fin1 as date_fin from programmations, classes, filieres, departements where programmations.classe_id = classes.id  and classes.filiere_id = filieres.id and filieres.departement_id = departements.id AND date_debut1 IS NOT NULL AND date_fin1 IS NOT NULL AND enseignant1=" . $enseignant_id . " and cycle_id=" . $cycle_id . " and annee_id=" . getAnnee()->id . " and departements.ufr_id=" . $ufr_id . "
                        UNION
                       SELECT programmations.id as cours_id, ue_id, ecue2 as ecue_id, contrat2_id as contrat_id, classe_id, semestre, montant, heure_theorique2 as heure_theorique, heure_execute2 as heure_execute, etat2 as etat, date_debut2 as date_debut, date_fin2 as date_fin from programmations, classes, filieres, departements where programmations.classe_id = classes.id and classes.filiere_id = filieres.id and filieres.departement_id = departements.id AND date_debut2 IS NOT NULL AND date_fin2 IS NOT NULL AND enseignant2=" . $enseignant_id . " and cycle_id=" . $cycle_id .  " and annee_id=" . getAnnee()->id . " and departements.ufr_id=" . $ufr_id);
    return $cours;
}


function nombreCoursSansContratByCycleByUfr($enseignant_id, $cycle_id, $ufr_id)
{
    $nombre = 0;
    foreach (getCoursByEnseignantByCycleByUfr($enseignant_id, $cycle_id, $ufr_id) as $cours) {
        if ($cours->contrat_id === null) {
            $nombre += 1;
        }
    }
    return $nombre;
}

function nombreCoursSansContratByUfr($enseignant_id, $ufr_id)
{
    $nombre = 0;
    foreach (Cycle::get() as $cycle) {
        $nombre += nombreCoursSansContratByCycleByUfr($enseignant_id, $cycle->id, $ufr_id);
    }
    return $nombre;
}

function getTotalHeureByEnseignantByCycleByUfr($enseignant_id, $cycle_id, $ufr_id)
{
    $total_heure_theorique = 0;

    foreach (getCoursByEnseignantByCycleByUfr($enseignant_id, $cycle_id, $ufr_id) as $cours) {
        $total_heure_theorique += $cours->heure_theorique;
    }
    return $total_heure_theorique;
}

function getTotalHeureByContrat($contrat_id)
{
    $total_heure_theorique = 0;

    foreach (getCoursByContrat($contrat_id) as $cours) {
        $total_heure_theorique += $cours->heure_theorique;
    }
    return $total_heure_theorique;
}

function nombreCoursByEnseignantByUfr($enseignant_id, $ufr_id)
{
    $nombre = 0;
    foreach (Cycle::get() as $cycle) {
        $nombre += count(getCoursByEnseignantByCycleByUfr($enseignant_id, $cycle->id, $ufr_id));
    }
    return $nombre;
}

function rechercherUe($val)
{
    $ue = Ue::find($val);
    if ($ue) {
        return $ue;
    } else {
        $ue = Ue::create([
            'nom' => $val
        ]);
        return $ue;
    }
}

function rechercherEcue($val)
{
    $ecue = Ecue::find($val);
    if ($ecue) {
        return $ecue;
    } else {
        $ecue = Ecue::create([
            'nom' => $val
        ]);
        return $ecue;
    }
}

function rechercherEnseignant($val)
{
    return Enseignant::find($val);
}

function rechercherClasse($val)
{
    return Classe::find($val);
}

function isTransmis($departement_id)
{
    $programmations = DB::select("Select programmations.*
                    FROM programmations
                    INNER JOIN classes ON programmations.classe_id = classes.id
                    INNER JOIN filieres ON classes.filiere_id = filieres.id
                    WHERE programmations.annee_id=" . getAnnee()->id . "
                    AND filieres.departement_id=" . $departement_id . "
                    ");
    if (count($programmations) > 0) {
        return true;
    } else {
        return false;
    }
}

function getStatus($etat, $date)
{
    if ($etat == 0) {
        return "Non programmé";
    } else if ($etat == 1) {
        return "Programmé";
    } else if ($etat == 2) {
        return "Terminé";
    }
}

function getStatusColor($etat, $date)
{
    if ($etat == 0) {
        return "danger";
    } else if ($etat == 1) {
        return "warning";
    } else if ($etat == 2) {
        return "success";
    }
}

function encryptid($id)
{
    if ($id) {
        $key = "@EC0ntr@T@2024$";
        $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($id, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
        $ciphertext = base64_encode($iv . $hmac . $ciphertext_raw);
        return $ciphertext;
    } else {
        return null;
    }
}

function decryptid($id)
{
    if ($id) {
        $key = "@EC0ntr@T@2024$";
        $c = base64_decode($id);
        $ivlen = openssl_cipher_iv_length($cipher = "AES-128-CBC");
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len = 32);
        $ciphertext_raw = substr($c, $ivlen + $sha2len);
        $original_plaintext = openssl_decrypt($ciphertext_raw, $cipher, $key, $options = OPENSSL_RAW_DATA, $iv);
        $calcmac = hash_hmac('sha256', $ciphertext_raw, $key, $as_binary = true);
        if (hash_equals($hmac, $calcmac)) // timing attack safe comparison
        {
            return $original_plaintext;
        } else {
            return null;
        }
    } else {
        return null;
    }
}

function tronque($chaine, $max)
{
    // Nombre de caractère
    if (strlen($chaine) >= $max) {
        // Met la portion de chaine dans $chaine
        $chaine = substr($chaine, 0, $max);
        // position du dernier espace
        $espace = strrpos($chaine, " ");
        // test si il ya un espace
        if ($espace)
            // si ya 1 espace, coupe de nouveau la chaine
            $chaine = substr($chaine, 0, $espace);
        // Ajoute ... à la chaine
        $chaine .= '...';
    }
    return $chaine;
}


function arrondir_nombre($nombre)
{
    // Si le nombre est un entier, le retourner tel quel
    if (is_int($nombre)) {
        return $nombre;
    }
    // Si le nombre contient une virgule, arrondir à deux chiffres après la virgule
    if (strpos($nombre, '.') !== false) {
        return number_format(round($nombre, 2), 2, ',', ' ');
    }
    // Sinon, retourner le nombre tel quel
    return $nombre;
}

function dureeCours($heure1, $heure2)
{
    $heure1 = strtotime($heure1);
    $heure2 = strtotime($heure2);

    $diff_seconds = abs($heure2 - $heure1); // Calcul de la différence en secondes

    // Conversion de la différence de temps en heures décimales
    $hours = floor($diff_seconds / 3600); // 3600 secondes dans une heure
    $minutes = ($diff_seconds % 3600) / 60; // Reste des secondes converties en minutes
    $decimal_time = $hours + ($minutes / 60); // Convertir les minutes en heures décimales

    return $decimal_time;
}

function heureExecute($programmation_id, $ecue_id)
{
    $params = ['programmation_id' => $programmation_id, 'ecue_id' => $ecue_id];
    $cumul = Cahier::where($params)->sum('duree');
    return $cumul;
}
function getEtatCours($programmation_id, $ecue_id)
{
    $cours = Programmation::find($programmation_id);
    if ($cours->ecue1 == $ecue_id) {
        return $cours->etat1;
    } else {
        return $cours->etat2;
    }
}
function checkEtatCours($programmation_id, $ecue_id)
{
    $cours = Programmation::find($programmation_id);
    $params = ['programmation_id' => $programmation_id, 'ecue_id' => $ecue_id];
    $cumul = Cahier::where($params)->sum('duree');
    if ($cours->ecue1 == $ecue_id) {
        if ($cumul >= $cours->heure_theorique1) {
            $cours->etat1 = 2;
            $cours->date_debut1 = Cahier::where($params)->min('date');
            $cours->date_fin1 = Cahier::where($params)->max('date');
        } else if ($cumul > 0) {
            $cours->etat1 = 1;
            $cours->date_debut1 = Cahier::where($params)->min('date');
            $cours->date_fin1 = Cahier::where($params)->max('date');
        } else {
            $cours->etat1 = 0;
        }
    } else if ($cours->ecue2 == $ecue_id) {
        if ($cumul >= $cours->heure_theorique2) {
            $cours->etat2 = 2;
            $cours->date_debut2 = Cahier::where($params)->min('date');
            $cours->date_fin2 = Cahier::where($params)->max('date');
        } else if ($cumul > 0) {
            $cours->etat2 = 1;
            $cours->date_debut2 = Cahier::where($params)->min('date');
            $cours->date_fin2 = Cahier::where($params)->max('date');
        } else {
            $cours->etat1 = 0;
        }
    }
    $cours->save();
}

function getCD($departement_id)
{
    return User::where('departement_id', $departement_id)->first();
}

function getClasseByDepartement($departement_id)
{
    $classes = Classe::with('filiere')
        ->whereHas('filiere', function ($query) use ($departement_id) {
            $query->where('departement_id', $departement_id);
        })
        ->get();
    return $classes;
}

function getClasseByDepartementByCycle($departement_id, $cycle_id)
{
    $classes = Classe::with('filiere')
        ->whereHas('filiere', function ($query) use ($departement_id, $cycle_id) {
            $query->where('departement_id', $departement_id)->where('cycle_id', $cycle_id)->orderBy('filiere_id', 'asc');
        })
        ->get();
    return $classes;
}

function formaterDate($date)
{
    return Carbon::createFromFormat('Y-m-d', $date)->locale('fr-FR')->isoFormat('DD MMMM YYYY');
}
