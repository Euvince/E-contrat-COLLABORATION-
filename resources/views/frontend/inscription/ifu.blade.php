@extends('frontend.inscription.layout')
@section('title')
    Numéro IFU
@endsection
@section('css')
<link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6 col-xl-5">
            <div class="card mt-4">

                <div class="card-body p-4">
                    <div class="text-center mt-2">
                        <h5 class="text-primary">Numéro IFU</h5>

                    </div>
                    <div class="p-2">
                        <form class="needs-validation"  action="{{ route('informations') }}" method="post">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label">Numéro IFU <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" id="ifu" name="ifu" placeholder="Entre votre numéro IFU" required>
                                <div class="invalid-feedback">
                                    Veuillez entrer votre numéro IFU
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <button class="btn btn-success w-100 valide-ifu" type="submit">Suivant</button>
                            </div>
                        </form><!-- end form -->
                    </div>
                </div>
                <!-- end card body -->
            </div>
            <!-- end card -->

        </div>
    </div>
        <!-- auth page bg -->        
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
    integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>

    <script>
    $(".valide-ifu").on("click", function (e) {
        e.preventDefault();
        let $form = $(this).closest('form');
        let ifuNumber = $('#ifu').val().trim();
        if (ifuNumber === "") {
            // Afficher un message d'erreur si le champ IFU est vide
                Swal.fire({
                    title: "Erreur",
                    text: "Veuillez saisir un numéro IFU.",
                    icon: "error",
                    confirmButtonClass: "btn btn-danger w-xs mt-2",
                    buttonsStyling: false,
                    showCloseButton: false,
                });
        }else{
            Swal.fire({
                title: ifuNumber,
                text: "Ce numéro IFU est-il correct ?",
                icon: "question",
                confirmButtonText: "Oui, il est correct",
                cancelButtonText: "Non, il n'est pas correct",
                confirmButtonClass: "btn btn-info w-xs me-2 mt-2",
                cancelButtonClass: "btn btn-danger w-xs mt-2",
                showCancelButton: true,
                buttonsStyling: false,
                showCloseButton: false,
                }).then((result) => {
                    if (result.isConfirmed) {
                        $form.submit();
                    }
                });
            }
    });
</script>
@endsection
