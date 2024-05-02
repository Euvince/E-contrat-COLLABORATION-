@extends('layouts.master')
@section('title')
Modification d'un contrat
@endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('build/css/flatpickr.min.css')}}">
<link href="{{ URL::asset('build/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<form action="{{ route('contrats.update',['contrat_id' => $contrat->id]) }}" method="post">
    @csrf
    <div class="border card rounded-0">
        <div class="card-header" style="background-color: #e8effb !important;">
            <h2 class="card-title" style="color: #6691e7 !important;">{{ $contrat->enseignant->nom }} {{ $contrat->enseignant->prenoms }} - {{ $contrat->cycle->nom }}</h2>
        </div>
        <div class="card-body">
            <div class="live-preview">
                <div class="py-2 row">
                        <div class="col-md-6" >
                            <label for="" class="form-label">Numéro du contrat</label>
                            <input type="texte" class="form-control" name="numero" value="{{ $contrat->numero }}">
                        </div>
                        <div class="col-md-6" >
                            <label for="" class="form-label">Date du contrat</label>
                            <input type="text" value="{{ $contrat->date_contrat }}" name="date_contrat" id="datepicker" class="form-control" data-provider="flatpickr" data-date-format="d/m/Y">
                        </div>
                </div>
                <div class="py-2 row">
                    <div class="col-md-12" >
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Liste des cours </h4>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-borderless table-hover table-nowrap align-middle mb-0">
                                        <thead class="table-light">
                                            <tr class="text-muted">
                                                <th scope="col" style="width: 10px;"></th>
                                                <th scope="col">Département</th>
                                                <th scope="col">Filière</th>
                                                <th scope="col">Classe</th>
                                                <th scope="col">Cycle</th>
                                                <th scope="col">UE</th>
                                                <th scope="col">ECUE</th>
                                                <th scope="col">Masse</th>
                                                <th scope="col">Date début</th>
                                                <th scope="col">Date fin</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ( getCoursByEnseignantByCycleByUfr($contrat->enseignant->id,$contrat->cycle_id,$contrat->ufr_id) as $cours)
                                                <tr>
                                                    <th scope="row">
                                                        <div class="form-check">
                                                            <input class="form-check-input fs-15" type="checkbox"  {{ $cours->contrat_id ? 'checked disabled' : '' }} value="{{ $cours->cours_id }}_{{ $cours->ecue_id }}" name="ecues[]">
                                                        </div>
                                                    </th>
                                                    <td>{{ rechercherClasse($cours->classe_id)->filiere->departement->nom }}</td>
                                                    <td>{{ rechercherClasse($cours->classe_id)->filiere->code }}</td>
                                                    <td>{{ rechercherClasse($cours->classe_id)->code }}</td>
                                                    <td>{{ rechercherClasse($cours->classe_id)->cycle->nom }}</td>
                                                    <td>{{ rechercherUe($cours->ue_id)->nom }}</td>
                                                    <td> {{ rechercherEcue($cours->ecue_id)->nom }}</td>
                                                    <td>{{ $cours->heure_theorique }}</td>
                                                    <td>{{ $cours->date_debut ? date('d/m/Y', strtotime($cours->date_debut)) : ''}}</td>
                                                    <td>{{ $cours->date_fin ? date('d/m/Y', strtotime($cours->date_fin)) :''}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody><!-- end tbody -->
                                    </table><!-- end table -->
                                </div><!-- end table responsive -->
                            </div><!-- end card body -->
                        </div>
                    </div>
                </div> 
                
            </div>
        </div>
        <div class="card-footer">
            <div class="d-flex justify-content-between">
                <a href="{{ route('contrats.show',['enseignant_id'=>encryptid($contrat->enseignant_id)]) }}" type="button"
                    class="btn btn-info rounded-0 btn-label waves-effect waves-light"><i
                        class="align-middle ri-arrow-drop-left-line label-icon fs-16 me-2"></i> Annuler </a>
                    <button type="submit" class="btn btn-success rounded-0 btn-label waves-effect waves-light"><i
                        class="align-middle ri-check-line label-icon fs-16 me-2"></i> Modifier</button>

            </div>
        </div>

    </div>
</form>
@endsection
@section('script')
    
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
<script src="{{ URL::asset('build/js/pages/flatpickr.min.js')}}"></script>
 <script src="{{ URL::asset('build/js/pages/flatpickr_fr.js')}}"></script>
 <script>
    flatpickr("#datepicker", {
        enableTime: false, // Enable time selection
        dateFormat: "d/m/Y", // Customize the date and time format as needed
        locale : "fr",
    });
</script>
@endsection
