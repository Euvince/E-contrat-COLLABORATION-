<?php

namespace App\Http\Controllers;

use App\Models\Banque;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\BanqueStoreRequest;
use App\Http\Requests\BanqueUpdateRequest;

class BanqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $banques = Banque::get();

        return view('banques.index', compact('banques'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {

        return view(
            'banques.create'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BanqueStoreRequest $request): RedirectResponse
    {
        // $this->authorize('create', Banque::class);

        $validated = $request->validated();

        $banque = Banque::create($validated);
        notyf()->addSuccess('Banque créée avec success.');
        return redirect()->route('banques.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Banque $banque): View
    {

        return view('banques.show', compact('banque'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Banque $banque): View
    {
        return view(
            'banques.edit',
            compact('banque')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        BanqueUpdateRequest $request,
        Banque $banque
    ): RedirectResponse {
        // $this->authorize('update', $banque);

        $validated = $request->validated();

        $banque->update($validated);
        notyf()->addSuccess('Banque modifiée avec success.');
        return redirect()
            ->route('banques.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Banque $banque
    ): RedirectResponse {
        // $this->authorize('delete', $banque);

        $banque->delete();
        notyf()->addSuccess('Banque supprimée avec success.');
        return redirect()
            ->route('banques.index');
    }
}
