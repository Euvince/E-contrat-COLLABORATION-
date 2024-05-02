<!doctype html >
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-layout="vertical" data-layout-style="default"
    data-topbar="dark" data-preloader="enable" data-sidebar="light" data-sidebar-size="lg" data-sidebar-image="none"
    data-preloader="disable">
<head>
    <meta charset="utf-8" />
    <title>@yield('title') | {{ config('app.name') }} </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ URL::asset('build/images/favicon.ico')}}">
    @include('layouts.head-css')
    @routes
</head>

@section('body')
    @include('layouts.body')
@show
    <!-- Begin page -->
    <div id="layout-wrapper">
        @include('layouts.topbar')
        @if (Auth::user()->hasRole('Administrateur'))
            @include('layouts.sidebar-administrateur')
        @elseif (Auth::user()->hasRole('Manager'))
            @include('layouts.sidebar-manager')
        @elseif (Auth::user()->hasRole('Comptabilite'))
            @include('layouts.sidebar-comptabilite')
        @elseif (Auth::user()->hasRole('Programmation') || Auth::user()->hasRole('Assistant Programmation'))
            @include('layouts.sidebar-programmation')
        @elseif (Auth::user()->hasRole('Personnel') || Auth::user()->hasRole('Assistant Personnel'))
            @include('layouts.sidebar-personnel')
        @elseif (Auth::user()->hasRole('Chef de Département'))
            @include('layouts.sidebar-cd')
        @elseif (Auth::user()->hasRole('Responsable'))
            @include('layouts.sidebar-responsable')
        @endif


        
        <!-- ============================================================== -->
        <!-- Start right Content here -->
        <!-- ============================================================== -->
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    <div class="row mb-3 pb-1">
                        <div class="col-12">
                            <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                <div class="flex-grow-1">
                                    <h3 class="mb-1"> @yield('title') </h3>
                                </div>
                                @if(!Auth::user()->hasRole('Responsable'))
                                    <div class="mt-3 mt-lg-0">
                                        <div class="flex-wrap pb-2 d-flex justify-content-end">
                                            <div class="dropdown ">
                                                <a href="#" class="btn btn-secondary rounded-0 dropdown-toggle" data-bs-toggle="dropdown"
                                                    aria-expanded="false">
                                                    --ARCHIVE--
                                                </a>
                                                <div class="dropdown-menu rounded-0">
                                                    @foreach(archive() as $annee)
                                                        <a class="dropdown-item" href="{{ route('changeAnnee', ['annee' => $annee->id]) }}">{{$annee->nom}}</a>
                                                    @endforeach
                                                </div>
                                            </div>
                                
                                        </div>
                                    </div>
                                @endif    

                            </div><!-- end card header -->
                        </div>
                        <!--end col-->
                    </div>
                    <div class="row mb-3 pb-1">
                        <div class="col-12">
                            <div class="d-flex align-items-lg-center flex-lg-row flex-column">
                                <div class="flex-grow-1">
                                    <h4 class="fs-16 mb-1">@yield('subtitle')</h4>
                                    <p class="text-muted mb-0">@yield('subsubtitle')</p>
                                </div>
                                <div class="mt-3 mt-lg-0">
                                        <div class="row g-3 mb-0 align-items-center">
                                            <div class="col-sm-auto">
                                                <div class="input-group">
                                                    <input type="text" class="form-control border-0 dash-filter-picker shadow" value="Rentrée {{ getannee()->nom }}">
                                                    <div class="input-group-text bg-danger border-danger text-white">
                                                        <i class="ri-calendar-2-line"></i>
                                                    </div>
                                                </div>
                                            </div>
                                            <!--end col-->
                                            @if(!Auth::user()->hasRole('Responsable'))
                                                <div class="col-auto">
                                                    <a href="{{ route('changeAnnee', ['annee' => getLastAnnee()->id]) }}" title="Revenir à l'année actuelle">
                                                        <button type="button" class="btn btn-soft-info btn-icon waves-effect waves-light layout-rightside-btn shadow-none"><i class="ri-pulse-line"></i></button>
                                                    </a>
                                                </div>
                                            @endif
                                            <!--end col-->
                                        </div>
                                        <!--end row-->
                                </div>
                            </div><!-- end card header -->
                        </div>
                        <!--end col-->
                    </div>
                    @yield('content')
                </div>
                <!-- container-fluid -->
            </div>
            <!-- End Page-content -->
            @include('layouts.footer')
        </div>
        <!-- end main content-->
    </div>
    <!-- END layout-wrapper -->

    <!-- JAVASCRIPT -->
    @include('layouts.vendor-scripts')
</body>

</html>
