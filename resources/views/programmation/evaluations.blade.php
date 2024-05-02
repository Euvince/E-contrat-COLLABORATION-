@extends('layouts.master')
@section('title')
    Programmation des évaluations
@endsection
@section('css')
    <!--datatable css-->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <!--datatable responsive css-->
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css">
    <link rel="stylesheet" href="{{ URL::asset('build/css/flatpickr.min.css')}}">
@endsection
@section('content')
    

    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <form action="{{ route('programmation.post-evaluations') }}" method="post">
                        @csrf
                                <div class="row">
                                    <label for="" class="form-label">Evaluation du </label>
                                    <div class="col-12">
                                        <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                            <div class="flex-grow-1">
                                                <input type="text" value="" name="composition" id="datepicker" class="form-control" data-provider="flatpickr" data-date-format="d/m/Y">
                                            </div>
                                            <div class="mt-3 mt-lg-0" style="margin-left: 10px;">
                                                <button type="submit" class="btn btn-success rounded-0 btn-label waves-effect waves-light"><i
                                                    class="align-middle ri-check-line label-icon fs-16 me-2"></i> Afficher</button>
                                            </div>
                                        </div><!-- end card header -->
                                    </div>
                                    <!--end col-->
                                </div>
                    </form>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <a href="">
                            <button type="button" class="btn btn-info add-btn">
                                <i class="align-bottom ri-add-line me-1"></i> Imprimer la programmation
                            </button>
                        </a>
                    </div>
                    <div class="table-responsive">
                        <table id="programmationsTable" class="table align-middle table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Département</th>
                                    <th>Filiere</th>
                                    <th>Classe</th>
                                    <th>Matière</th>
                                    <th>Date</th>
                                    <th>Heure</th>
                                    <th>Salle(s)</th>
                                </tr>
                            </thead>
                        </table>
                    </div>




                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>


    <script src="{{ URL::asset('assets/js/pages/customs/programmation.js') }}"></script>

    <script src="{{ URL::asset('build/js/pages/flatpickr.min.js')}}"></script>
    <script src="{{ URL::asset('build/js/pages/flatpickr_fr.js')}}"></script>

    <script>

        flatpickr("#datepicker", {
            enableTime: false, // Enable time selection
            dateFormat: "d/m/Y", // Customize the date and time format as needed
            locale : "fr",
        });
    </script>
@endsection
