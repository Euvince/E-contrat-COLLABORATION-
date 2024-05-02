@extends('layouts.master')
@section('title')
    Programmation - {{ $cours->classe->nom }} - Semestre {{ $cours->semestre }}
@endsection
@section('css')
    <link rel="stylesheet" href="{{ URL::asset('build/css/flatpickr.min.css')}}">
    <link href="{{ URL::asset('build/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Error!</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form action="{{ route('programmation.update') }}" method="post">
        @csrf
        <input type="hidden" name="cours" value="{{ $cours->id }}">
        <div class="border card rounded-0">
            <div class="card-header">
                <h2 class="card-title">{{ $cours->ue->nom }}</h2>
            </div>
            <div class="card-body">
                <div class="live-preview">
                    @if($cours->ecue1)
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">{{ rechercherEcue($cours->ecue1)->nom  }} ({{$cours->heure_theorique1}}H)</h6>
                            </div>
                            <div class="card-body">
                                <div class="py-2 row">
                                    <div class="mb-3 col-md-12">
                                        <label for="" class="form-label">Enseignant</label>  <span class="text-danger">*</span>
                                        <select class="select2-enseignant" name="enseignant1">
                                            <option value="">Selectionner un enseignant</option>
                                            @foreach (getEnseignantsByUfr(getUfr()->id) as $enseignant)
                                                <option value="{{ $enseignant->id }}" {{ $cours->enseignant1==$enseignant->id ? 'selected' : '' }}>{{ $enseignant->nom }} {{ $enseignant->prenoms }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="" class="form-label">Date de démarrage</label>  <span class="text-danger">*</span>
                                        <input type="text" value="{{ $cours->date_debut1 }}" name="date_debut1" id="datepicker" class="form-control" data-provider="flatpickr" data-date-format="d/m/Y">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="" class="form-label">Date fin</label>  <span class="text-danger">*</span>
                                        <input type="text" value="{{ $cours->date_fin1 }}" name="date_fin1" id="datepicker" class="form-control" data-provider="flatpickr" data-date-format="d/m/Y">
                                    </div>
                                    <div class="mb-3 col-md-2">
                                        <label for="" class="form-label">Heure début</label>  <span class="text-danger">*</span>
                                        <input type="text" value="{{ $cours->plage_debut1 }}" name="heure_debut1" id="timepicker" class="form-control" data-provider="flatpickr" data-date-format="d/m/Y">
                                    </div>
                                    <div class="mb-3 col-md-2">
                                        <label for="" class="form-label">Heure fin</label>  <span class="text-danger">*</span>
                                        <input type="text" value="{{ $cours->plage_fin1 }}" name="heure_fin1" id="timepicker" class="form-control" data-provider="flatpickr" data-date-format="d/m/Y">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="" class="form-label">Date de composition</label>
                                        <input type="text" value="{{ $cours->date_composition1 }}" name="composition1" id="datetimepicker" class="form-control" data-provider="flatpickr" data-date-format="d/m/Y H:i">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="" class="form-label">Salle(s) de composition</label>
                                        <input type="text" class="form-control" value="{{ $cours->salle1 }}" name="salle1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                    @if($cours->ecue2)
                        <div class="card">
                            <div class="card-header">
                                <h6 class="card-title mb-0">{{ rechercherEcue($cours->ecue2)->nom  }} ({{$cours->heure_theorique2}}H)</h6>
                            </div>
                            <div class="card-body">
                                <div class="py-2 row">
                                    <div class="mb-3 col-md-12">
                                        <label for="" class="form-label">Enseignant</label>  <span class="text-danger">*</span>
                                        <select class="select2-enseignant" name="enseignant2">
                                            <option value="">Selectionner un enseignant</option>
                                            @foreach (getEnseignantsByUfr(getUfr()->id) as $enseignant)
                                                <option value="{{ $enseignant->id }}" {{ $cours->enseignant2==$enseignant->id ? 'selected' : '' }}>{{ $enseignant->nom }} {{ $enseignant->prenoms }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="" class="form-label">Date de démarrage</label>  <span class="text-danger">*</span>
                                        <input type="text" value="{{ $cours->date_debut2 }}" name="date_debut2" id="datepicker" class="form-control" data-provider="flatpickr" data-date-format="d/m/Y">
                                    </div>
                                    <div class="mb-3 col-md-4">
                                        <label for="" class="form-label">Date fin</label>  <span class="text-danger">*</span>
                                        <input type="text" value="{{ $cours->date_fin2 }}" name="date_fin2" id="datepicker" class="form-control" data-provider="flatpickr" data-date-format="d/m/Y">
                                    </div>
                                    <div class="mb-3 col-md-2">
                                        <label for="" class="form-label">Heure début</label>  <span class="text-danger">*</span>
                                        <input type="text" value="{{ $cours->plage_debut2 }}" name="heure_debut2" id="timepicker" class="form-control" data-provider="flatpickr" data-date-format="d/m/Y">
                                    </div>
                                    <div class="mb-3 col-md-2">
                                        <label for="" class="form-label">Heure fin</label>  <span class="text-danger">*</span>
                                        <input type="text" value="{{ $cours->plage_fin2 }}" name="heure_fin2" id="timepicker" class="form-control" data-provider="flatpickr" data-date-format="d/m/Y">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="" class="form-label">Date de composition</label>
                                        <input type="text" value="{{ $cours->date_composition2 }}" name="composition2" id="datetimepicker" class="form-control" data-provider="flatpickr" data-date-format="d/m/Y H:i">
                                    </div>
                                    <div class="mb-3 col-md-6">
                                        <label for="" class="form-label">Salle(s) de composition</label>
                                        <input type="text" class="form-control" value="{{ $cours->salle2 }}" name="salle2">
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('programmations.index') }}" type="button"
                        class="btn btn-info rounded-0 btn-label waves-effect waves-light"><i
                            class="align-middle ri-arrow-drop-left-line label-icon fs-16 me-2"></i> Annuler </a>
                    <button type="submit" class="btn btn-success rounded-0 btn-label waves-effect waves-light"><i
                            class="align-middle ri-check-line label-icon fs-16 me-2"></i> Enregistrer</button>

                </div>
            </div>
        </div>


    </form>

@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="{{ URL::asset('build/js/pages/select2.min.js') }}"></script>

    <script>
        $('.select2-enseignant').select2({
            tags: false,
            placeholder: "Sélectionner un enseignant",
        });
    </script>
    <script src="{{ URL::asset('build/js/pages/flatpickr.min.js')}}"></script>
    <script src="{{ URL::asset('build/js/pages/flatpickr_fr.js')}}"></script>

    <script>
        // Initialize Flatpickr with DateTime functionality
        flatpickr("#datetimepicker", {
            enableTime: true, // Enable time selection
            dateFormat: "d/m/Y H:i",
            time_24hr: true ,
            enableSeconds: false,
            locale : "fr",
        });

        flatpickr("#datepicker", {
            enableTime: false, // Enable time selection
            dateFormat: "d/m/Y", // Customize the date and time format as needed
            locale : "fr",
        });

        flatpickr("#timepicker", {
            enableTime: true, // Enable time selection
            noCalendar: true,
            enableSeconds: false,
            dateFormat: "H:i", // Customize the date and time format as needed
            locale : "fr",
        });
    </script>

@endsection
