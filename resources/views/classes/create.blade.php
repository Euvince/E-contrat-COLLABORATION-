@extends('layouts.master')
@section('title')
    Création d'une classe
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    <div class="border card rounded-0">

        <div class="card-body">
            <form action="{{ route('classes.store') }}" method="post">
                @csrf
                <div class="py-2 row d-flex justify-content-center">

                    <div class="py-2 row d-flex justify-content-center">
                        <div class="mb-3 col-md-12">
                            <label for="basiInput" class="form-label">Code de la classe</label>
                            <input type="text" class="form-control @error('code') is-invalid @enderror" name="code"
                                value="{{ old('code') }}" id="basiInput">
                            @error('code')
                                <span class="text-danger"> {{ $errors->first('code') }}</span>
                            @enderror
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="basiInput" class="form-label">Nom de la classe</label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom"
                            value="{{ old('nom') }}" id="basiInput">
                        @error('nom')
                            <span class="text-danger"> {{ $errors->first('nom') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="basiInput" class="form-label">Effectif de la classe</label>
                        <input type="text" class="form-control @error('effectif') is-invalid @enderror" name="effectif"
                        value="{{ old('effectif') }}" id="basiInput">
                        @error('effectif')
                            <span class="text-danger"> {{ $errors->first('effectif') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="niveau" class="form-label">Niveau</label>
                        <select class="form-select @error('niveau') is-invalid @enderror" name="niveau" id="niveau">
                            <option value="">Sélectionnez un niveau</option>
                            @for ($i = 1; $i <= 8; $i++)
                                <option value="{{ $i }}" {{ old('niveau') == $i ? 'selected' : '' }}>{{ $i }}</option>
                            @endfor
                        </select>
                        @error('niveau')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>


                    <div class="mb-3 col-md-12">
                        <label for="basiInput" class="form-label">Nom de la filière</label>
                        <select name="filiere_id" class="form-control @error('filiere_id') is-invalid @enderror" name="filiere_id" value="{{ old('filiere_id') }}" id="basiInput">
                            @foreach ($filieres as $filiere)
                                <option value="{{ $filiere->id }}">{{ $filiere->nom }}</option>
                            @endforeach
                        </select>
                        @error('filiere_id')
                            <span class="text-danger"> {{ $errors->first('filiere_id') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="basiInput" class="form-label">Nom du cycle</label>
                        <select name="cycle_id" class="form-control @error('cycle_id') is-invalid @enderror" name="cycle_id" value="{{ old('cycle_id') }}" id="basiInput">
                            @foreach ($cycles as $cycle)
                                <option value="{{ $cycle->id }}">{{ $cycle->nom }}</option>
                            @endforeach
                        </select>
                        @error('cycle_id')
                            <span class="text-danger"> {{ $errors->first('cycle_id') }}</span>
                        @enderror
                    </div>

                 </div>


                </div>

                <div class="px-2 py-3 mt-3 bg-light d-flex justify-content-between">
                    <a href="{{ route('classes.index') }}" type="button"
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
