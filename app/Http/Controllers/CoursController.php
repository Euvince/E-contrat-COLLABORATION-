<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Classe;
use App\Models\Ufr;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CoursStoreRequest;
use App\Http\Requests\CoursUpdateRequest;
use App\Models\Cours;
use App\Models\Ecue;
use App\Models\Programmation;
use App\Models\Ue;

class CoursController extends Controller
{
    public function index(Request $request): View
    {
        $user = Auth::user();
        $departement = $user->departement;

        $classes = Classe::with('filiere')->whereHas('filiere', function ($query) use ($departement) {
                $query->where('departement_id', $departement->id);
            })->get();

        return view('cours.index', compact('classes','departement'));
    }
    public function show(Classe $classe): View
    {
        return view('cours.show', compact('classe'));
    }

    public function copier(Request $request): RedirectResponse
    {
        $classe = Classe::find($request->classe);
        $source = $request->source_classe;

        if ($classe && $source) {
            DB::table('cours')->where('classe_id', $classe->id)->delete();
            $cours= Cours::where('classe_id', $source)->get();
            foreach ($cours as $c) {
                $new = new Cours();
                $new->classe_id=$classe->id;
                $new->ue_id=$c->ue_id;
                $new->semestre=$c->semestre;
                $new->credit=$c->credit;
                $new->code_ue=$c->code_ue;
                $new->ecue1=$c->ecue1;
                $new->code_ecue1=$c->code_ecue1;
                $new->enseignant1=$c->enseignant1;
                $new->heure_theorique1=$c->heure_theorique1;
                $new->ecue2=$c->ecue2;
                $new->code_ecue2=$c->code_ecue2;
                $new->enseignant2=$c->enseignant2;
                $new->heure_theorique2=$c->heure_theorique2;
                $new->save();
            }
            notyf()->addSuccess('Table de spécification copiée avec succès.');
            return redirect()->route('cours.edit',['classe'=> $classe->slug]);
        }else{
            notyf()->addError("Une erreur s'est produite. Veuillez réessayer");
            return redirect()->route('cours.edit',['classe'=> $classe->slug]);
        }
    }

    public function store(Request $request): RedirectResponse
    {
        $classe=Classe::find($request->classe);
        if($classe){
            //DB::table('cours')->where('classe_id', $classe->id)->delete();
            Cours::whereClasseId($classe->id)->delete();
            $semestres=getSemestre($classe->niveau);
            foreach($semestres as $semestre){
                /*\request()->validate([
                    'programmation'.$semestre => 'required|array',
                    'programmation'.$semestre.'.*.code_ue' => 'required',
                    'programmation'.$semestre.'.*.ue' => 'integer|exists:ues,id',
                    'programmation'.$semestre.'.*.credit' => 'integer',
                    'programmation'.$semestre.'.*.masse1' => 'integer',
                    'programmation'.$semestre.'.*.enseignant1' => 'integer|nullable',
                    'programmation'.$semestre.'.*.enseignant2' => 'integer|nullable',
                    'programmation'.$semestre.'.*.ecue1' => 'integer|exists:ecues,id',
                    'programmation'.$semestre.'.*.ecue2' => 'integer|exists:ecues,id|nullable',
                    'programmation'.$semestre.'.*.code_ecue1' => 'required',
                    'programmation'.$semestre.'.*.code_ecue2' => 'required',
                    'programmation'.$semestre.'.*.masse2' => 'integer|nullable',
                ]);*/
                $programmations = $request->get('programmation'.$semestre);
                foreach($programmations as $programmation){
                    if($programmation['ue']){
                        $ue = rechercherUe($programmation['ue']);
                        $cours=new Cours();
                        $cours->classe_id=$classe->id;
                        $cours->ue_id=$ue->id;
                        $cours->semestre=$semestre;
                        $cours->credit=$programmation['credit'];
                        $cours->code_ue=$programmation['code_ue'];
                        if($programmation['ecue1']){
                            $ecue1 = rechercherEcue($programmation['ecue1']);
                            $cours->ecue1=$ecue1->id;
                            $cours->enseignant1=$programmation['enseignant1'];
                            $cours->heure_theorique1=$programmation['masse1'];
                            $cours->code_ecue1=$programmation['code_ecue1'];
                        }
                        if($programmation['ecue2']){
                            $ecue2 = rechercherEcue($programmation['ecue2']);
                            $cours->ecue2=$ecue2->id;
                            $cours->enseignant2=$programmation['enseignant2'];
                            $cours->heure_theorique2=$programmation['masse2'];
                            $cours->code_ecue2=$programmation['code_ecue2'];
                        }

                        $cours->save();
                    }
                }
            }
        }
        notyf()->addSuccess('Table de spécification créée avec succès.');
        return redirect()->route('cours.index');
    }

    public function edit(Classe $classe): View
    {
        $user = Auth::user();
        $departement = $user->departement;

        $classes = Classe::with('filiere')->whereHas('filiere', function ($query) use ($departement) {
                $query->where('departement_id', $departement->id);
            })->get();

        $ues = Ue::get();
        $ecues=Ecue::get();
        return view('cours.edit', compact('classe','ues','ecues','classes'));
    }

    public function transmettre(): View
    {
        $user = Auth::user();
        $departement = $user->departement;

        $classes = Classe::with('filiere')->whereHas('filiere', function ($query) use ($departement) {
                $query->where('departement_id', $departement->id);
            })->get();

        return view('cours.transmettre', compact('classes','departement'));
    }

    public function post_transmettre(): RedirectResponse
    {
        $user = Auth::user();
        $departement = $user->departement;
        //Supprimer toutes les anciennes programmations
        DB::select("DELETE programmations
                    FROM programmations
                    INNER JOIN classes ON programmations.classe_id = classes.id
                    INNER JOIN filieres ON classes.filiere_id = filieres.id
                    WHERE programmations.annee_id=".getAnnee()->id."
                    AND filieres.departement_id=".$departement->id."
                    ");
        $cours = Cours::with('classe.filiere')->whereHas('classe.filiere', function ($query) use ($departement) {
            $query->where('departement_id', $departement->id);
        })->get();

        foreach ($cours as $c) {
            $new = new Programmation();
            $new->annee_id=getAnnee()->id;
            $new->classe_id=$c->classe_id;
            $new->ue_id=$c->ue_id;
            $new->semestre=$c->semestre;
            $new->credit=$c->credit;
            $new->code_ue=$c->code_ue;
            $new->ecue1=$c->ecue1;
            $new->enseignant1=$c->enseignant1;
            $new->heure_theorique1=$c->heure_theorique1;
            $new->ecue2=$c->ecue2;
            $new->code_ecue1=$c->code_ecue1;
            $new->code_ecue2=$c->code_ecue2;
            $new->enseignant2=$c->enseignant2;
            $new->heure_theorique2=$c->heure_theorique2;
            $new->ufr_id=$user->ufr_id;
            $new->save();
        }

        notyf()->addSuccess('Tables de spécification transmis avec succès.');
        return redirect()->route('cours.transmettre');
    }
}
