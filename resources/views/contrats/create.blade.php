@extends('layouts.master')
@section('title')
Etablissement d'un nouveau contrat
@endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('build/css/flatpickr.min.css')}}">
<link href="{{ URL::asset('build/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

<form action="{{ route('contrats.store') }}" method="post">
    @csrf
    <div class="border card rounded-0">
        <div class="card-body">
            <div class="live-preview">
                <div class="py-2 row">
                    <div class="col-md-12">
                        <h6>Sélectionner un enseignant</h6>
                        <select class="select2-enseignant" name="enseignant" onchange="selectEnseignant(this)">
                            <option value="">Sélectionner un enseignant</option>
                            @foreach ($enseignants as $e)
                                <option value="{{ encryptid($e->id) }}" {{ ($enseignant and $e->id==$enseignant->id) ? 'selected' : '' }}>{{ $e->nom . " " . $e->prenoms}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>  
            </div>
        </div>
    </div>
    @if($enseignant===null)
        <div class="alert alert-primary alert-dismissible alert-additional fade show mb-3" role="alert">
            <div class="alert-body">
                <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                        <i class="ri-alert-line fs-16 align-middle"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="alert-heading">Choisir un enseignant</h5>
                        <p class="mb-0">Veuillez choisir un enseignant dans la liste pour afficher tous les cours programmés pour ce dernier.</p>
                    </div>
                </div>
            </div>
            <div class="alert-content">
                <p class="mb-0">Assurez vous que tous les cours de l'enseignant ont été programmés par le service de la programmation des cours</p>
            </div>
        </div>
        <div class="border card rounded-0">
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('contrats.index') }}" type="button"
                        class="btn btn-info rounded-0 btn-label waves-effect waves-light"><i
                            class="align-middle ri-arrow-drop-left-line label-icon fs-16 me-2"></i> Annuler </a>
    
                </div>
            </div>
        </div>
    @elseif($enseignant and nombreCoursByEnseignantByUfr($enseignant->id,$ufr_id)==0)
        <div class="alert alert-warning alert-dismissible alert-additional fade show mb-3" role="alert">
            <div class="alert-body">
                <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                        <i class="ri-alert-line fs-16 align-middle"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="alert-heading">Pas de cours</h5>
                        <p class="mb-0">Aucun cours n'a été programmé pour cet enseigant.</p>
                    </div>
                </div>
            </div>
            <div class="alert-content">
                <p class="mb-0">Assurez vous que tous les cours de l'enseignant ont été programmés par le servie de la programmation des cours.</p>
            </div>
        </div>
        <div class="border card rounded-0">
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('contrats.index') }}" type="button"
                        class="btn btn-info rounded-0 btn-label waves-effect waves-light"><i
                            class="align-middle ri-arrow-drop-left-line label-icon fs-16 me-2"></i> Annuler </a>
    
                </div>
            </div>
        </div>
    @else

        <div class='repeater'>
            <div data-repeater-list="niveaux">
                @foreach ($cycles as $cycle)
                    @if(count(getCoursByEnseignantByCycleByUfr($enseignant->id,$cycle->id,$ufr_id))>0)
                        <div data-repeater-item>
                            <div class="border card rounded-0">
                                <div class="card-header" style="background-color: #e8effb !important;">
                                    <h2 class="card-title" style="color: #6691e7 !important;">Niveau {{ $cycle->nom }} (Total : {{ getTotalHeureByEnseignantByCycleByUfr($enseignant->id, $cycle->id,$ufr_id)}})</h2>
                                </div>
                                <div class="card-body">
                                    <input type="hidden" name="cycle" value="{{ $cycle->id }}">
                                    <div class="live-preview">
                                        <div class="py-2 row">
                                            @if(nombreCoursSansContratByCycleByUfr($enseignant->id,$cycle->id,$ufr_id ))
                                                <div class="col-md-6" >
                                                    <label for="" class="form-label">Numéro du contrat</label>
                                                    <input type="texte" class="form-control" name="numero" value="">
                                                </div>
                                                <div class="col-md-6" >
                                                    <label for="" class="form-label">Date du contrat</label>
                                                    <input type="text" name="date_contrat" id="datepicker" class="form-control" data-provider="flatpickr" data-date-format="d/m/Y">
                                                </div>
                                            @endif
                                        </div>
                                        <div class="py-2 row">
                                            <div class="col-md-12" >
                                                <div class="card">
                                                    <div class="card-header align-items-center d-flex">
                                                        <h4 class="card-title mb-0 flex-grow-1">Liste des cours programmés </h4>
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
                                                                    @foreach ( getCoursByEnseignantByCycleByUfr($enseignant->id,$cycle->id,$ufr_id) as $cours)
                                                                        <tr>
                                                                            <th scope="row">
                                                                                <div class="form-check">
                                                                                    <input class="form-check-input fs-15" type="checkbox" checked {{ $cours->contrat_id ? 'disabled' : '' }} value="{{ $cours->cours_id }}_{{ $cours->ecue_id }}" name="ecues[]">
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
                            </div>
                        </div>
                    @endif
                @endforeach 
            </div> 
        </div>
         
        <div class="border card rounded-0">
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('contrats.index') }}" type="button"
                        class="btn btn-info rounded-0 btn-label waves-effect waves-light"><i
                            class="align-middle ri-arrow-drop-left-line label-icon fs-16 me-2"></i> Annuler </a>
                    @if(nombreCoursSansContratByUfr($enseignant->id,$ufr_id)>0)
                        <button type="submit" class="btn btn-success rounded-0 btn-label waves-effect waves-light"><i
                            class="align-middle ri-check-line label-icon fs-16 me-2"></i> Enregistrer</button>
                    @endif
    
                </div>
            </div>
        </div>
    @endif  
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

    <script>
        function selectEnseignant(selectObject) {
            var value = selectObject.value;  
            let url = "{{ route('contrats.create', ':id') }}";
            url = url.replace(':id', value);
            document.location.href=url;
        }
    </script>

    <script src="{{ URL::asset('build/js/pages/jquery.repeater.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/form-repeater.int.js') }}"></script>
    <script>
    $(document).ready(function () {
    $('.repeater').repeater({
        initEmpty: false,
        defaultValues: {
            'text-input': 'foo'
        },
        show: function () {
            $(this).slideDown();
        },
        hide: function (deleteElement) {
            if(confirm("Voulez-vous vraiment supprimer l'UE")) {
                $(this).slideUp(deleteElement);
            }
        },
        
        ready: function (setIndexes) {
            $dragAndDrop.on('drop', setIndexes);
        },
        isFirstItemUndeletable: false
    })
    });
    </script>

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
