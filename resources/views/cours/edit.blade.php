@extends('layouts.master')
@section('title')
    Table de spécification - {{ $classe->nom }}
@endsection
@section('css')
<link href="{{ URL::asset('build/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

<form action="{{ route('cours.copier') }}" method="post">
    @csrf
    <input type="hidden" name="classe" value="{{ $classe->id }}"/>
    <div class="border card rounded-0">
        <div class="card-body">
            <div class="row">
                <label for="" class="form-label">Copier les TS à partir d'une autre classe</label>
                <div class="col-12">
                    <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                        <div class="flex-grow-1">
                            <select class="select2-classe" name="source_classe" required>
                                <option value="">Selectionner une classe</option>
                                    @foreach ($classes as $c)
                                        @if($c->id != $classe->id)
                                            <option value="{{ $c->id }}">{{ $c->nom }}</option>
                                        @endif
                                    @endforeach
                            </select>
                        </div>
                        <div class="mt-3 mt-lg-0" style="margin-left: 10px;">
                            <button type="submit" class="btn btn-success rounded-0 btn-label waves-effect waves-light"><i
                                class="align-middle ri-check-line label-icon fs-16 me-2"></i> Copier</button>
                        </div>
                    </div><!-- end card header -->
                </div>
                <!--end col-->
            </div>
        </div>
    </div>
</form>
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

<form action="{{ route('cours.store') }}" method="post">
    @csrf
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
                                <div class="accordion-flush" id="accordionFlushExample">
                                    <div class='repeater'>
                                        <div data-repeater-list="programmation{{ $semestre }}">
                                            @if(count(getCoursByClasseBySemestre($classe->id,$semestre))>0)
                                                @foreach ( getCoursByClasseBySemestre($classe->id,$semestre) as $cours)
                                                    <div data-repeater-item>
                                                        <div class="border card rounded-0">
                                                            <div class="card-body">
                                                                <div class="py-2 row">
                                                                    <div class="mb-3 col-md-2">
                                                                        <label for="" class="form-label">Code de l'UE</label>
                                                                        <input type="text" class="form-control" name="code_ue" value="{{ $cours->code_ue }}" >
                                                                        @error('programmation'.$semestre.'.*.code_ue')
                                                                        Veuillez saisir le code de l'UE
                                                                            <span class="text-danger"> {{ $errors->first('programmation'.$semestre.'.*.code_ue') }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="mb-3 col-md-8">
                                                                        <h2 class="card-title">Unité d'Enseignement</h2>
                                                                        <select class="select2-ue" name="ue">
                                                                            <option value="">Sélectionner une UE</option>
                                                                            @foreach ($ues as $ue)
                                                                                <option value="{{ $ue->id }}" {{ $cours->ue_id == $ue->id ? 'selected' : '' }}>{{ $ue->nom }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('ue')
                                                                            <span class="text-danger"> {{ $errors->first('ue') }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="mb-3 col-md-2">
                                                                        <label for="" class="form-label">Crédit</label>
                                                                        <input type="text" class="form-control" name="credit" value="{{ $cours->credit }}" >
                                                                        @error('programmation'.$semestre.'.*.credit')
                                                                        Veillez entrer le crédit de l'UE
                                                                            <span class="text-danger"> {{ $errors->first('programmation'.$semestre.'.*.credit') }}</span>
                                                                        @enderror
                                                                    </div>

                                                                    <hr/>
                                                                    <div class="mb-3 col-md-2">
                                                                        <label for="" class="form-label">Code de l'EC1</label>
                                                                        <input type="text" class="form-control" name="code_ecue1" value="{{ $cours->code_ecue1 }}" >
                                                                        @error('programmation'.$semestre.'.*.code_ecue1')
                                                                        Veuillez saisir le code de l'EC
                                                                            <span class="text-danger"> {{ $errors->first('programmation'.$semestre.'.*.code_ecue1') }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="mb-3 col-md-4">
                                                                        <label for="" class="form-label">Elément constitutif 1</label>
                                                                        <select class="select2-ecue" name="ecue1">
                                                                            <option value="">Selectionner un EC</option>
                                                                            @foreach ($ecues as $ecue)
                                                                                <option value="{{ $ecue->id }}" {{ $cours->ecue1==$ecue->id ? 'selected' : '' }}>{{ $ecue->nom }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('ecue1')
                                                                            <span class="text-danger"> {{ $errors->first('ecue1') }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="mb-3 col-md-4">
                                                                        <label for="" class="form-label">Enseignant</label>
                                                                        <select class="select2-enseignant" name="enseignant1">
                                                                            <option value="">Selectionner un enseignant</option>
                                                                            @foreach (getEnseignantsByUfr(getUfr()->id) as $enseignant)
                                                                                <option value="{{ $enseignant->id }}" {{ $cours->enseignant1==$enseignant->id ? 'selected' : '' }}>{{ $enseignant->nom }} {{ $enseignant->prenoms }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('enseignant1')
                                                                            <span class="text-danger"> {{ $errors->first('enseignant1') }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="mb-3 col-md-2">
                                                                        <label for="" class="form-label">Masse horaire</label>
                                                                        <input type="text" class="form-control" name="masse1" value="{{ $cours->heure_theorique1 }}">
                                                                        @error('masse1')
                                                                            <span class="text-danger"> {{ $errors->first('masse1') }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <hr/>
                                                                    <div class="mb-3 col-md-2">
                                                                        <label for="" class="form-label">Code de l'EC2</label>
                                                                        <input type="text" class="form-control" name="code_ecue2" value="{{ $cours->code_ecue2 }}" >
                                                                        @error('programmation'.$semestre.'.*.code_ecue2')
                                                                        Veuillez saisir le code de l'EC
                                                                            <span class="text-danger"> {{ $errors->first('programmation'.$semestre.'.*.code_ecue2') }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="mb-3 col-md-4">
                                                                        <label for="" class="form-label">Elément constitutif 2</label>
                                                                        <select class="select2-ecue" name="ecue2">
                                                                            <option value="">Selectionner un EC</option>
                                                                            @foreach ($ecues as $ecue)
                                                                                <option value="{{ $ecue->id }}" {{ $cours->ecue2==$ecue->id ? 'selected' : '' }}>{{ $ecue->nom }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                    </div>
                                                                    <div class="mb-3 col-md-4">
                                                                        <label for="" class="form-label">Enseignant</label>
                                                                        <select class="select2-enseignant" name="enseignant2">
                                                                            <option value="">Selectionner un enseignant</option>
                                                                            @foreach (getEnseignantsByUfr(getUfr()->id) as $enseignant)
                                                                                <option value="{{ $enseignant->id }}" {{ $cours->enseignant2==$enseignant->id ? 'selected' : '' }}>{{ $enseignant->nom }} {{ $enseignant->prenoms }}</option>
                                                                            @endforeach
                                                                        </select>
                                                                        @error('enseignant2')
                                                                            <span class="text-danger"> {{ $errors->first('enseignant2') }}</span>
                                                                        @enderror
                                                                    </div>
                                                                    <div class="mb-3 col-md-2">
                                                                        <label for="" class="form-label">Masse horaire</label>
                                                                        <input type="text" class="form-control" name="masse2" value="{{ $cours->heure_theorique2}}">
                                                                        @error('masse2')
                                                                            <span class="text-danger"> {{ $errors->first('masse2') }}</span>
                                                                        @enderror
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="card-footer">
                                                                <input data-repeater-delete type="button"  class="btn btn-danger" value="Supprimer l'UE"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            @else
                                                <div data-repeater-item>
                                                    <div class="border card rounded-0">
                                                        <div class="card-body">
                                                            <div class="py-2 row">
                                                                <div class="mb-3 col-md-2">
                                                                    <label for="" class="form-label">Code de l'UE</label>
                                                                    <input type="text" class="form-control" name="code_ue" >
                                                                    @error('programmation'.$semestre.'.*.code_ue')
                                                                    Veuillez saisir le code de l'UE
                                                                        <span class="text-danger"> {{ $errors->first('programmation'.$semestre.'.*.code_ue') }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3 col-md-8">
                                                                    <h2 class="card-title">Unité d'Enseignement</h2>
                                                                    <select class="select2-ue" name="ue">
                                                                        <option value="">Sélectionner une UE</option>
                                                                        @foreach ($ues as $ue)
                                                                            <option value="{{ $ue->id }}">{{ $ue->nom }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3 col-md-2">
                                                                    <label for="" class="form-label">Crédit</label>
                                                                    <input type="text" class="form-control" name="credit" >
                                                                </div>

                                                                <hr/>
                                                                <div class="mb-3 col-md-2">
                                                                    <label for="" class="form-label">Code de l'EC1</label>
                                                                    <input type="text" class="form-control" name="code_ecue1" >
                                                                    @error('programmation'.$semestre.'.*.code_ecue1')
                                                                    Veuillez saisir le code de l'EC
                                                                        <span class="text-danger"> {{ $errors->first('programmation'.$semestre.'.*.code_ecue1') }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3 col-md-4">
                                                                    <label for="" class="form-label">Elément constitutif 1</label>
                                                                    <select class="select2-ecue" name="ecue1">
                                                                        <option value="">Selectionner un EC</option>
                                                                        @foreach ($ecues as $ecue)
                                                                            <option value="{{ $ecue->id }}">{{ $ecue->nom }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3 col-md-4">
                                                                    <label for="" class="form-label">Enseignant</label>
                                                                    <select class="select2-enseignant" name="enseignant1">
                                                                        <option value="">Selectionner un enseignant</option>
                                                                        @foreach (getEnseignantsByUfr(getUfr()->id) as $enseignant)
                                                                            <option value="{{ $enseignant->id }}">{{ $enseignant->nom }} {{ $enseignant->prenoms }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3 col-md-2">
                                                                    <label for="" class="form-label">Masse horaire</label>
                                                                    <input type="text" class="form-control" name="masse1">
                                                                </div>
                                                                <hr/>
                                                                <div class="mb-3 col-md-2">
                                                                    <label for="" class="form-label">Code de l'EC2</label>
                                                                    <input type="text" class="form-control" name="code_ecue2" >
                                                                    @error('programmation'.$semestre.'.*.code_ecue2')
                                                                    Veuillez saisir le code de l'EC
                                                                        <span class="text-danger"> {{ $errors->first('programmation'.$semestre.'.*.code_ecue2') }}</span>
                                                                    @enderror
                                                                </div>
                                                                <div class="mb-3 col-md-4">
                                                                    <label for="" class="form-label">Elément constitutif 2</label>
                                                                    <select class="select2-ecue" name="ecue2">
                                                                        <option value="">Selectionner un EC</option>
                                                                        @foreach ($ecues as $ecue)
                                                                            <option value="{{ $ecue->id }}">{{ $ecue->nom }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3 col-md-4">
                                                                    <label for="" class="form-label">Enseignant</label>
                                                                    <select class="select2-enseignant" name="enseignant2">
                                                                        <option value="">Selectionner un enseignant</option>
                                                                        @foreach (getEnseignantsByUfr(getUfr()->id) as $enseignant)
                                                                            <option value="{{ $enseignant->id }}">{{ $enseignant->nom }} {{ $enseignant->prenoms }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="mb-3 col-md-2">
                                                                    <label for="" class="form-label">Masse horaire</label>
                                                                    <input type="text" class="form-control" name="masse2">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="card-footer">
                                                            <input data-repeater-delete type="button"  class="btn btn-danger" value="Supprimer l'UE"/>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                        <input data-repeater-create type="button" class="btn btn-primary repeater-button" value="Ajouter une UE" />
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
        <button type="submit" class="btn btn-success rounded-0 btn-label waves-effect waves-light"><i
                class="align-middle ri-check-line label-icon fs-16 me-2"></i> Enregistrer</button>

    </div>
</form>

@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="{{ URL::asset('build/js/pages/select2.min.js') }}"></script>

    <script>
    $('.select2-ue').select2({
        tags: true,
        placeholder: "Sélectionner une UE",
    });
    $('.select2-ecue').select2({
        tags: true,
        placeholder: "Sélectionner un EC",
    });
    $('.select2-enseignant').select2({
        tags: false,
        placeholder: "Sélectionner un ensignant",
    });

    $('.select2-classe').select2({
        tags: false,
        placeholder: "Sélectionner une classe",
    });
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

    <script type="text/javascript">
        $(".repeater-button").click(function(){
        setTimeout(function(){

            $('.select2-container').remove();
            $('.select2-ue').select2({
                placeholder: "Sélectionner une UE",
                tags: true,
                allowClear: true
            });
            $('.select2-ecue').select2({
                placeholder: "Sélectionner un EC",
                tags: true,
                allowClear: true
            });
            $('.select2-enseignant').select2({
                placeholder: "Sélectionner un enseignant",
                allowClear: true
            });
            $('.select2-classe').select2({
                placeholder: "Sélectionner une classe",
                allowClear: true
            });
            $('.select2-container').css('width','100%');

        }, 100);
    });
    </script>

    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
@endsection
