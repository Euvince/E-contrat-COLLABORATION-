@extends('layouts.master')
@section('title')
    Détail d'un département
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    <div class="card rounded-0 ">
        <div class="card-header">
            <h2 class="card-title">
                {{ $departement->nom }}
            </h2>
        </div>
        <div class="card-body">
                <div class="py-2 row d-flex justify-content-center">


                    <div class="mb-3 col-md-12">
                        <label for="basiInput" class="form-label">Code du département</label>
                        <input type="text" class="form-control @error('code') is-invalid @enderror" name="code"
                            value="{{ $departement->code }}" id="basiInput" readonly>
                        @error('code')
                            <span class="text-danger"> {{ $errors->first('code') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="basiInput" class="form-label">Nom du département</label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom"
                            value="{{ $departement->nom }}" id="basiInput" readonly>
                        @error('nom')
                            <span class="text-danger"> {{ $errors->first('nom') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="basiInput" class="form-label">Nom de l'ufr</label>
                        <input type="text" class="form-control @error('ufr_id') is-invalid @enderror" name="ufr_id"
                            value="{{ $departement->ufr->nom }}" id="basiInput" readonly>
                        @error('ufr_id')
                            <span class="text-danger"> {{ $errors->first('ufr_id') }}</span>
                        @enderror
                    </div>

                    {{-- <div class="mb-3 col-md-12">
                        <label for="basiInput" class="form-label">Nom du chef département</label>
                        <input type="text" class="form-control @error('chef_departement') is-invalid @enderror" name="chef_departement"
                            value="{{ $departement->enseignant->nom }} {{ $departement->enseignant->prenoms }}" id="basiInput" readonly>
                        @error('chef_departement')
                            <span class="text-danger"> {{ $errors->first('chef_departement') }}</span>
                        @enderror
                    </div> --}}

                    <div class="mb-3 col-md-12">
                        <label for="basiInput" class="form-label">Logo</label>
                        <input type="text" class="form-control @error('logo') is-invalid @enderror" name="logo"
                            value="{{ $departement->logo }}" id="basiInput" readonly>
                        @error('logo')
                            <span class="text-danger"> {{ $errors->first('logo') }}</span>
                        @enderror
                    </div>



                </div>
                <div class="px-2 py-3 mt-3 bg-light d-flex justify-content-between">
                    <a href="{{ route('departements.index') }}" type="button"
                        class="btn btn-info rounded-0 btn-label waves-effect waves-light"><i
                            class="align-middle ri-arrow-drop-left-line label-icon fs-16 me-2"></i> Annuler </a>

                     <a href="{{ route('departements.edit', ['departement' => $departement->slug]) }}">
                        <button class="btn btn-success rounded-0 btn-label waves-effect waves-light"><i
                            class="align-middle ri-check-line label-icon fs-16 me-2"></i> Editer</button>
                        </a>

                </div>

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
