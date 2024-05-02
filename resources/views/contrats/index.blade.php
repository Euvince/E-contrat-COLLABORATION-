@extends('layouts.master')
@section('title')
    Gestion des contrats 
@endsection
@section('css')
    <!--datatable css-->
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <!--datatable responsive css-->
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css">
    <link href="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.css') }}" rel="stylesheet" type="text/css" />
@endsection
@section('content')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">

                <div class="card-header">
                    <h6 class="card-title">Liste des enseignants</h6>
                    <p class="card-subtitle text-muted mb-0">Choisir un enseignant pour afficher ces contrats</p>
                </div>

                <div class="card-body">
                    @if(Auth::user()->hasRole('Personnel'))
                        <div class="mb-3">
                            <a href="{{ route('contrats.create') }}">
                                <button type="button" class="btn btn-success add-btn">
                                    <i class="align-bottom ri-add-line me-1"></i> Créer un contrat
                                </button>
                            </a>
                        </div>
                    @endif
                    <div class="table-responsive">
                        <table id="contratsTable" class="table align-middle table-bordered table-striped" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Enseignant</th>
                                    <th>Nombre de contrat</th>
                                    <th>Programmé</th>
                                    <th>Contracté</th>
                                    @if (Auth::user()->hasRole('Personnel'))
                                        <th class="" data-sort="action" style="width: 40px;">Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($enseignants as $enseignant)
                                    <tr>
                                        <td>{{ $enseignant->nom }} {{ $enseignant->prenoms }}</td>
                                        <td>9</td>
                                        <td>0</td>
                                        <td>0</td>
                                        <td>
                                            <div class="d-flex">
                                                <a href="{{ route('contrats.show', ['enseignant_id' => encryptid($enseignant->id)]) }}"
                                                    type="button" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                    title="Voir"
                                                    class="mb-1 ms-1 btn btn-sm btn-info waves-effect waves-light"><i
                                                        class="ri-eye-line"></i>Afficher</a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>




                </div>
                <!-- end card -->
            </div>
            <!-- end col -->
        </div>
        <!-- end col -->
    </div>
    <!-- end row -->
@endsection

@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>

    <script src="{{ URL::asset('assets/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ URL::asset('assets/js/pages/customs/contrat.js') }}"></script>
@endsection
