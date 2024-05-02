@extends('layouts.master')
@section('title')
    Modifier une filière
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    <div class="card rounded-0 ">
        <div class="card-header">
            <h2 class="card-title">
                {{ $filiere->nom }}
            </h2>
        </div>
        <div class="card-body">
            <form action="{{ route('filieres.update', ['filiere' => $filiere->slug]) }}" method="post">
                @method('put')
                @csrf
                <div class="py-2 row d-flex justify-content-center">


                    {{-- <div class="mb-3 col-md-12">
                        <label for="basiInput" class="form-label">Code de la filière</label>
                        <input type="text" class="form-control @error('code') is-invalid @enderror" name="code"
                            value="{{ $filiere->code }}" id="basiInput">
                        @error('code')
                            <span class="text-danger"> {{ $errors->first('code') }}</span>
                        @enderror
                    </div> --}}

                    <div class="mb-3 col-md-12">
                        <label for="basiInput" class="form-label">Nom de la filière</label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom"
                            value="{{ $filiere->nom }}" id="basiInput">
                        @error('nom')
                            <span class="text-danger"> {{ $errors->first('nom') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="basiInput" class="form-label">Nom du département</label>
                        <select class="form-control" id="departement_id" name="departement_id" required>
                            <option value="">Sélectionner le nom du département</option>
                            @foreach ($departements as $departement)
                                <option value="{{ $departement->id }}">{{ $departement->nom }}</option>
                            @endforeach
                        </select>
                        @error('departement_id')
                        <span class="text-danger"> {{ $errors->first('departement_id') }}</span>
                    @enderror
                    </div>

                </div>
                <div class="px-2 py-3 mt-3 bg-light d-flex justify-content-between">
                    <a href="{{ route('filieres.index') }}" type="button"
                        class="btn btn-info rounded-0 btn-label waves-effect waves-light"><i
                            class="align-middle ri-arrow-drop-left-line label-icon fs-16 me-2"></i> Annuler </a>

                    <button type="submit" class="btn btn-success rounded-0 btn-label waves-effect waves-light"><i
                            class="align-middle ri-check-line label-icon fs-16 me-2"></i> Modifier</button>

                </div>
            </form>

        </div>
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
