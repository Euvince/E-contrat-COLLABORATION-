@extends('layouts.master')
@section('title')
Cahier de texte - {{ $classe->nom }}
@endsection
@section('subtitle')
Département : {{ $classe->filiere->departement->nom }}
@endsection
@section('subsubtitle')
Filière : {{ $classe->filiere->nom }}
@endsection
@section('css')
<link href="{{ URL::asset('build/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
<div class="row">
    <div class="col">

        <div class="h-100">
            <div class="row">
                <div class="col-xl-12">
                    <div class="border card rounded-0">
                        <div class="card-body">
                            <div class="live-preview">
                                <div class="py-2 row">
                                    <div class="col-md-12">
                                        <h6>Sélectionner un cours</h6>
                                        <select class="select2-cours" name="cours" onchange="selectCours(this)">
                                            <option value="">Sélectionner un cours</option>
                                            @foreach ($ecues as $e)
                                                <option value="{{ rechercherEcue($e->ecue_id)->slug }}/{{ $classe->slug }}/{{ encryptid($e->id) }}" {{ ($ecue and $e->ecue_id == $ecue->id) ? 'selected' : '' }}>{{ rechercherEcue($e->ecue_id)->nom }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div> 
                </div>
            </div> <!-- end row-->

            @if($cours)

                <div class="row">
                    @if(Auth::user()->hasRole('Responsable'))
                        <div class="mb-3">
                            <a href="{{ route('cahier.create',['ecue'=>$ecue->slug, 'programmation_id'=>encryptid($cours->id)]) }}">
                                <button type="button" class="btn btn-success add-btn">
                                    <i class="align-bottom ri-add-line me-1"></i> Ajouter un cours au cahier de texte
                                </button>
                            </a>
                        </div>
                    @endif
                    <div class="col-xl-12">
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">Enseignant : {{ $enseignant->nom }} {{ $enseignant->prenoms }}</h4>
                                    <div>
                                        <h4 class="card-title mb-0 flex-grow-1">Masse horaire : {{ $masse }}H</h4>
                                    </div>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="table-responsive table-card">
                                        <table class="table table-borderless table-hover table-nowrap align-middle mb-0">
                                            <thead class="table-light">
                                                <tr class="text-muted">
                                                    <th scope="col">Date</th>
                                                    <th scope="col">Heure début</th>
                                                    <th scope="col">Heure fin</th>
                                                    <th scope="col">Durée</th>
                                                    <th scope="col">Cumul</th>
                                                    @if(Auth::user()->hasRole('Responsable'))
                                                        <th scope="col" style="width: 10px;">Action</th>
                                                    @endif
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @php $cumul=0; @endphp
                                                @foreach ( $cahiers as $cahier)
                                                @php $cumul+= $cahier->duree; @endphp
                                                    <tr>
                                                        <td>{{ $cahier->date ? date('d/m/Y', strtotime($cahier->date)) : ''}}</td>
                                                        <td> {{ $cahier->heure_debut ? date('H:i', strtotime($cahier->heure_debut)) : '' }}</td>
                                                        <td> {{ $cahier->heure_fin ? date('H:i', strtotime($cahier->heure_fin)) : '' }}</td>
                                                        <td>{{ $cahier->duree }}</td>
                                                        <td>{{ $cumul }}</td>
                                                        @if(Auth::user()->hasRole('Responsable'))
                                                            <td>
                                                                <a href="{{ route('cahier.edit',['cahier_id'=>encryptid($cahier->id)]) }}"
                                                                    type="button" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                    title="Modifier"
                                                                    class="mb-1 ms-1 btn btn-sm btn-info btn-icon waves-effect waves-light"><i
                                                                        class="ri-edit-line"></i></a>
                                                                <a href="{{ route('cahier.destroy',['cahier_id'=>encryptid($cahier->id)]) }}" type="button" 
                                                                    data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                                    title="Supprimer"
                                                                    class="mb-1 ms-1 btn delete-cahier btn-sm btn-danger btn-icon waves-effect waves-light"><i
                                                                        class="ri-close-line"></i></a>
                                                            </td>
                                                        @endif
                                                    </tr>
                                                @endforeach
                                            </tbody><!-- end tbody -->
                                        </table><!-- end table -->
                                    </div><!-- end table responsive -->
                                </div><!-- end card body -->
                            </div>
                        </div>
                </div> <!-- end row-->
            @else
                <div class="alert alert-primary alert-dismissible alert-additional fade show mb-3" role="alert">
                    <div class="alert-body">
                        <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                                <i class="ri-alert-line fs-16 align-middle"></i>
                            </div>
                            <div class="flex-grow-1">
                                <h5 class="alert-heading">Choisir un cours</h5>
                                <p class="mb-0">Veuillez choisir un cours pour afficher ces détails.</p>
                            </div>
                        </div>
                    </div>
                    <div class="alert-content">
                        <p class="mb-0">Assurez vous de remplir tours les cours que vous faites</p>
                    </div>
                </div>
            @endif


        </div> <!-- end .h-100-->

    </div> <!-- end col -->
</div>
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="{{ URL::asset('build/js/pages/select2.min.js') }}"></script>

    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/customs/cahier.js') }}"></script>

    <script>
        $('.select2-cours').select2({
            tags: false,
            placeholder: "Sélectionner un cours",
        });
    </script>

    <script>
        function selectCours(selectObject) {
            var value = selectObject.value; 
            let url = "{{ route('cahier', ':id') }}";
            url = url.replace(':id', value);
            document.location.href=url;
        }
    </script>
@endsection
