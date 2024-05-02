@extends('layouts.master-without-nav')
@section('title')Econtrat @endsection
@section('css')
<link href="{{ URL::asset('build/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('body')

<body data-bs-spy="scroll" data-bs-target="#navbar-example">
    @endsection
    @section('content')

    <!-- Begin page -->
    <div class="layout-wrapper landing">
        <nav class="navbar navbar-expand-lg navbar-landing fixed-top job-navbar" id="navbar">
            <div class="container-fluid custom-container">
                <a class="navbar-brand" href="#hero">
                    <img src="{{URL::asset('build/images/logo-dark.png')}}" class="card-logo card-logo-dark" alt="logo dark" height="17">
                    <img src="{{URL::asset('build/images/logo-light.png')}}" class="card-logo card-logo-light" alt="logo light" height="17">
                </a>
                <button class="navbar-toggler py-0 fs-20 text-body" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="mdi mdi-menu"></i>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mx-auto mt-2 mt-lg-0" id="navbar-example">
                        <li class="nav-item">
                            <a class="nav-link fs-14 active" href="#hero">Acceuil</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-14" href="#Universite">Universités</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link fs-14" href="#ufr">Unités de Formations et de Recherches</a>
                        </li>
                        
                       
                    </ul>

                    <div class="">
                        <a href="{{ route('login') }}" class="btn btn-soft-primary"><i class="ri-user-3-line align-bottom me-1"></i> Connexion</a>
                    </div>
                </div>

            </div>
        </nav>
        <!-- end navbar -->

        <!-- start hero section -->
        <section class="section job-hero-section bg-light pb-0" id="hero">
            <div class="container">
                <div class="row justify-content-between align-items-start" >
                    <div class="col-lg-6">
                        <div>
                            <h1 class="display-6 fw-semibold text-capitalize mb-3 lh-base">Econtrat: La Plateforme de Gestion des Contrats de Vacations</h1>
                            <p class="lead text-muted lh-base mb-4">Econtrat est une plateforme dédiée à la gestion des contrats de vacations des professeurs dans les universités. Elle offre une solution centralisée pour simplifier les processus administratifs liés aux engagements temporaires du personnel académique, facilitant ainsi la coordination et la gestion efficace des ressources humaines.</p>
                            <div class="">
                                <a href="{{ route('login') }}" class="btn btn-primary"><i class="ri-user-3-line align-bottom me-1"></i> Connexion</a>
                            </div>
                        </div>
                    </div>
                    <!--end col-->
                    <div class="col-lg-4">
                        <div class="position-relative home-img text-center mt-5 mt-lg-0">
                            {{-- <div class="card p-3 rounded shadow-lg inquiry-box">
                                <div class="d-flex align-items-center">
                                    <div class="avatar-sm flex-shrink-0 me-3">
                                        <div class="avatar-title bg-warning-subtle text-warning rounded fs-18">
                                            <i class="ri-mail-send-line"></i>
                                        </div>
                                    </div>
                                    <h5 class="fs-15 lh-base mb-0">L'éfficacité a portée de main</h5>
                                </div>
                            </div> --}}

                            
                            <img src="{{URL::asset('build/images/contract-rafiki.png')}}" alt="" class="user-img" style="width: 600px; height: 600px; margin-left: -100px; margin-top: -100px">

                            <div class="circle-effect">
                                <div class="circle"></div>
                                <div class="circle2"></div>
                                <div class="circle3"></div>
                                <div class="circle4"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
        <!-- end hero section -->

        <section class="section" id="Universite">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center mb-5">
                            <h1 class="mb-3 ff-secondary fw-semibold 1h-base">Quelques-unes des <span class="text-primary">Universités</span> prises en compte</h1>
                            <p class="text-muted">Econtrat se distingue comme une plateforme intégrale, orchestrant avec précision la gestion des contrats dans chaque université publiques du Bénin, ainsi que dans chacune de leurs UFR respectives. </p>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!--end row-->
                <div class="row">
                    @foreach ($universites as $universite)
                        <div class="col-lg-3 col-md-6" >
                            <div class="card shadow-lg">
                                <div class="card-body p-4">
                                    <h1 class="fw-bold display-5 ff-secondary mb-3 text-success position-relative">
                                        <div class="job-icon-effect"></div>
                                        <span>{{$universite->id}}</span>
                                    </h1>
                                    <h6 class="fs-17 mb-2">{{$universite->code}}</h6>
                                    <p class="text-muted mb-1 fs-14">
                                        <i class="ri-user-3-line text-primary me-1 align-bottom"></i>
                                        {{$universite->recteur}}
                                    </p>
                                    <p class="text-muted mb-1 fs-14">
                                        <i class="ri-global-line text-primary me-1 align-bottom"></i>
                                        <a class="text-lowercase" href={{$universite->siteweb}}>{{"www." . $universite->code . ".bj"}}</a>
                                    </p>
                                    
                                </div>
                            </div>
                        </div>
                    @endforeach
            </div>
            <!--end container-->
        </section>

        <!-- start features -->
       
        <!-- end features -->

        <!-- start services -->
        <section class="section bg-light" id="ufr">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-7">
                        <div class="text-center mb-5">
                            <h1 class="mb-3 ff-secondary fw-semibold text-capitalize lh-base">Liste des <span class="text-primary">Unités de Formations et de Recherches</span> prises en compte</h1>
                            <p class="text-muted">L'architecture solide de Econtrat assure une gestion administrative sans équivoque, préservant l'ordre et la clarté au sein de chaque entité universitaire.</p>
                        </div>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-lg-12">
                        <div class="swiper candidate-swiper">
                            <div class="swiper-wrapper">
                                @foreach ($ufrs as $ufr)
                                    <div class="swiper-slide">
                                        <div class="card text-center" style="height: 170px">
                                            <div class="card-body p-4">
                                                <h5 class="fs-17 mt-3 mb-2">{{$ufr->code}}</h5>
                                                <p class="text-muted fs-13 mb-3" style="max-height: 20px; overflow: hidden">{{$ufr->nom}}</p>
                                                <a href="#!" class="btn btn-primary w-100">Voir le site internet</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section>
        <!-- end services -->

        <!-- start cta -->
        <!-- end cta -->

        

        <!-- start find jobs -->
        <!-- end find jobs -->

        <!-- start candidates -->
        
        <!-- end candidates -->

        <!-- start blog -->
        {{-- <section class="section" id="blog">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="text-center mb-5">
                            <h1 class="mb-3 ff-secondary fw-semibold text-capitalize lh-base">Our Latest <span class="text-primary">News</span></h1>
                            <p class="text-muted mb-4">We thrive when coming up with innovative ideas but also understand that a smart concept should be supported with faucibus sapien odio measurable results.</p>
                        </div>
                    </div>
                </div>
                <!-- end row -->

                <div class="row">
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <img src="{{URL::asset('build/images/small/img-8.jpg')}}" alt="" class="img-fluid rounded" />
                            </div>
                            <div class="card-body">
                                <ul class="list-inline fs-14 text-muted">
                                    <li class="list-inline-item">
                                        <i class="ri-calendar-line align-bottom me-1"></i> 30 Oct, 2021
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="ri-message-2-line align-bottom me-1"></i> 364 Comment
                                    </li>
                                </ul>
                                <a href="javascript:void(0);">
                                    <h5>Design your apps in your own way ?</h5>
                                </a>
                                <p class="text-muted fs-14">One disadvantage of Lorum Ipsum is that in Latin certain letters appear more frequently than others.</p>

                                <div>
                                    <a href="#!" class="link-success">Learn More <i class="ri-arrow-right-line align-bottom ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <img src="{{URL::asset('build/images/small/img-6.jpg')}}" alt="" class="img-fluid rounded" />
                            </div>
                            <div class="card-body">
                                <ul class="list-inline fs-14 text-muted">
                                    <li class="list-inline-item">
                                        <i class="ri-calendar-line align-bottom me-1"></i> 02 Oct, 2021
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="ri-message-2-line align-bottom me-1"></i> 245 Comment
                                    </li>
                                </ul>
                                <a href="javascript:void(0);">
                                    <h5>Smartest Applications for Business ?</h5>
                                </a>
                                <p class="text-muted fs-14">Due to its widespread use as filler text for layouts, non-readability is of great importance: human perception.</p>

                                <div>
                                    <a href="#!" class="link-success">Learn More <i class="ri-arrow-right-line align-bottom ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <img src="{{URL::asset('build/images/small/img-9.jpg')}}" alt="" class="img-fluid rounded" />
                            </div>
                            <div class="card-body">
                                <ul class="list-inline fs-14 text-muted">
                                    <li class="list-inline-item">
                                        <i class="ri-calendar-line align-bottom me-1"></i> 23 Sept, 2021
                                    </li>
                                    <li class="list-inline-item">
                                        <i class="ri-message-2-line align-bottom me-1"></i> 354 Comment
                                    </li>
                                </ul>
                                <a href="javascript:void(0);">
                                    <h5>How apps is changing the IT world</h5>
                                </a>
                                <p class="text-muted fs-14">Intrinsically incubate intuitive opportunities and real-time potentialities Appropriately communicate one-to-one technology.</p>

                                <div>
                                    <a href="#!" class="link-success">Learn More <i class="ri-arrow-right-line align-bottom ms-1"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            <!-- end container -->
        </section> --}}
        <!-- end blog -->

        <!-- start cta -->
        {{-- <section class="py-5 bg-info position-relative">
            <div class="bg-overlay bg-overlay-pattern opacity-50"></div>
            <div class="container">
                <div class="row align-items-center gy-4">
                    <div class="col-sm">
                        <div>
                            <h4 class="text-white fw-semibold">Get New Jobs Notification!</h4>
                            <p class="text-white text-opacity-75 mb-0">Subscribe & get all related jobs notification.</p>
                        </div>
                    </div>
                    <!-- end col -->
                    <div class="col-sm-auto">
                        <button class="btn btn-danger" type="button">Subscribe Now <i class="ri-arrow-right-line align-bottom"></i></button>
                    </div>
                    <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </section> --}}
        <!-- end cta -->

        <!-- Start footer -->
        <footer class="custom-footer bg-dark py-5 position-relative">
            <div class="container">
                <div class="row justify-content-center" >
                    <div class="col-sm-6">
                        <img src="{{URL::asset('build/images/logo-light.png')}}" alt="logo light" height="17" />
                    </div>
        
                    <div class="col-sm-6">
                        <div class="text-sm-end mt-3 mt-sm-0">
                            Copyright © 2024 , Tout Droits Réservés.
                            
                        </div>
                    </div>
                </div>
               
            </div>

        </footer>
        <!-- end footer -->

        <!--start back-to-top-->
        <button onclick="topFunction()" class="btn btn-info btn-icon landing-back-top" id="back-to-top">
            <i class="ri-arrow-up-line"></i>
        </button>
        <!--end back-to-top-->

    </div>
    <!-- end layout wrapper -->

    @endsection
    @section('script')
    <script src="{{ URL::asset('build/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ URL::asset('build/js/pages/job-lading.init.js') }}"></script>
    @endsection
