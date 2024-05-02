@extends('layouts.master')
@section('title')
    Création d'une universite
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="border card rounded-0">

        <div class="card-body">
            <form action="{{ route('universites.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="py-2 row d-flex justify-content-center">

                    <div class="mb-3 col-md-12">
                        <label for="basiInput" class="form-label">Code de l'université <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('code') is-invalid @enderror" name="code"
                            value="{{ old('code') }}" id="basiInput">
                        @error('code')
                            <span class="text-danger"> {{ $errors->first('code') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="nomInput" class="form-label">Nom de l'université <span
                                class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom"
                            value="{{ old('nom') }}" id="nomInput">
                        @error('nom')
                            <span class="text-danger"> {{ $errors->first('nom') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="emailInput" class="form-label">Email de l'université</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
                            value="{{ old('email') }}" id="emailInput">
                        @error('email')
                            <span class="text-danger"> {{ $errors->first('email') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="recteurInput" class="form-label">Recteur de l'université</label>
                        <input type="text" class="form-control @error('recteur') is-invalid @enderror" name="recteur"
                            value="{{ old('recteur') }}" id="recteurInput">
                        @error('recteur')
                            <span class="text-danger"> {{ $errors->first('recteur') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="sitewebInput" class="form-label">Site web de l'université</label>
                        <input type="text" class="form-control @error('siteweb') is-invalid @enderror" name="siteweb"
                            value="{{ old('siteweb') }}" id="sitewebInput">
                        @error('siteweb')
                            <span class="text-danger"> {{ $errors->first('siteweb') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="telephoneInput" class="form-label">Téléphone de l'université</label>
                        <input type="text" class="form-control @error('telephone') is-invalid @enderror" name="telephone"
                            value="{{ old('telephone') }}" id="telephoneInput">
                        @error('telephone')
                            <span class="text-danger"> {{ $errors->first('telephone') }}</span>
                        @enderror
                    </div>


                    <div class="mb-3 col-md-12">
                        <label for="comptableInput" class="form-label">Comptable de l'université</label>
                        <input type="text" class="form-control @error('comptable') is-invalid @enderror" name="comptable"
                            value="{{ old('comptable') }}" id="comptableInput">
                        @error('comptable')
                            <span class="text-danger"> {{ $errors->first('comptable') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="villeInput" class="form-label">Ville de l'université</label>
                        <input type="text" class="form-control @error('ville') is-invalid @enderror" name="ville"
                            value="{{ old('ville') }}" id="villeInput">
                        @error('ville')
                            <span class="text-danger"> {{ $errors->first('ville') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="adresseInput" class="form-label">Adresse de l'université</label>
                        <input type="text" class="form-control @error('adresse') is-invalid @enderror" name="adresse"
                            value="{{ old('adresse') }}" id="adresseInput">
                        @error('adresse')
                            <span class="text-danger"> {{ $errors->first('adresse') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="logoInput" class="form-label">Logo de l'université</label>
                        <input type="file" class="form-control @error('logo') is-invalid @enderror" name="logo"
                            value="{{ old('logo') }}" id="logoInput">
                        @error('logo')
                            <span class="text-danger"> {{ $errors->first('logo') }}</span>
                        @enderror
                    </div>
                </div>

                <div class="px-2 py-3 mt-3 bg-light d-flex justify-content-between">
                    <a href="{{ route('universites.index') }}" type="button"
                        class="btn btn-info rounded-0 btn-label waves-effect waves-light"><i
                            class="align-middle ri-arrow-drop-left-line label-icon fs-16 me-2"></i> Annuler </a>
                    <button type="submit" class="btn btn-success rounded-0 btn-label waves-effect waves-light"><i
                            class="align-middle ri-check-line label-icon fs-16 me-2"></i> Enregistrer</button>

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
