@extends('frontend.inscription.layout')
@section('title')
    Numéro IFU
@endsection
@section('content')
        
<div class="row justify-content-center">
    <div class="col-md-8 col-lg-6 col-xl-5">
        <div class="card mt-4">
            <div class="card-body p-4 text-center">
                <div class="avatar-lg mx-auto mt-2">
                    <div class="avatar-title bg-light text-success display-3 rounded-circle">
                        <i class="ri-checkbox-circle-fill"></i>
                    </div>
                </div>
                <div class="mt-4 pt-2">
                    <h4>Erreur!</h4>
                    <p class="text-muted mx-4">Une erreur s'est produite. Veuillez réessayer.</p>
                    <div class="mt-4">
                        <a href="{{ route('inscription') }}" class="btn btn-success w-100">Réessayer</a>
                    </div>
                </div>
            </div>
            <!-- end card body -->
        </div>
        <!-- end card -->

    </div>
</div>

@endsection
@section('script')
@endsection
