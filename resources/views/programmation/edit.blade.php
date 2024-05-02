@extends('layouts.master')
@section('title')
    Programmation des cours
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')

<div class="row">
    <div class="col-xxl-12">
        <div class="card">
            <div class="card-header align-items-center d-flex card-primary">
                <h4 class="card-title mb-0 flex-grow-1">{{ $classe->nom }}</h4>
            </div><!-- end card header -->
            <div class="card-body">

                <div class="live-preview">
                    <div class="">
                        @foreach ( getSemestre($classe->niveau) as $semestre)
                            <div class="border card rounded-0">
                                <div class="card-header" style="background-color: #e8effb !important;">
                                    <h2 class="card-title" style="color: #6691e7 !important;">Semestre {{ $semestre}}</h2>
                                </div>
                                <div class="card-body">
                                    <div class="live-preview">
                                        <div class="" id="accordionFlushExample">

                                            <div class="accordion custom-accordionwithicon accordion-border-box" id="accordionnesting">
                                                @foreach (getProgrammationByClasseBySemestre($classe->id,$semestre) as $cours)
                                                    <div class="accordion-item">
                                                        <h2 class="accordion-header" id="accordionnestingExample{{ $cours->id }}">
                                                            <button class="accordion-button fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse{{ $cours->id }}" aria-expanded="false" aria-controls="accor_nestingExamplecollapse{{ $cours->id }}">
                                                                {{ $cours->ue->nom }} (Crédit : {{ $cours->credit }})
                                                            </button>
                                                        </h2>
                                                        <div id="accor_nestingExamplecollapse{{ $cours->id }}" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample{{ $cours->id }}" data-bs-parent="#accordionnesting" style="">
                                                            <div class="accordion-body">
                                                                <div class="table-responsive mb-3">
                                                                    <table class="table table-striped table-nowrap align-middle mb-0">
                                                                        <thead>
                                                                            <tr>
                                                                                <th scope="col">ECUE</th>
                                                                                <th scope="col">Enseignant</th>
                                                                                <th scope="col">Masse horaire</th>
                                                                                <th scope="col">Exécuté</th>
                                                                                <th scope="col">Date début</th>
                                                                                <th scope="col">Date fin</th>
                                                                                <th scope="col">Status</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody>
                                                                            @if($cours->ecue1)
                                                                                <tr>
                                                                                    <td>{{ rechercherEcue($cours->ecue1)->nom }}</td>
                                                                                    <td>{{$cours->enseignant1 ? rechercherEnseignant($cours->enseignant1)->nom : '' }} {{ $cours->enseignant1 ? rechercherEnseignant($cours->enseignant1) ->prenoms : ''}}</td>
                                                                                    <td>{{ $cours->heure_theorique1 }}</td>
                                                                                    <td>{{ $cours->heure_execute1 }}</td>
                                                                                    <td>{{ $cours->date_debut1 ? date('d/m/Y', strtotime($cours->date_debut1)) : ''}}</td>
                                                                                    <td>{{ $cours->date_fin1 ? date('d/m/Y', strtotime($cours->date_fin1)) : ''}}</td>
                                                                                    <td><span class="badge bg-{{ getStatusColor($cours->etat1, $cours->date_debut1) }}">{{ getStatus($cours->etat1, $cours->date_debut1) }}</span></td>
                                                                                </tr>
                                                                            @endif
                                                                            @if($cours->ecue2)
                                                                                <tr>
                                                                                    <td>{{ rechercherEcue($cours->ecue2)->nom }}</td>
                                                                                    <td>{{$cours->enseignant2 ? rechercherEnseignant($cours->enseignant2)->nom : '' }} {{ $cours->enseignant2 ? rechercherEnseignant($cours->enseignant2) ->prenoms : ''}}</td>
                                                                                    <td>{{ $cours->heure_theorique2 }}</td>
                                                                                    <td>{{ $cours->heure_execute2 }}</td>
                                                                                    <td>{{ $cours->date_debut2 ? date('d/m/Y', strtotime($cours->date_debut2)) : ''}}</td>
                                                                                    <td>{{ $cours->date_fin2 ? date('d/m/Y', strtotime($cours->date_fin2)) : ''}}</td>
                                                                                    <td><span class="badge bg-{{ getStatusColor($cours->etat2, $cours->date_debut2) }}">{{ getStatus($cours->etat2, $cours->date_debut2) }}</span></td>
                                                                                </tr>
                                                                            @endif
                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                                <a href="{{ route('programmation.programmer', ['cours' => $cours->id ]) }}">
                                                                    <button type="button" class="btn btn-primary add-btn">
                                                                        <i class="ri-edit-line"></i> Programmer l'UE {{ $cours->ue->nom }}
                                                                    </button>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                </div>

                <div class="card-footer">
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('programmations.index') }}" type="button"
                            class="btn btn-info rounded-0 btn-label waves-effect waves-light"><i
                                class="align-middle ri-arrow-drop-left-line label-icon fs-16 me-2"></i> Annuler </a>

                    </div>
                </div>

            </div><!-- end card-body -->
        </div><!-- end card -->
    </div>
    <!--end col-->
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
