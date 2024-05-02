<?php

namespace App\Http\Controllers;

use App\Models\Ufr;
use App\Models\Universite;
use Illuminate\Http\Request;
use App\Models\Banque;
use App\Models\Enseignant;
use App\Models\Grade;

class FrontendController extends Controller
{
    function index(){
        $universites = Universite::take(4)->get();
        $ufrs = Ufr::all();
        return view('frontend.index', ['universites' => $universites, 'ufrs' => $ufrs]);
    }

    function ifu(){
        return view('frontend.inscription.ifu');
    }

    function informations(Request $request){
        $ifu=$request->ifu;
        $enseignant=Enseignant::where('ifu',$ifu)->first();
        $banques = Banque::orderBy('nom')->get();
        $grades = Grade::get();
        return view('frontend.inscription.informations', compact('ifu','enseignant','banques','grades'));
    }

    function confirmation(Request $request){
        $searchKey = [
            'ifu' => $request->ifu,
        ];
        $enseignant=Enseignant::updateOrInsert($searchKey, [
            'civilite' => $request->civilite,
            'nom' => $request->nom,
            'prenoms' => $request->prenoms,
            'ifu' => $request->ifu,
            'npi' => $request->npi,
            'nationalite' => $request->nationalite,
            'profession' => $request->profession,
            'telephone' => $request->telephone,
            'diplome_actuel' => $request->diplome_actuel,
            'specialite_diplome_actuel' => $request->specialite,
            'email' => $request->email,
            'adresse' => $request->adresse,
            'banque_id' => $request->banque_id,
            'grade_id' => $request->grade_id,
            'compte' => $request->compte,
        ]);
        if($enseignant){
            return view('frontend.inscription.merci');
        }else{
            return view('frontend.inscription.error');
        }
    }
}
