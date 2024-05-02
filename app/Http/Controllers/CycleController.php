<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCycleRequest;
use App\Http\Requests\UpdateCycleRequest;
use App\Models\Cycle;

class CycleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cycles = Cycle::get();

        return view('cycles.index', compact('cycles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cycles.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCycleRequest $request)
    {
        $cycle = Cycle::create($request->validated());
        notyf()->addSuccess('Cycle créé avec success.');
        return redirect()->route('cycles.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(Cycle $cycle)
    {
        return view('cycles.show', compact('cycle'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cycle $cycle)
    {
        return view(
            'cycles.edit',
            compact('cycle')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCycleRequest $request, Cycle $cycle)
    {
        $cycle->update($request->validated());
        notyf()->addSuccess('Cycle modifié avec success.');
        return redirect()
            ->route('cycles.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cycle $cycle)
    {
        $cycle->delete();
        notyf()->addSuccess('Cycle supprimé avec success.');
        return redirect()
            ->route('cycles.index');
    }
}
