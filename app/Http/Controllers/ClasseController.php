<?php

namespace App\Http\Controllers;

use App\Http\Requests\ClasseStoreRequest;
use App\Http\Requests\ClasseUpdateRequest;
use App\Models\Cahier;
use App\Models\Classe;
use App\Models\Cycle;
use App\Models\Enseignant;
use App\Models\Filiere;
use App\Models\Ecue;
use App\Models\Programmation;
use Carbon\Carbon;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Support\Facades\Auth;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $cycles = Cycle::all();
        $user = Auth::user();
        if ($user->hasRole('Manager') || $user->hasRole('Ufr')) {
            $classes=Classe::with('filiere.departement')
                ->whereHas('filiere.departement', function ($query) use ($user) {
                    $query->where('ufr_id', $user->ufr_id);
                })
                ->get();
                
        }elseif($user->hasRole('Chef de Département')){
            $classes = getClasseByDepartement($user->departement_id);
        }elseif($user->hasRole('Administrateur')){
            $classes = Classe::all();
        }else{
            $classes = null;
        }

        return view('classes.index', compact('classes', 'cycles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $filieres = Filiere::all();
        $cycles = Cycle::all();
        $class = Classe::get();
        return view(
            'classes.create', compact('class', 'filieres', 'cycles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ClasseStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        //dd($validated);
        $class = Classe::create($validated);

        notyf()->addSuccess('Classe créée avec success.');
        return redirect()->route('classes.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Classe $class): View
    {
        return view('classes.show', compact('class'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Classe $class): View
    {
        $filieres = Filiere::all();
        $cycles = Cycle::all();
        return view(
            'classes.edit',
            compact('class', 'filieres', 'cycles')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ClasseUpdateRequest $request,
        Classe $class
    ): RedirectResponse {
        // $this->authorize('update', $classe);

        $validated = $request->validated();

        $class->update($validated);
        notyf()->addSuccess('Classe modifié avec success.');
        return redirect()
            ->route('classes.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Classe $class
    ): RedirectResponse {
        // $this->authorize('delete', $classe);

        $class->delete();
        notyf()->addSuccess('Classe supprimée avec success.');
        return redirect()
            ->route('classes.index');
    }

    public function cahier(Ecue $ecue=null, Classe $classe=null, $programmation_id=null): View
    {
        $user=Auth::user();
        if($user->hasRole('Responsable')){
            $classe = $user->classe;
        }
        $ecues=getEcueByClasse($classe->id);
        $cahiers=[];
        $cours=null;
        $enseignant=null;
        $masse=null;
        if($ecue && $programmation_id){
            $cours=Programmation::find(decryptid($programmation_id));
            $enseignant= $cours->ecue1==$ecue->id ? Enseignant::find($cours->enseignant1) : Enseignant::find($cours->enseignant2);
            $masse= $cours->ecue1==$ecue->id ? $cours->heure_theorique1 : $cours->heure_theorique1 ;
            $params=['programmation_id' => $cours->id,'ecue_id'=> $ecue->id];
            $cahiers=Cahier::where($params)->orderBy('date','asc')->get();       
        }
        return view('classes.cahier', compact('ecues','classe','cahiers','enseignant','cours', 'masse','ecue'));
    }

    public function cahierCreate(Ecue $ecue,$programmation_id): View
    {
        $programmation = Programmation::find(decryptid($programmation_id));
        return view('classes.cahier_create', compact('ecue','programmation'));
    }

    public function cahierStore(Request $request): RedirectResponse
    { 
        $programmation_id=encryptid($request->programmation_id);
        $ecue=Ecue::find($request->ecue_id); 
        $cahier = new Cahier();
        $cahier->programmation_id = $request->programmation_id;
        $cahier->ecue_id = $request->ecue_id;
        $cahier->date=$request->date ? Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d') : null;
        $cahier->heure_debut = $request->heure_debut ? $request->heure_debut : null;
        $cahier->heure_fin = $request->heure_fin ? $request->heure_fin : null;
        $cahier->duree=dureeCours($request->heure_debut, $request->heure_fin);
        $cahier->libelles = $request->libelles;
        $cahier->save();
        checkEtatCours($request->programmation_id,$request->ecue_id );
        notyf()->addSuccess('Element du cahier de texte ajouté avec success.');
        return redirect()->route('cahier.create',['ecue'=>$ecue, 'programmation_id'=>$programmation_id]);
    }

    public function cahierEdit($cahier_id): View
    {
        $cahier = Cahier::find(decryptid($cahier_id));
        return view('classes.cahier_edit', compact('cahier'));
    }

    public function cahierUpdate(Request $request,$cahier_id): RedirectResponse
    { 
        $cahier=Cahier::find(decryptid($cahier_id)); 
        $cahier->date=$request->date ? Carbon::createFromFormat('d/m/Y', $request->date)->format('Y-m-d') : null;
        $cahier->heure_debut = $request->heure_debut ? $request->heure_debut : null;
        $cahier->heure_fin = $request->heure_fin ? $request->heure_fin : null;
        $cahier->duree=dureeCours($request->heure_debut, $request->heure_fin);
        $cahier->libelles = $request->libelles;
        $cahier->save();
        checkEtatCours($cahier->programmation_id,$cahier->ecue_id );
        notyf()->addSuccess('Element du cahier de texte modifier avec success.');
        return redirect()->route('cahier',['ecue'=>$cahier->ecue, 'programmation_id'=>encryptid($cahier->programmation_id)]);
    }

    public function cahierDestroy($cahier_id): RedirectResponse {
        $cahier=Cahier::find(decryptid($cahier_id)); 
        $cahier->delete();
        checkEtatCours($cahier->programmation_id,$cahier->ecue_id );
        notyf()->addSuccess('Eleément de cahier supprimée avec success.');
        return redirect()->route('cahier',['ecue'=>$cahier->ecue, 'programmation_id'=>encryptid($cahier->programmation_id)]);
    }
    
}
