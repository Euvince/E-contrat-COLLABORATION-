@extends('layouts.master')
@section('title')
Les contrats d'un enseignant
@endsection
@section('css')
<link href="{{ URL::asset('build/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    @php
        $etat = 0;
    @endphp
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
                        @if($enseignant)
                            <div class="col-md-12 mt-3">
                                <div class="d-flex justify-content-between">
                                    <a href="{{ route('contrats.create',['enseignant_id' => encryptid($enseignant->id)]) }}">
                                        <button type="button" class="btn btn-success add-btn">
                                            <i class="align-bottom ri-add-line me-1"></i> Créer un contrat
                                        </button>
                                    </a>
                                    <a href="{{ route('enseignants.show',['enseignant' => $enseignant->slug]) }}" target="_blank" >
                                        <button type="button" class="btn btn-primary rounded-0 btn-label waves-effect waves-light"><i
                                            class="align-middle ri-eye-line label-icon fs-16 me-2"></i> Voir les détails de l'enseignant </button>
                                    </a>                    
                                </div>
                            </div>
                        @endif
                    </div>  
                </div>
            </div>
        </div>
    </form>

    @if($enseignant===null)
        <div class="alert alert-primary alert-dismissible alert-additional fade show mb-3" role="alert">
            <div class="alert-body">
                <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                        <i class="ri-alert-line fs-16 align-middle"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="alert-heading">Choisir un enseignant</h5>
                        <p class="mb-0">Veuillez choisir un enseignant dans la liste pour afficher tous ses contrats.</p>
                    </div>
                </div>
            </div>
            <div class="alert-content">
                <p class="mb-0">Assurez vous que vous avez créer tous les contrats de cet enseignant</p>
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
        @foreach ( $contrats as $contrat)
            @if(count(getCoursByContrat($contrat->id)) > 0)
                @php
                    $etat+=1;
                @endphp

                <div class="row">
                    <div class="col-md-12" >
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">{{ $contrat->numero ? $contrat->numero : 'Contrat sans numéro' }} - {{ $contrat->cycle->nom }} - Total : {{ getTotalHeureByContrat($contrat->id, $enseignant->id, $contrat->cycle_id) }}H</h4>
                                <div class="flex-shrink-0">
                                    <div class="dropdown card-header-dropdown">
                                        <a class="text-reset dropdown-btn" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <span class="text-muted">Actions<i class="mdi mdi-dots-vertical"></i></span>
                                        </a>
                                        <div class="dropdown-menu dropdown-menu-end" style="">
                                            <a class="dropdown-item" href="{{ route('contrats.imprimer',['contrat_id' => encryptid($contrat->id)]) }}"><i class="mdi mdi-printer"></i>Imprimer</a>
                                            <a class="dropdown-item" href="{{ route('contrats.telecharger',['contrat_id' => encryptid($contrat->id)]) }}"><i class="mdi mdi-download"></i>Télécharger</a>
                                            <a class="dropdown-item" href="{{ route('contrats.edit',['contrat_id' => encryptid($contrat->id)]) }}"><i class="mdi mdi-pencil-outline"></i> Modifier</a>
                                            <a class="dropdown-item delete-contrat" href="{{ route('contrats.destroy',['contrat_id' => encryptid($contrat->id)]) }}"><i class="mdi mdi-trash-can-outline"></i>Supprimer</a>
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12" >
                                        <div class="table-responsive table-card">
                                            <table class="table table-borderless table-hover table-nowrap align-middle mb-0">
                                                <thead class="table-light">
                                                    <tr class="text-muted">
                                                        <th scope="col">Département</th>
                                                        <th scope="col">Filière</th>
                                                        <th scope="col">Classe</th>
                                                        <th scope="col">UE</th>
                                                        <th scope="col">ECUE</th>
                                                        <th scope="col">Masse</th>
                                                        <th scope="col">Date début</th>
                                                        <th scope="col">Date fin</th>
                                                    </tr>
                                                </thead>
        
                                                <tbody>
                                                    @foreach ( getCoursByContrat($contrat->id) as $cours)
                                                        <tr>
                                                            <td>{{ rechercherClasse($cours->classe_id)->filiere->departement->nom }}</td>
                                                            <td>{{ rechercherClasse($cours->classe_id)->filiere->code }}</td>
                                                            <td>{{ rechercherClasse($cours->classe_id)->code }}</td>
                                                            <td>{{ rechercherUe($cours->ue_id)->nom }}</td>
                                                            <td> {{ rechercherEcue($cours->ecue_id)->nom }}</td>
                                                            <td>{{ $cours->heure_theorique }}</td>
                                                            <td>{{ $cours->date_debut ? date('d/m/Y', strtotime($cours->date_debut)) : ''}}</td>
                                                            <td>{{ $cours->date_fin ? date('d/m/Y', strtotime($cours->date_fin)) :''}}</td>
                                                        </tr>
                                                    @endforeach
                                                </tbody><!-- end tbody -->
                                            </table><!-- end table -->
                                        </div>
                                    </div>
                                </div>
                            </div><!-- end card body -->
                        </div><!-- end card -->
                    </div><!-- end col -->
                </div>
            @endif
            
        @endforeach
    @endif

    @if($etat==0 and $enseignant !=null)
        <div class="alert alert-warning alert-dismissible alert-additional fade show mb-3" role="alert">
            <div class="alert-body">
                <div class="d-flex">
                    <div class="flex-shrink-0 me-3">
                        <i class="ri-alert-line fs-16 align-middle"></i>
                    </div>
                    <div class="flex-grow-1">
                        <h5 class="alert-heading">Pas de contrat</h5>
                        <p class="mb-0">Aucun contrat n'a été trouvé pour cet enseigant.</p>
                    </div>
                </div>
            </div>
            <div class="alert-content">
                <p class="mb-0">Assurez vous que vous avez créé les contrats pour ce enseignant.</p>
            </div>
        </div>
        <div class="border card rounded-0">
            <div class="card-footer">
                <div class="d-flex justify-content-between">
                    <a href="{{ route('contrats.index') }}" type="button"
                        class="btn btn-info rounded-0 btn-label waves-effect waves-light"><i
                            class="align-middle ri-arrow-drop-left-line label-icon fs-16 me-2"></i> Annuler </a>
                            <a href="{{ route('contrats.index') }}" type="button"
                            class="btn btn-success rounded-0 btn-label waves-effect waves-light"><i
                                class="align-middle ri-arrow-drop-left-line label-icon fs-16 me-2"></i> Créer un contrat </a>
    
                </div>
            </div>
        </div>
    @endif



@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="{{ URL::asset('build/js/pages/select2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
        $('.select2-enseignant').select2({
            tags: false,
            placeholder: "Sélectionner un enseignant",
        });
    </script>

    <script>
        function selectEnseignant(selectObject) {
            var value = selectObject.value;  
            let url = "{{ route('contrats.show', ':id') }}";
            url = url.replace(":id", value);
            document.location.href=url;
        }
    </script>

    <script>
        $(".delete-contrat").on("click", function (e) {
            e.preventDefault();
            Swal.fire({
                title: "Voulez-vous vraiment supprimer cet contrat ?",
                text: "Toutes les données liées à ce contrat seront définitivement perdues",
                icon: "error",
                confirmButtonText: "Supprimer",
                cancelButtonText: "Annuler",
                confirmButtonClass: "btn btn-danger w-xs me-2 mt-2",
                cancelButtonClass: "btn btn-info w-xs mt-2",
                showCancelButton: true,
                buttonsStyling: false,
                showCloseButton: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = $(this).attr('href');
                    }
                });
        });
    </script>

@endsection
