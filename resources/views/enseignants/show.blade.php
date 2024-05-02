@extends('layouts.master')
@section('title')
    Détail d'un enseignant
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="card rounded-0 ">
        <div class="card-header">
            <h2 class="card-title">
                {{ $enseignant->civilite }} {{ $enseignant->nom . ' ' . $enseignant->prenoms }}
            </h2>
        </div>
        <div class="card-body">
            <div class="py-2 row d-flex justify-content-center">
                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="basiInput" class="form-label">Nom </label>
                    <input type="text" class="form-control " name="nom"
                        value="{{ $enseignant->nom }}" readonly id="basiInput">

                </div>

                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="basiInput" class="form-label">Prénoms </label>
                    <input type="text" class="form-control " name="prenoms"
                        value="{{ $enseignant->prenoms }}" readonly id="basiInput">

                </div>

                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="civilite" class="form-label">Civilité</label>
                    <input type="text" class="form-control" value="{{ $enseignant->civilite }}">

                </div>


                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="basiInput" class="form-label">Email </label>
                    <input type="email" class="form-control " name="email"
                        value="{{ $enseignant->email }}" readonly id="basiInput">

                </div>

                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="basiInput" class="form-label">Téléphone </label>
                    <input type="text" class="form-control " name="telephone"
                        value="{{ $enseignant->telephone }}" readonly id="basiInput">

                </div>

                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="basiInput" class="form-label">Sexe </label>
                    <input type="text" class="form-control" value="{{ $enseignant->sexe }}" readonly id="basiInput">

                </div>

                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="basiInput" class="form-label">Profession </label>
                    <input type="text" class="form-control " name="profession"
                        value="{{ $enseignant->profession }}" readonly id="basiInput">

                </div>

                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="basiInput" class="form-label">Adresse </label>
                    <input type="text" class="form-control " name="adresse"
                        value="{{ $enseignant->adresse }}" readonly id="basiInput">

                </div>

                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="basiInput" class="form-label">Nationalité </label>
                    <input type="text" class="form-control " name="nationalite"
                        value="{{ $enseignant->nationalite }}" readonly id="basiInput">

                </div>

                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="basiInput" class="form-label">Date de naissance </label>
                    <input type="date" class="form-control "
                        name="date_naissance" value="{{ $enseignant->date_naissance }}" readonly id="basiInput">

                </div>

                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="lieu_naissance" class="form-label">Lieu de naissance </label>
                    <input type="text" class="form-control "
                        name="lieu_naissance" value="{{ $enseignant->lieu_naissance }}" id="lieu_naissance" readonly>

                </div>

                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="basiInput" class="form-label">Npi </label>
                    <input type="text" class="form-control " name="npi"
                        value="{{ $enseignant->npi }}" readonly id="basiInput">

                </div>

                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="basiInput" class="form-label">Numéro IFU </label>
                    <input type="text" class="form-control " name="ifu"
                        value="{{ $enseignant->ifu }}" readonly id="basiInput">

                </div>

                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="basiInput" class="form-label">Banque </label>
                    <input type="text" class="form-control" readonly value="{{ $enseignant->banque->nom }}">
                </div>

                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="basiInput" class="form-label">Numéro de compte </label>
                    <input type="text" class="form-control " name="compte"
                        value="{{ $enseignant->compte }}" readonly id="basiInput">

                </div>

                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="status_id" class="form-label">Statut actuel </label>
                    <input type="text" class="form-control" readonly value="{{ $enseignant->status->nom }}">
                </div>

                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="structure_origine" class="form-label">Structure d'origine
                        </label>
                    <input type="text" class="form-control "
                        name="structure_origine" readonly value="{{ $enseignant->structure_origine }}"
                        id="structure_origine">

                </div>

                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="corps_cames" class="form-label">Corps actuel du CAMES </label>
                    <input type="text" class="form-control "
                        name="corps_cames" readonly value="{{ $enseignant->corps_cames }}" id="corps_cames">

                </div>

                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="annee_inscription_cames" class="form-label">Année d'inscription au CAMES
                        du corps
                        actuel </label>
                    <input type="number" class="form-control "
                        name="annee_inscription_cames" value="{{ $enseignant->annee_inscription_cames }}"
                        id="annee_inscription_cames" min="1900" max="2100" readonly>

                </div>

                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="premiere_annee_collaboration" class="form-label">Année de collaboration
                        avec l'ENEAM
                    </label>
                    <input type="number"
                        class="form-control "
                        name="premiere_annee_collaboration" value="{{ $enseignant->premiere_annee_collaboration }}"
                        id="premiere_annee_collaboration" min="1900" max="2100" readonly>

                </div>

                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="corps_fonction_publique" class="form-label">Corps actuel dans la fonction
                        publique </label>
                    <input type="text" class="form-control "
                        name="corps_fonction_publique" value="{{ $enseignant->corps_fonction_publique }}"
                        id="corps_fonction_publique" readonly>

                </div>

                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="grade_id" class="form-label">Grade </label>
                    <select name="grade_id" class="form-control" value="{{ $enseignant->grade_id }}"
                        id="grade_id" disabled @error('grade_id') is-invalid @enderror>
                        @foreach ($grades as $grade)
                            <option {{$enseignant->grade_id == $grade->id ? 'selected' : '' }}
                                value="{{ $grade->id }}">
                                {{ $grade->nom }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="indice" class="form-label">Indice </label>
                    <input type="text" class="form-control " name="indice"
                        value="{{ $enseignant->indice }}" readonly id="indice">

                </div>

                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="nb_enfants" class="form-label">Nombre d'enfants </label>
                    <input type="number" class="form-control "
                        name="nb_enfants" readonly value="{{ $enseignant->nb_enfants }}" id="nb_enfants">

                </div>

                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="poste_administratif" class="form-label">Poste administratif occupé </label>
                    <input type="text" class="form-control "
                        name="poste_administratif" value="{{ $enseignant->poste_administratif }}"
                        id="poste_administratif" readonly>

                </div>

                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="date_prise_service" class="form-label">Date de première prise de service à
                        l'UAC </label>
                    <input type="date" class="form-control "
                        name="date_prise_service" value="{{ $enseignant->date_prise_service }}" id="date_prise_service"
                        readonly>

                </div>

                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="diplome_recrutement" class="form-label">Diplôme de recrutement dans la
                        fonction
                        actuelle </label>
                    <input type="text" class="form-control "
                        name="diplome_recrutement" value="{{ $enseignant->diplome_recrutement }}"
                        id="diplome_recrutement" readonly>

                </div>

                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="specialite_diplome_recrutement" class="form-label">Spécialité du diplôme
                        de
                        recrutement </label>
                    <input type="text"
                        class="form-control "
                        name="specialite_diplome_recrutement" value="{{ $enseignant->specialite_diplome_recrutement }}"
                        id="specialite_diplome_recrutement" readonly>
                    <span class="text-danger">
                </div>

                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="diplome_actuel" class="form-label">Diplôme actuel </label>
                    <input type="text" class="form-control "
                        name="diplome_actuel" value="{{ $enseignant->diplome_actuel }}" id="diplome_actuel" readonly>

                </div>

                <div class="mb-3 col-md-4 col-sm-6">
                    <label for="specialite_diplome_actuel" class="form-label">Spécialité du diplôme actuel
                    </label>
                    <input type="text" class="form-control "
                        name="specialite_diplome_actuel" value="{{ $enseignant->specialite_diplome_actuel }}"
                        id="specialite_diplome_actuel" readonly>

                </div>


            </div>
            <div class="px-2 py-3 mt-3 bg-light d-flex justify-content-between">
                <a href="{{ route('enseignants.index') }}" type="button"
                    class="btn btn-info rounded-0 btn-label waves-effect waves-light"><i
                        class="align-middle ri-arrow-drop-left-line label-icon fs-16 me-2"></i> Annuler </a>

                <a href="{{ route('enseignants.edit', ['enseignant' => $enseignant->slug]) }}">
                    <button class="btn btn-success rounded-0 btn-label waves-effect waves-light"><i
                            class="align-middle ri-check-line label-icon fs-16 me-2"></i> Editer</button>
                </a>

            </div>

        </div>
    </div>
@endsection

@section('script')
    <!--jquery cdn-->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!--select2 cdn-->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script src="{{ URL::asset('assets/js/pages/select2.init.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
