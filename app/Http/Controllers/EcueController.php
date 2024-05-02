<?php

namespace App\Http\Controllers;

use App\Http\Requests\EcueStoreRequest;
use App\Http\Requests\EcueUpdateRequest;
use App\Models\Ecue;
use App\Models\Ue;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EcueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {

        $ecues = Ecue::get();

        return view('ecues.index', compact('ecues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        return view('ecues.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EcueStoreRequest $request): RedirectResponse
    {
        // $this->authorize('create', Ecue::class);

        $validated = $request->validated();

        $ecues = Ecue::create($validated);
        notyf()->addSuccess('Ecue créée avec success.');
        return redirect()->route('ecues.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Ecue $ecue): View
    {
    
        return view('ecues.show', compact('ecue'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Ecue $ecue): View
    {
        return view(
            'ecues.edit',
            compact('ecue')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        EcueUpdateRequest $request,
        Ecue $ecue
    ): RedirectResponse {
        // $this->authorize('update', $ecue);

        $validated = $request->validated();

        $ecue->update($validated);
        notyf()->addSuccess('Ecue modifiée avec success.');
        return redirect()
            ->route('ecues.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Ecue $ecue
    ): RedirectResponse {
        // $this->authorize('delete', $ecue);

        $ecue->delete();
        notyf()->addSuccess('Ecue supprimée avec success.');
        return redirect()
            ->route('ecues.index');
    }
}
