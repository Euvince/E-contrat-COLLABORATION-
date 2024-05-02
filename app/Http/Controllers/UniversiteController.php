<?php

namespace App\Http\Controllers;

use App\Http\Requests\UniversiteStoreRequest;
use App\Http\Requests\UniversiteUpdateRequest;
use App\Models\Universite;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class UniversiteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {

        $universites = Universite::get();

        return view('universites.index', compact('universites'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {

        return view(
            'universites.create'
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(UniversiteStoreRequest $request): RedirectResponse
    {
        // $this->authorize('create', Universite::class);

        $validated = $request->validated();

        /**
         * @var UploadedFile | null $miniature
         */
        $logo = $validated['logo'] ?? null;

        if ($logo !== null) {
            $validated['logo'] = $logo->store('images/universites', 'public');
        }

        $universite = Universite::create($validated);

        notyf()->addSuccess('Universite créée avec success.');
        return redirect()->route('universites.show', compact('universite'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Universite $universite): View
    {

        return view('universites.show', compact('universite'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Universite $universite): View
    {
        return view(
            'universites.edit',
            compact('universite')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UniversiteUpdateRequest $request,
        Universite $universite
    ): RedirectResponse {
        $validated = $request->validated();
        /**
         * @var UploadedFile | null $logo
         */
        $logo = $validated['logo'] ?? null;

        if ($logo != null) {
            $validated['logo'] = $logo->store('images/universites', 'public');

            // Si l'utilisateur soumet un nouveau logo et que l'université avait déjà un logo, supprimer ce dernier
            if ($universite->logo) {
                Storage::disk('public')->delete($universite->logo);
            }
        }


        $universite->update($validated);
        notyf()->addSuccess('Universite modifiée avec success.');
        return redirect()
            ->route('universites.show', compact('universite'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Universite $universite
    ): RedirectResponse {
        // $this->authorize('delete', $universite);

        $universite->delete();
        notyf()->addSuccess('Universite supprimée avec success.');
        return redirect()
            ->route('universites.index');
    }
}
