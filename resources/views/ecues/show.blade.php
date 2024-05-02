@extends('layouts.master')
@section('title')
    Détail d'une ecue
@endsection
@section('css')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" type="text/css" />
@endsection
@section('content')

    <div class="card rounded-0 ">
        <div class="card-header">
            <h2 class="card-title">
                {{ $ecue->nom }}
            </h2>
        </div>
        <div class="card-body">
                <div class="py-2 row d-flex justify-content-center">

                    
                    <div class="mb-3 col-md-12">
                        <label for="basiInput" class="form-label">Code de l'Ecue</label>
                        <input type="text" class="form-control @error('code') is-invalid @enderror" name="code"
                            value="{{ $ecue->code }}" id="basiInput" readonly>
                        @error('code')
                            <span class="text-danger"> {{ $errors->first('code') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="basiInput" class="form-label">Nom de l'Ecue</label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom"
                            value="{{ $ecue->nom }}" id="basiInput" readonly>
                        @error('nom')
                            <span class="text-danger"> {{ $errors->first('nom') }}</span>
                        @enderror
                    </div>

                    <div class="mb-3 col-md-12">
                        <label for="basiInput" class="form-label">UE</label>
                        <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom"
                            value="{{ $ecue->ue->nom }}" id="basiInput" readonly>
                        @error('ue_id')
                            <span class="text-danger"> {{ $errors->first('ue_id') }}</span>
                        @enderror
                    </div>

                </div>
                <div class="px-2 py-3 mt-3 bg-light d-flex justify-content-between">
                    <a href="{{ route('ecues.index') }}" type="button"
                        class="btn btn-info rounded-0 btn-label waves-effect waves-light"><i
                            class="align-middle ri-arrow-drop-left-line label-icon fs-16 me-2"></i> Annuler </a>

                     <a href="{{ route('ecues.edit', ['ecue' => $ecue->slug]) }}">
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
