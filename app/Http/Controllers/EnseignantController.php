<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreEnseignantRequest;
use App\Http\Requests\UpdateEnseignantRequest;
use App\Models\Banque;
use App\Models\Enseignant;
use App\Models\Exercer;
use App\Models\Grade;
use App\Models\Status;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;

class EnseignantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {


        $user = Auth::user();
        $enseignants = getEnseignantsByUfr($user->ufr_id);
        if ($user->hasRole('Administrateur')) {
            $enseignants = Enseignant::all();
        }


        return view('enseignants.index', compact('enseignants'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $banques = Banque::get();
        $grades = Grade::get();
        $status = Status::get();

        return view(
            'enseignants.create',
            compact('banques', 'grades', 'status')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreEnseignantRequest $request): RedirectResponse
    {
        // $this->authorize('create', Enseignant::class);
        $validated = $request->validated();
        $enseignant = Enseignant::create($validated);
        $user = Auth::user();
        if ($user->hasRole('Manager')) {
            Exercer::create([
                'enseignant_id' => $enseignant->id,
                'ufr_id' => $user->ufr_id
            ]);
        }
        notyf()->addSuccess('Enseignant crée avec success.');
        return redirect()->route('enseignants.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Enseignant $enseignant): View
    {
        // dd($enseignant->grade);
        $grades = Grade::get();
        return view('enseignants.show', compact('enseignant', 'grades'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Enseignant $enseignant): View
    {
        $banques = Banque::get();
        $status = Status::get();
        $grades = Grade::get();

        return view(
            'enseignants.edit',
            compact('enseignant', 'banques', 'grades', 'status')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateEnseignantRequest $request,
        Enseignant              $enseignant
    ): RedirectResponse
    {
        // $this->authorize('update', $enseignant);
        $validated = $request->validated();

        $enseignant->update($validated);
        notyf()->addSuccess('Enseignant modifiée avec success.');
        return redirect()
            ->route('enseignants.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request    $request,
        Enseignant $enseignant
    ): RedirectResponse
    {
        // $this->authorize('delete', $enseignant);

        $enseignant->delete();
        notyf()->addSuccess('Enseignant supprimé avec success.');
        return redirect()
            ->route('enseignants.index');
    }

    public function searchByNpi()
    {
        return view('enseignants.recherche-enseignant.search');
    }

    public function findByNpi(Request $request)
    {
        $enseignant = Enseignant::whereNpi($request->npi)->get()->first();
        if ($enseignant) {
            return redirect()->route('enseignants.edit', $enseignant);
        } else {
            return redirect()->route('enseignants.create');
        }
    }
}
