<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Role;
use App\Models\Universite;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::get();
        return view('users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $universites = Universite::all();
        $roles = Role::all();
        return view('users.create', compact('universites', 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request)
    {
        $request->password = Hash::make($request->password);
        $request->avatar = $request->avatar?->store('userAvatars', 'public') ;
        $user = User::create($request->validated());
        $user->assignRole(\Spatie\Permission\Models\Role::whereId($request->role_id)->first());
        notyf()->addSuccess('Utilisateur créé avec success.');
        return redirect()->route('users.create');
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        $universites = Universite::all();
        $roles = Role::all();
        return view('users.show', compact('user', 'universites', 'roles' ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $universites = Universite::all();
        $roles = Role::all();
        return view('users.edit', compact('user' , 'universites', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        $user->update($request->validated());
        $user->assignRole(Role::whereId($request->role_id)->first());
        notyf()->addSuccess('Utilisateur modifié avec succès.');
        return redirect()
            ->route('users.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        $user->delete();
        notyf()->addSuccess('Utilisateur supprimé avec succès.');
        return redirect()
            ->route('users.index');
    }
}
