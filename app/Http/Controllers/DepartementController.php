<?php

namespace App\Http\Controllers;

use App\Models\Enseignant;
use App\Models\Ufr;
use Illuminate\View\View;
use App\Models\Departement;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\DepartementStoreRequest;
use App\Http\Requests\DepartementUpdateRequest;
use Illuminate\Support\Facades\Auth;

class DepartementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $user = Auth::user();
        if ($user->hasRole('Manager') || $user->hasRole('Ufr')) {
            $departements = $user->ufr->departements;
        }else if( $user->hasRole('Administrateur')){
            $departements = Departement::get();
        }else{
            $departements=[];
        }

        return view('departements.index', compact('departements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $ufrs = Ufr::all();
        //$enseignants = Enseignant::all();
        $departements = Departement::get();
        return view(
            'departements.create', compact('departements', 'ufrs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(DepartementStoreRequest $request): RedirectResponse
    {
        $validated = $request->validated();

        $departement = Departement::create($validated);
        notyf()->addSuccess('Département créé avec success.');
        return redirect()->route('departements.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Departement $departement): View
    {
        $departements = Departement::get();
        return view('departements.show', compact('departement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Departement $departement): View
    {
        $ufrs = Ufr::all();
        //$enseignants = Enseignant::all();
        $departements = Departement::get();
        return view(
            'departements.edit',
            compact('departement', 'ufrs')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        DepartementUpdateRequest $request,
        Departement $departement
    ): RedirectResponse {
        // $this->authorize('update', $Departement);

        $validated = $request->validated();

        $departement->update($validated);
        notyf()->addSuccess('Departement modifié avec success.');
        return redirect()
            ->route('departements.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Departement $departement
    ): RedirectResponse {
        // $this->authorize('delete', $Departement);

        $departement->delete();
        notyf()->addSuccess('Departement supprimée avec success.');
        return redirect()
            ->route('departements.index');
    }
}
