<?php

namespace App\Http\Controllers;

use App\Http\Requests\FiliereStoreRequest;
use App\Models\Filiere;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\FiliereUpdateRequest;
use App\Models\Departement;
use Illuminate\Support\Facades\Auth;

class FiliereController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $user = Auth::user();
        if (($user->hasRole('Manager') || $user->hasRole('Ufr')) && !$user->hasRole('Chef de Département')) {
            $departements = Departement::where('ufr_id', $user->ufr_id)->get();
            $filieres = Filiere::with('departement')
                ->whereHas('departement', function ($query) use ($user) {
                    $query->where('ufr_id', $user->ufr_id);
                })
                ->get();
        } elseif ($user->hasRole('Chef de Département')) {
            $departements = Departement::where('id', $user->departement_id)->get();
            $filieres = Filiere::where('departement_id', $user->departement_id)->get();
        } elseif ($user->hasRole('Administrateur')) {
            $departements = Departement::all();
            $filieres = Filiere::get();
        } else {
            $departements = null;
            $filieres = [];
        }


        return view('filieres.index', compact('filieres', 'departements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $departements = Departement::all();
        $filieres = Filiere::get();
        return view(
            'filieres.create',
            compact('filieres', 'departements')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FiliereStoreRequest $request): RedirectResponse
    {
        // $this->authorize('create', Banque::class);

        $validated = $request->validated();

        $filiere = Filiere::create($validated);
        notyf()->addSuccess('Filière créée avec success.');
        return redirect()->route('filieres.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Filiere $filiere): View
    {
        return view('filieres.show', compact('filiere'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Filiere $filiere): View
    {
        $departements = Departement::all();
        return view(
            'filieres.edit',
            compact('filiere', 'departements')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        FiliereUpdateRequest $request,
        Filiere $filiere
    ): RedirectResponse {
        // $this->authorize('update', $banque);

        $validated = $request->validated();

        $filiere->update($validated);
        notyf()->addSuccess('Filière modifiée avec success.');
        return redirect()
            ->route('filieres.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Filiere $filiere
    ): RedirectResponse {
        // $this->authorize('delete', $banque);

        $filiere->delete();
        notyf()->addSuccess('Filière supprimée avec success.');
        return redirect()
            ->route('filieres.index');
    }
}
