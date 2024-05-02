@extends('layouts.master')
@section('title')
    Recherche de l'enseignant
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    @endsection
@section('content')
    <div class="card rounded-0 ">
        <div class="card-header">
            <h2 class="card-title">
                Recherche par numéro d'identification personnel
            </h2>
        </div>
        <div class="card-body">
            <form action="{{ route('find-by-npi') }}" method="post">
                @csrf
                <div class="py-2 row d-flex justify-content-center">
                    <div class="mb-3 col-md-12">
                        <label for="basiInput" class="form-label">NPI</label>
                        <input type="text" class="form-control @error('npi') is-invalid @enderror" name="npi"
                            value="{{ old('npi') }}" id="basiInput">
                        @error('npi')
                            <span class="text-danger"> {{ $errors->first('npi') }}</span>
                        @enderror
                    </div>
                </div>
                <div class="px-2 py-3 mt-3 bg-light d-flex justify-content-between">
                    <a href="{{ route('enseignants.index') }}" type="button"
                        class="btn btn-info rounded-0 btn-label waves-effect waves-light align-self-center"><i
                            class="align-middle ri-arrow-drop-left-line label-icon fs-16 me-2"></i> Annuler </a>

                    <div class="d-flex gap-3 align-self-center">
                        <button type="submit"
                            class="btn btn-success rounded-0 btn-label waves-effect waves-light align-self-center"><i
                                class="align-middle ri-check-line label-icon fs-16 me-2"></i> Rechercher</button>
                    </div>

                </div>
            </form>
            @if (Session::has('status'))
            <button type="button" class="d-none btn btn-primary btn-sm" id="enseignant-trouvé">Click
                me</button>
            @endif
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
    <script src="{{ URL::asset('build/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/sweetalerts.init.js') }}"></script>

    <script src="{{ URL::asset('/assets/js/app.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/customs/rechercheEnsegnantNpi.js') }}"></script>
@endsection
