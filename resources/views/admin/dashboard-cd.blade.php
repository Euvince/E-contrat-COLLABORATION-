@extends('layouts.master')
@section('title')
@lang('translation.dashboards')
@endsection
@section('subtitle')
{{ $departement->nom }}
@endsection
@section('subsubtitle')
Chef de département : {{ getCD($departement->id)->nom }} {{ getCD($departement->id)->prenom }}
@endsection
@section('css')
    <link href="https://cdn.datatables.net/1.11.5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <!--datatable responsive css-->
    <link href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.bootstrap.min.css" rel="stylesheet"
        type="text/css" />
    <link href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="https://cdn.datatables.net/select/1.7.0/css/select.dataTables.min.css">
@endsection
@section('content')

<div class="row">
    <div class="col">

        <div class="h-100">

            <div class="row">
                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Nombre de filières</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                        {{ count($departement->filieres) }} filières
                                    </h4>
                                    <a href="" class="">Voir les filières</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-success rounded fs-3">
                                        <i class="bx bx-dollar-circle"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Nombre de classes</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                        {{ count(getClasseByDepartement($departement->id) )}} classes
                                    </h4>
                                    <a href="" class="">Voir les classes</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-info rounded fs-3">
                                        <i class="bx bx-shopping-bag"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Semestre impair</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4"><span class="counter-value" data-target="183.35">0</span>M
                                    </h4>
                                    <a href="" class="text-decoration-underline">See details</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-warning rounded fs-3">
                                        <i class="bx bx-user-circle"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->

                <div class="col-xl-3 col-md-6">
                    <!-- card -->
                    <div class="card card-animate">
                        <div class="card-body">
                            <div class="d-flex align-items-center">
                                <div class="flex-grow-1 overflow-hidden">
                                    <p class="text-uppercase fw-medium text-muted text-truncate mb-0">
                                        Semestre pair</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">$<span class="counter-value" data-target="165.89">0</span>k
                                    </h4>
                                    <a href="" class="text-decoration-underline">Withdraw money</a>
                                </div>
                                <div class="avatar-sm flex-shrink-0">
                                    <span class="avatar-title bg-danger rounded fs-3">
                                        <i class="bx bx-wallet"></i>
                                    </span>
                                </div>
                            </div>
                        </div><!-- end card body -->
                    </div><!-- end card -->
                </div><!-- end col -->
            </div> <!-- end row-->

            <div class="row">
                <div class="col-xl-12">
                    @foreach ($cycles as $cycle)
                        @if(count(getClasseByDepartementByCycle($departement->id,$cycle->id))>0)
                            <div class="card">
                                <div class="card-header align-items-center d-flex">
                                    <h4 class="card-title mb-0 flex-grow-1">{{ $cycle->nom}} </h4>
                                </div><!-- end card header -->

                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table id="classesTable{{ $cycle->id }}" class="table align-middle table-bordered table-striped"
                                            style="width:100%">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Filière</th>
                                                    <th scope="col">Classe</th>
                                                    <th scope="col">Semestre impair</th>
                                                    <th scope="col">Semestre pair</th>
                                                    <th scope="col" style="width: 20px;">Action</th>
                                                </tr>
                                            </thead>

                                            <tbody>
                                                @foreach (getClasseByDepartementByCycle($departement->id,$cycle->id) as $classe)
                                                    @php 
                                                        $semestre1 = count(getEcueByClasseBySemestre($classe->id, getSemestre($classe->niveau)[0]));
                                                        $semestre2 = count(getEcueByClasseBySemestre($classe->id, getSemestre($classe->niveau)[1]));
                                                        $semestreFin1 = count(getEcueTermineByClasseBySemestre($classe->id, getSemestre($classe->niveau)[0]));
                                                        $semestreFin2 = count(getEcueTermineByClasseBySemestre($classe->id, getSemestre($classe->niveau)[1]));
                                                    @endphp
                                                    <tr>
                                                        <td>{{ $classe->filiere->nom }}</td>
                                                        <td>{{ $classe->nom }}</td>
                                                        <td>{{ $semestre1==0 ? '0' : arrondir_nombre(100*$semestreFin1/$semestre1) }}%</td>
                                                        <td>{{ $semestre2==0 ? '0' : arrondir_nombre(100*$semestreFin2/$semestre2) }}%</td>
                                                        <td><a href="{{ route('classes.show', ['class' => $classe->slug]) }}"
                                                            type="button" data-bs-toggle="tooltip" data-bs-placement="bottom"
                                                            title="Voir"
                                                            class="mb-1 ms-1 btn btn-sm btn-info btn-icon waves-effect waves-light"><i
                                                                class="ri-eye-line"></i></a></td>
                                                    </tr>
                                                    
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>

        </div> <!-- end .h-100-->

    </div> <!-- end col -->
</div>
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/dataTables.bootstrap5.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.9/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script>
<script src="https://cdn.datatables.net/select/1.7.0/js/dataTables.select.min.js"></script>

<script src="{{ URL::asset('assets/js/pages/customs/classe.js') }}"></script>
@endsection
