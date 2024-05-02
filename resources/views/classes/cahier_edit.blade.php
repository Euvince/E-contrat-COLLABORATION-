@extends('layouts.master')
@section('title')
Cahier de texte - {{ $cahier->programmation->classe->nom }}
@endsection
@section('subtitle')
Département : {{ $cahier->programmation->classe->filiere->departement->nom }}
@endsection
@section('subsubtitle')
Filière : {{ $cahier->programmation->classe->filiere->nom }}
@endsection
@section('css')
<link rel="stylesheet" href="{{ URL::asset('build/css/flatpickr.min.css')}}">
@endsection
@section('content')
    <form action="{{ route('cahier.update',['cahier_id'=>encryptid($cahier->id)]) }}" method="post">
        @csrf
        <div class="card">
            <div class="card-header align-items-center d-flex">
                <h4 class="card-title mb-0 flex-grow-1">Matière : {{ $cahier->ecue->nom }}</h4>
            </div><!-- end card header -->

            <div class="card-body">
                <div class="row">
                    <div class="mb-3 col-md-12">
                        <label for="" class="form-label">Date *</label>
                        <input  type="text" value="{{ $cahier->date ? date('d/m/Y', strtotime($cahier->date)) : ''}}" name="date" id="datepicker" class="form-control" data-provider="flatpickr" data-date-format="d/m/Y">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="" class="form-label">Heure début *</label>
                        <input  type="text" value="{{ $cahier->heure_debut }}" name="heure_debut" id="timepicker" class="form-control" data-provider="flatpickr" data-date-format="d/m/Y">
                    </div>
                    <div class="mb-3 col-md-6">
                        <label for="" class="form-label">Heure fin *</label>
                        <input  type="text" value="{{ $cahier->heure_fin }}" name="heure_fin" id="timepicker" class="form-control" data-provider="flatpickr" data-date-format="d/m/Y">
                    </div>
                    <div class="mb-3 col-md-12">
                        <label for="" class="form-label">Libellé *</label>
                        <textarea class="ckeditor-classic" name="libelles">{{ $cahier->libelles }}</textarea>
                    </div>
                </div>
            </div><!-- end card body -->

            <div class="card-footer">
                <div class="px-2 py-3 mt-3 bg-light d-flex justify-content-between">
                    <a href="{{ route('cahier',['ecue'=>$cahier->ecue->slug, 'programmation_id'=>encryptid($cahier->programmation_id)]) }}" type="button"
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

        flatpickr("#timepicker", {
            enableTime: true, // Enable time selection
            noCalendar: true,
            enableSeconds: false,
            dateFormat: "H:i", // Customize the date and time format as needed
            locale : "fr",
        });
    </script>
    <script src="{{ URL::asset('build/libs/@ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/form-editor.init.js') }}"></script>
@endsection