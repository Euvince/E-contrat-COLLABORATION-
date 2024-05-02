<?php

namespace App\Http\Controllers;

use App\Http\Requests\UeStoreRequest;
use App\Http\Requests\UeUpdateRequest;
use App\Models\Ue;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UeController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $ues = Ue::get();
        return view('ues.index', compact('ues'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {

        return view(
            'ues.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UeStoreRequest $request): RedirectResponse
    {
        // $this->authorize('create', Banque::class);

        $validated = $request->validated();

        $banque = Ue::create($validated);
        notyf()->addSuccess('Ue créée avec success.');
        return redirect()->route('ues.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Ue $ue): View
    {

        return view('ues.show', compact('ue'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Ue $ue): View
    {
        return view(
            'ues.edit',
            compact('ue')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UeUpdateRequest $request,
        Ue $ue
    ): RedirectResponse {
        // $this->authorize('update', $banque);

        $validated = $request->validated();

        $ue->update($validated);
        notyf()->addSuccess('Ue modifiée avec success.');
        return redirect()
            ->route('ues.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Ue $ue
    ): RedirectResponse {
        // $this->authorize('delete', $banque);

        $ue->delete();
        notyf()->addSuccess('Ue supprimée avec success.');
        return redirect()
            ->route('ues.index');
    }
}
