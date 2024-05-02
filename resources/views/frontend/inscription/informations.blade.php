@extends('frontend.inscription.layout')
@section('title')
    Informations personnelles
@endsection
@section('css')
<link href="{{ URL::asset('build/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card mt-4">

                <div class="card-body p-4">
                    <div class="mt-2">
                        <h5 class="text-primary">Informations personnelles</h5>
                    </div>
                    <div class="p-2 mt-4">
                        <form class="needs-validation" novalidate="" action="{{ route('confirmation') }}" method="post">
                            @csrf
                            <div class="row">
                                <div class="mb-3 col-md-3">
                                    <label for="civilite" class="form-label">Civilité <span class="text-danger">*</span></label>
                                    <select name="civilite"  class="form-select" required>
                                        <option value="" disabled selected required>Sélectionner une civilité</option>
                                        <option value="Monsieur" {{ ($enseignant and $enseignant->civilite=='Monsieur') ? 'selected' : '' }}>Monsieur</option>
                                        <option value="Madame" {{ ($enseignant and $enseignant->civilite=='Madame') ? 'selected' : '' }}>Madame</option>
                                        <option value="Docteur" {{ ($enseignant and $enseignant->civilite=='Docteur') ? 'selected' : '' }}>Docteur</option>
                                        <option value="Professeur" {{ ($enseignant and $enseignant->civilite=='Professeur') ? 'selected' : '' }} >Professeur</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Veuillez entrer votre civilité
                                    </div>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="nom" class="form-label">Nom <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" value="{{ $enseignant ? $enseignant->nom : '' }}" name="nom"  placeholder="Nom" required="">
                                    <div class="invalid-feedback">
                                        Veuillez entrer votre nom
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="prenoms" class="form-label">Prénoms <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control"  value="{{ $enseignant ? $enseignant->prenoms : '' }}" name="prenoms" placeholder="Prénoms" required="">
                                    <div class="invalid-feedback">
                                        Veuillez entrer vos prénoms
                                    </div>
                                </div>

                                <div class="mb-3 col-md-3">
                                    <label for="civilite" class="form-label">Diplôme <span class="text-danger">*</span></label>
                                    <select name="diplome_actuel"  class="form-select" required placeholder="Diplôme">
                                        <option value="" disabled selected required>Selectionner un diplôme </option>
                                        <option value="Master" {{ ($enseignant and $enseignant->diplome_actuel=='Master') ? 'selected' : '' }}>Master</option>
                                        <option value="Ingénieur" {{ ($enseignant and $enseignant->diplome_actuel=='Ingénieur') ? 'selected' : '' }}>Ingénieur</option>
                                        <option value="DEA" {{ ($enseignant and $enseignant->diplome_actuel=='DEA') ? 'selected' : '' }}>DEA</option>
                                        <option value="DESS" {{ ($enseignant and $enseignant->diplome_actuel=='DESS') ? 'selected' : '' }} >DESS</option>
                                        <option value="Doctorat" {{ ($enseignant and $enseignant->diplome_actuel=='Doctorat') ? 'selected' : '' }} >Doctorat</option>
                                    </select>
                                    <div class="invalid-feedback">
                                        Veuillez entrer votre diplôme
                                    </div>
                                </div>
                                <div class="mb-3 col-md-3">
                                    <label for="appelation" class="form-label">Grade au CAMES <span class="text-danger">*</span></label>
                                    <select  name="grade_id" class="form-select" required>
                                        <option value="" selected disabled required>Sélectionner un grade</option>
                                        @foreach ($grades as $grade)
                                            <option value="{{ $grade->id }}" {{ ($enseignant and $enseignant->grade_id==$grade->id) ? 'selected' : '' }}>{{ $grade->nom}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Veuillez entrer votre grade
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="specialite" class="form-label">Spécialité du diplôme <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control"  value="{{ $enseignant ? $enseignant->specialite_diplome_actuel : '' }}" name="specialite" placeholder="Spécialité du diplôme" required="">
                                    <div class="invalid-feedback">
                                        Veuillez entrer votre spécialité
                                    </div>
                                </div>
                                
                                <div class="mb-3 col-md-6">
                                    <label for="ifu" class="form-label">Numéro IFU <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="ifu" value="{{ $ifu}}" placeholder="Numéro IFU" required="" readonly>
                                    <div class="invalid-feedback">
                                        Veuillez entrer votre numéro IFU
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="npi" class="form-label">Numéro NPI <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="npi" value="{{ $enseignant ? $enseignant->npi : '' }}" placeholder="Numéro NPI" required="">
                                    <div class="invalid-feedback">
                                        Veuillez entrer votre numéro NPI
                                    </div>
                                </div>
                                
                                <div class="mb-3 col-md-6">
                                    <label for="nationalite" class="form-label">Nationalité <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control"  value="{{ $enseignant ? $enseignant->nationalite : '' }}" name="nationalite" placeholder="" required="">
                                    <div class="invalid-feedback">
                                        Veuillez entrer votre nationalité
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="profession" class="form-label">Profession <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control"  value="{{ $enseignant ? $enseignant->profession : '' }}" name="profession" placeholder="" required="">
                                    <div class="invalid-feedback">
                                        Veuillez entrer votre profession
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="telephone" class="form-label">Téléphone <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control"  value="{{ $enseignant ? $enseignant->telephone : '' }}" name="telephone" placeholder="" required="">
                                    <div class="invalid-feedback">
                                        Veuillez entrer votre téléphone
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="email" class="form-control"  value="{{ $enseignant ? $enseignant->email : '' }}" name="email" placeholder="" required="">
                                    <div class="invalid-feedback">
                                        Veuillez entrer votre email
                                    </div>
                                </div>
                                <div class="mb-3 col-md-4">
                                    <label for="adresse" class="form-label">Adresse <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control"  value="{{ $enseignant ? $enseignant->adresse : '' }}" name="adresse" placeholder="Adresse" required="">
                                    <div class="invalid-feedback">
                                        Veuillez entrer votre adresse
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="appelation" class="form-label">Banque <span class="text-danger">*</span></label>
                                    <select class="select2-banque" name="banque_id" required>
                                        <option value="">Sélectionner une banque</option>
                                        @foreach ($banques as $banque)
                                            <option value="{{ $banque->id }}" {{ ($enseignant and $enseignant->banque_id==$banque->id) ? 'selected' : '' }}>{{ $banque->nom}}</option>
                                        @endforeach
                                    </select>
                                    <div class="invalid-feedback">
                                        Veuillez entrer votre banque
                                    </div>
                                </div>
                                <div class="mb-3 col-md-6">
                                    <label for="compte" class="form-label">Numéro de compte complet (Bj....)<span class="text-danger">*</span></label>
                                    <input type="text" class="form-control"  value="{{ $enseignant ? $enseignant->compte : '' }}" name="compte" placeholder="BJXXXXXXXXX" required="">
                                    <div class="invalid-feedback">
                                        Veuillez entrer votre numéro de compte
                                    </div>
                                </div>
                            </div>        
                            

                            <div class="mt-4">
                                <button class="btn btn-success w-100" type="submit">Enregistrer</button>
                            </div>

                        </form>

                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->


        </div>
    </div>     
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ URL::asset('build/js/pages/select2.min.js') }}"></script>
    <script>
        $('.select2-banque').select2({
            tags: false,
            placeholder: "Sélectionner une banque",
        });
    </script>
@endsection
