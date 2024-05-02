@extends('layouts.master')
@section('title')
Tableau de bord - {{ $classe->nom }}
@endsection
@section('subtitle')
Département : {{ $classe->filiere->departement->nom }}
@endsection
@section('subsubtitle')
Filière : {{ $classe->filiere->nom }}
@endsection
@section('css')
<link href="{{ URL::asset('build/libs/jsvectormap/css/jsvectormap.min.css')}}" rel="stylesheet" type="text/css" />
<link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css')}}" rel="stylesheet" type="text/css" />
@endsection
@section('content')

@php
    $semestre1 = count(getEcueByClasseBySemestre($classe->id, getSemestre($classe->niveau)[0]));
    $semestre2 = count(getEcueByClasseBySemestre($classe->id, getSemestre($classe->niveau)[1]));
    $total = $semestre1+$semestre2;

    $semestreFin1 = count(getEcueTermineByClasseBySemestre($classe->id, getSemestre($classe->niveau)[0]));
    $semestreFin2 = count(getEcueTermineByClasseBySemestre($classe->id, getSemestre($classe->niveau)[1]));
    $totalFin = $semestreFin1+$semestreFin2;
@endphp

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
                                        Nombre de cours dans l'année</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">{{ $total }} cours</h4>
                                    <a href="" class="">Nombre de cours terminé : {{ $totalFin }}</a>
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
                                        Semestre {{ getSemestre($classe->niveau)[0] }}</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-success fs-14 mb-0">
                                        {{ $semestre1==0 ? '0' : arrondir_nombre(100*$semestreFin1/$semestre1) }}%
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">{{ $semestre1 }} cours</h4>
                                    <a href="" class="">Nombre de cours terminé : {{ $semestreFin1 }}</a>
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
                                        Semestre {{ getSemestre($classe->niveau)[1] }}</p>
                                </div>
                                <div class="flex-shrink-0">
                                    <h5 class="text-success fs-14 mb-0">
                                        {{ $semestre2==0 ? '0' : arrondir_nombre(100*$semestreFin2/$semestre1) }}%
                                    </h5>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">{{ $semestre2 }} cours
                                    </h4>
                                    <a href="" class="">Nombre de cours terminé : {{ $semestreFin2 }}</a>
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
                                        Taux d'exécution global</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-end justify-content-between mt-4">
                                <div>
                                    <h4 class="fs-22 fw-semibold ff-secondary mb-4">
                                        {{ $total ==0 ? '0' : arrondir_nombre(100*$totalFin/$total )}}%
                                    </h4>
                                    <a href="" class="">Nombre de cours restant : {{ $total - $totalFin }}</a>
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
                    @foreach (getSemestre($classe->niveau) as $semestre)
                        <div class="card">
                            <div class="card-header align-items-center d-flex">
                                <h4 class="card-title mb-0 flex-grow-1">Semestre {{ $semestre }} </h4>
                            </div><!-- end card header -->

                            <div class="card-body">
                                <div class="table-responsive table-card">
                                    <table class="table table-borderless table-hover table-nowrap align-middle mb-0">
                                        <thead class="table-light">
                                            <tr class="text-muted">
                                                <th scope="col">UE</th>
                                                <th scope="col">Matière</th>
                                                <th scope="col">Masse</th>
                                                <th scope="col">Exécuté</th>
                                                <th scope="col">Date début</th>
                                                <th scope="col">Date fin</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ( getEcueByClasseBySemestre($classe->id,$semestre) as $cours) 
                                                <tr>
                                                    <td>{{ rechercherUe($cours->ue_id)->nom }}</td>
                                                    <td>{{ rechercherEcue($cours->ecue_id)->nom}}</td>
                                                    <td>{{ $cours->heure_theorique }}</td>
                                                    <td>{{ heureExecute($cours->id, $cours->ecue_id) }}</td>
                                                    <td>{{ $cours->date_debut ? date('d/m/Y', strtotime($cours->date_debut)) : ''}}</td>
                                                    <td>{{ $cours->date_fin ? date('d/m/Y', strtotime($cours->date_fin)) :''}}</td>
                                                </tr>
                                            @endforeach
                                        </tbody><!-- end tbody -->
                                    </table><!-- end table -->
                                </div><!-- end table responsive -->
                            </div><!-- end card body -->
                        </div>
                    @endforeach
                </div>
            </div> <!-- end row-->


        </div> <!-- end .h-100-->

    </div> <!-- end col -->
</div>
@endsection
@section('script')
<!-- apexcharts -->
<script src="{{ URL::asset('build/libs/apexcharts/apexcharts.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
<script src="{{ URL::asset('build/libs/jsvectormap/maps/world-merc.js') }}"></script>
<script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js')}}"></script>
<!-- dashboard init -->
<script src="{{ URL::asset('build/js/pages/dashboard-ecommerce.init.js') }}"></script>
<script src="{{ URL::asset('build/js/app.js') }}"></script>
@endsection
