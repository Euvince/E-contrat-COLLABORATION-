@extends('layouts.master')
@section('title')
    Modifier un enseignant
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
            <form action="{{ route('enseignants.update', ['enseignant' => $enseignant->slug]) }}" method="post">
                @method('put')
                @csrf
                <div class="py-2 row d-flex justify-content-center">

                    <div class="mb-3 col-md-4 col-sm-6">
                        <label for="basiInput" class="form-label">Nom  <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom"
                            value="{{ $enseignant->nom }}" id="basiInput">
                        @error('nom')
                            <span class="text-danger"> {{ $errors->first('nom') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6">
                        <label for="basiInput" class="form-label">Prénoms <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('prenoms') is-invalid @enderror" name="prenoms"
                            value="{{ $enseignant->prenoms }}" id="basiInput">
                        @error('prenoms')
                            <span class="text-danger"> {{ $errors->first('prenoms') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6">
                        <label for="civilite" class="form-label">Civilité <span class="text-danger">*</span></label>
                        <select name="civilite" class="form-control" id="civilite" value="{{ $enseignant->civilite }}"
                            @error('civilite') is-invalid @enderror>
                            <option {{ $enseignant->civilite == 'Monsieur' ? 'selected' : '' }} value="Monsieur">Monsieur
                            </option>
                            <option {{ $enseignant->civilite == 'Madame' ? 'selected' : '' }} value="Madame">Madame
                            </option>
                            <option {{ $enseignant->civilite == 'Docteur' ? 'selected' : '' }}value="Docteur">Docteur
                            </option>
                            <option {{ $enseignant->civilite == 'Professeur' ? 'selected' : '' }}value="Professeur">
                                Professeur</option>
                        </select>
                        @error('civilite')
                            <span class="text-danger"> {{ $errors->first('civilite') }}</span>
                        @enderror
                    </div>


                    <div class="mb-3 col-md-4 col-sm-6">
                        <label for="basiInput" class="form-label">Email <span class="text-danger">*</span></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ $enseignant->email }}" id="basiInput">
                        @error('email')
                            <span class="text-danger"> {{ $errors->first('email') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6">
                        <label for="basiInput" class="form-label">Téléphone <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone"
                            value="{{ $enseignant->telephone }}" id="basiInput">
                        @error('telephone')
                            <span class="text-danger"> {{ $errors->first('telephone') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6">
                        <label for="basiInput" class="form-label">Sexe <span class="text-danger">*</span></label>
                        <select name="sexe" class="form-control" value="{{ $enseignant->sexe }}" id="basiInput"
                            @error('sexe') is-invalid @enderror>
                            <option {{ $enseignant->sexe == 'Masculin' ? 'selected' : '' }} value="Masculin">Masculin
                            </option>
                            <option {{ $enseignant->sexe == 'Féminin' ? 'selected' : '' }} value="Féminin">Féminin
                            </option>
                            <option {{ $enseignant->sexe == 'Autre' ? 'selected' : '' }} value="Autre">Autre
                            </option>
                        </select>
                        @error('sexe')
                            <span class="text-danger"> {{ $errors->first('sexe') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6">
                        <label for="basiInput" class="form-label">Profession <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('profession') is-invalid @enderror"
                            name="profession" value="{{ $enseignant->profession }}" id="basiInput">
                        @error('profession')
                            <span class="text-danger"> {{ $errors->first('profession') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6">
                        <label for="basiInput" class="form-label">Adresse <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('adresse') is-invalid @enderror" name="adresse"
                            value="{{ $enseignant->adresse }}" id="basiInput">
                        @error('adresse')
                            <span class="text-danger"> {{ $errors->first('adresse') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6">
                        <label for="basiInput" class="form-label">Nationalité <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nationalite') is-invalid @enderror"
                            name="nationalite" value="{{ $enseignant->nationalite }}" id="basiInput">
                        @error('nationalite')
                            <span class="text-danger"> {{ $errors->first('nationalite') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6">
                        <label for="basiInput" class="form-label">Date de naissance <span class="text-danger">*</span></label>
                        <input type="date" class="form-control @error('date_naissance') is-invalid @enderror"
                            name="date_naissance" value="{{ $enseignant->date_naissance }}" id="basiInput">
                        @error('date_naissance')
                            <span class="text-danger"> {{ $errors->first('date_naissance') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6">
                        <label for="lieu_naissance" class="form-label">Lieu de naissance de
                            l'enseignant <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('lieu_naissance') is-invalid @enderror"
                            name="lieu_naissance" value="{{ $enseignant->lieu_naissance }}" id="lieu_naissance">
                        @error('lieu_naissance')
                            <span class="text-danger"> {{ $errors->first('lieu_naissance') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6">
                        <label for="basiInput" class="form-label">Npi <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('npi') is-invalid @enderror" name="npi"
                            value="{{ $enseignant->npi }}" id="basiInput">
                        @error('npi')
                            <span class="text-danger"> {{ $errors->first('npi') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6">
                        <label for="basiInput" class="form-label">Numéro IFU <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('ifu') is-invalid @enderror" name="ifu"
                            value="{{ $enseignant->ifu }}" id="basiInput">
                        @error('ifu')
                            <span class="text-danger"> {{ $errors->first('ifu') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6">
                        <label for="basiInput" class="form-label">Banque <span class="text-danger">*</span></label>
                        <select name="banque_id" class="form-control" value="{{ $enseignant->banque_id }}"
                            id="basiInput" @error('banque_id') is-invalid @enderror>
                            @foreach ($banques as $banque)
                                <option {{ $banque->id == $enseignant->banque_id ? 'selected' : '' }}
                                    value="{{ $enseignant->banque_id }}">{{ $banque->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6">
                        <label for="basiInput" class="form-label">Numéro de compte <span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('compte') is-invalid @enderror" name="compte"
                            value="{{ $enseignant->compte }}" id="basiInput">
                        @error('compte')
                            <span class="text-danger"> {{ $errors->first('compte') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6">
                        <label for="status_id" class="form-label">Statut actuel</label>
                        <select name="status_id" class="form-control" value="{{ $enseignant->status_id }}"
                            id="status_id" @error('status_id') is-invalid @enderror>
                            @foreach ($status as $_status)
                                <option {{ $enseignant->status_id == $_status->id ? 'selected' : '' }}
                                    value="{{ $_status->id }}">{{ $_status->nom }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6">
                        <label for="structure_origine" class="form-label">Structure d'origine
                            </label>
                        <input type="text" class="form-control @error('structure_origine') is-invalid @enderror"
                            name="structure_origine" value="{{ $enseignant->structure_origine }}"
                            id="structure_origine">
                        @error('structure_origine')
                            <span class="text-danger"> {{ $errors->first('structure') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6">
                        <label for="corps_cames" class="form-label">Corps actuel du CAMES de
                            l'enseignant</label>
                        <input type="text" class="form-control @error('corps_cames') is-invalid @enderror"
                            name="corps_cames" value="{{ $enseignant->corps_cames }}" id="corps_cames">
                        @error('corps_cames')
                            <span class="text-danger"> {{ $errors->first('corps_cames') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6">
                        <label for="annee_inscription_cames" class="form-label">Année d'inscription au CAMES
                            </label>
                        <input type="number" class="form-control @error('annee_inscription_cames') is-invalid @enderror"
                            name="annee_inscription_cames" value="{{ $enseignant->annee_inscription_cames }}"
                            id="annee_inscription_cames" min="1900" max="2100">
                        @error('annee_inscription_cames')
                            <span class="text-danger"> {{ $errors->first('annee_inscription_cames') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6">
                        <label for="premiere_annee_collaboration" class="form-label">Année de collaboration
                            avec l'ENEAM
                        </label>
                        <input type="number"
                            class="form-control @error('premiere_annee_collaboration') is-invalid @enderror"
                            name="premiere_annee_collaboration" value="{{ $enseignant->premiere_annee_collaboration }}"
                            id="premiere_annee_collaboration" min="1900" max="2100">
                        @error('premiere_annee_collaboration')
                            <span class="text-danger"> {{ $errors->first('premiere_annee_collaboration') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6">
                        <label for="corps_fonction_publique" class="form-label">Corps actuel dans la fonction
                            publique</label>
                        <input type="text" class="form-control @error('corps_fonction_publique') is-invalid @enderror"
                            name="corps_fonction_publique" value="{{ $enseignant->corps_fonction_publique }}"
                            id="corps_fonction_publique">
                        @error('corps_fonction_publique')
                            <span class="text-danger"> {{ $errors->first('corps_fonction_publique') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6">
                        <label for="grade_id" class="form-label">Grade<span class="text-danger">*</span></label>
                        <select name="grade_id" class="form-control" value="{{ $enseignant->grade_id }}"
                        id="grade_id" @error('grade_id') is-invalid @enderror>
                        @foreach ($grades as $grade)
                            <option {{ $enseignant->grade_id == $grade->id ? 'selected' : '' }}
                                value="{{ $grade->id }}">
                                {{ $grade->nom }}</option>
                        @endforeach
                    </select>
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6">
                        <label for="indice" class="form-label">Indice<span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('indice') is-invalid @enderror" name="indice"
                            value="{{ $enseignant->indice }}" id="indice">
                        @error('indice')
                            <span class="text-danger"> {{ $errors->first('indice') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6">
                        <label for="nb_enfants" class="form-label">Nombre d'enfants<span class="text-danger">*</span></label>
                        <input type="number" class="form-control @error('nb_enfants') is-invalid @enderror"
                            name="nb_enfants" value="{{ $enseignant->nb_enfants }}" id="nb_enfants">
                        @error('nb_enfants')
                            <span class="text-danger"> {{ $errors->first('nb_enfants') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6">
                        <label for="poste_administratif" class="form-label">Poste administratif occupé de
                            l'enseignant</label>
                        <input type="text" class="form-control @error('poste_administratif') is-invalid @enderror"
                            name="poste_administratif" value="{{ $enseignant->poste_administratif }}"
                            id="poste_administratif">
                        @error('poste_administratif')
                            <span class="text-danger"> {{ $errors->first('poste_administratif') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6">
                        <label for="date_prise_service" class="form-label">Date de première prise de service à
                            l'UAC</label>
                        <input type="date" class="form-control @error('date_prise_service') is-invalid @enderror"
                            name="date_prise_service" value="{{ $enseignant->date_prise_service }}"
                            id="date_prise_service">
                        @error('date_prise_service')
                            <span class="text-danger"> {{ $errors->first('date_prise_service') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6">
                        <label for="diplome_recrutement" class="form-label">Diplôme de recrutement dans la
                            fonction
                            actuelle</label>
                        <input type="text" class="form-control @error('diplome_recrutement') is-invalid @enderror"
                            name="diplome_recrutement" value="{{ $enseignant->diplome_recrutement }}"
                            id="diplome_recrutement">
                        @error('diplome_recrutement')
                            <span class="text-danger"> {{ $errors->first('diplome_recrutement') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6">
                        <label for="specialite_diplome_recrutement" class="form-label">Spécialité du diplôme
                            de
                            recrutement</label>
                        <input type="text"
                            class="form-control @error('specialite_diplome_recrutement') is-invalid @enderror"
                            name="specialite_diplome_recrutement"
                            value="{{ $enseignant->specialite_diplome_recrutement }}"
                            id="specialite_diplome_recrutement">
                        @error('specialite_diplome_recrutement')
                            <span class="text-danger">
                                {{ $errors->first('specialite_diplome_recrutement') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6">
                        <label for="diplome_actuel" class="form-label">Diplôme actuel <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('diplome_actuel') is-invalid @enderror"
                            name="diplome_actuel" value="{{ $enseignant->diplome_actuel }}" id="diplome_actuel">
                        @error('diplome_actuel')
                            <span class="text-danger"> {{ $errors->first('diplome_actuel') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-4 col-sm-6">
                        <label for="specialite_diplome_actuel" class="form-label">Spécialité du diplôme actuel
                            de
                            l'enseignant <span class="text-danger">*</span></label>
                        <input type="text"
                            class="form-control @error('specialite_diplome_actuel') is-invalid @enderror"
                            name="specialite_diplome_actuel" value="{{ $enseignant->specialite_diplome_actuel }}"
                            id="specialite_diplome_actuel">
                        @error('specialite_diplome_actuel')
                            <span class="text-danger"> {{ $errors->first('specialite_diplome_actuel') }}</span>
                        @enderror
                    </div>

                </div>

                <div class="px-2 py-3 mt-3 bg-light d-flex justify-content-between">
                    <a href="{{ route('enseignants.index') }}" type="button"
                        class="btn btn-info rounded-0 btn-label waves-effect waves-light"><i
                            class="align-middle ri-arrow-drop-left-line label-icon fs-16 me-2"></i> Annuler </a>
                    <button type="submit" class="btn btn-success rounded-0 btn-label waves-effect waves-light"><i
                            class="align-middle ri-check-line label-icon fs-16 me-2"></i> Modifier</button>

                </div>
            </form>

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
