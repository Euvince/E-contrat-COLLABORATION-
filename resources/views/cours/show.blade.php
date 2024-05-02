@extends('layouts.master')
@section('title')
    Table de spécification - {{ $classe->nom }}
@endsection
@section('css')

@endsection
@section('content')
    <input type="hidden" name="classe" value="{{ $classe->id }}"/>
    <div class="accordion lefticon-accordion custom-accordionwithicon accordion-border-box" id="accordionlefticon">
        @foreach ( getSemestre($classe->niveau) as $semestre)  
            <div class="accordion-item">
                <h2 class="accordion-header" id="accordionlefticonExample{{ $semestre }}">
                    <button class="accordion-button fw-semibold" type="button" data-bs-toggle="collapse" data-bs-target="#accor_lefticonExamplecollapse{{ $semestre }}" aria-expanded="true" aria-controls="accor_lefticonExamplecollapse{{ $semestre }}">
                        Semestre {{ $semestre }}
                    </button>
                </h2>
                <div id="accor_lefticonExamplecollapse{{ $semestre }}" class="accordion-collapse collapse show" aria-labelledby="accordionlefticonExample{{ $semestre }}" data-bs-parent="#accordionlefticon" style="">
                    <div class="accordion-body">
                        <div class="" id="accordionFlushExample">

                            <div class="accordion custom-accordionwithicon accordion-border-box" id="accordionnesting">
                                @foreach (getCoursByClasseBySemestre($classe->id,$semestre) as $cours)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="accordionnestingExample{{ $cours->id }}">
                                            <button class="accordion-button fw-semibold collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#accor_nestingExamplecollapse{{ $cours->id }}" aria-expanded="false" aria-controls="accor_nestingExamplecollapse{{ $cours->id }}">
                                                {{ $cours->code_ue }} {{ $cours->ue->nom }} (Crédit : {{ $cours->credit }})
                                            </button>
                                        </h2>
                                        <div id="accor_nestingExamplecollapse{{ $cours->id }}" class="accordion-collapse collapse" aria-labelledby="accordionnestingExample{{ $cours->id }}" data-bs-parent="#accordionnesting" style="">
                                            <div class="accordion-body">
                                                <div class="list-group">
                                                    @if($cours->ecue1)
                                                        <div class="list-group-item">
                                                            <div class="float-end">
                                                                Masse horaire :  {{ $cours->heure_theorique1 }}
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-grow-1">
                                                                    <h5 class="list-title fs-15">{{ $cours->code_ecue1 }} {{ rechercherEcue($cours->ecue1)->nom }}</h5>
                                                                    <p class="list-text mb-0 fs-12">Enseignant : {{$cours->enseignant1 ? rechercherEnseignant($cours->enseignant1)->nom : '' }} {{ $cours->enseignant1 ? rechercherEnseignant($cours->enseignant1) ->prenoms : ''}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                    @if($cours->ecue2)
                                                        <div class="list-group-item">
                                                            <div class="float-end">
                                                                Masse horaire :  {{ $cours->heure_theorique2 }}
                                                            </div>
                                                            <div class="d-flex align-items-center">
                                                                <div class="flex-grow-1">
                                                                    <h5 class="list-title fs-15">{{ $cours->code_ecue2 }}  {{ rechercherEcue($cours->ecue2)->nom }}</h5>
                                                                    <p class="list-text mb-0 fs-12">Enseignant : {{$cours->enseignant2 ? rechercherEnseignant($cours->enseignant2)->nom : '' }} {{ $cours->enseignant2 ? rechercherEnseignant($cours->enseignant2)->prenoms : ''}}</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
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

    <div class="px-2 py-3 mt-3 bg-light d-flex justify-content-between">
        <a href="{{ route('cours.index') }}" type="button"
            class="btn btn-info rounded-0 btn-label waves-effect waves-light"><i
                class="align-middle ri-arrow-drop-left-line label-icon fs-16 me-2"></i> Annuler </a>
        <a href="{{ route('cours.edit', ['classe' => $classe->slug]) }}">
            <button type="submit" class="btn btn-success rounded-0 btn-label waves-effect waves-light"><i
                class="align-middle ri-check-line label-icon fs-16 me-2"></i> Modifier</button>
        </a>

    </div>

@endsection

@section('script')

@endsection
