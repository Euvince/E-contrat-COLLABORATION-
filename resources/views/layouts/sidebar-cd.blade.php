<!-- ========== App Menu ========== -->
<div class="app-menu navbar-menu" style="border: none">
    <!-- LOGO -->
    <div class="navbar-brand-box" style="background-color: #1C1C36">
        <!-- Dark Logo-->
        <a href="index" class="logo logo-dark">
            <span class="logo-sm">
                <img src="{{ URL::asset('images/logo.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('images/logo.png') }}" alt="" height="50">
            </span>
        </a>
        <!-- Light Logo-->
        <a href="index" class="logo logo-light">
            <span class="logo-sm">
                <img src="{{ URL::asset('images/logo.png') }}" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="{{ URL::asset('images/logo.png') }}" alt="" height="17">
            </span>
        </a>
        <button type="button" class="p-0 btn btn-sm fs-20 header-item float-end btn-vertical-sm-hover"
            id="vertical-hover">
            <i class="ri-record-circle-line"></i>
        </button>
    </div>

    <div id="scrollbar" class="">
        <div class="container-fluid">
            <ul class="navbar-nav" id="navbar-nav">

                <li class="menu-title">
                    <span>
                        @lang('translation.menu')
                    </span>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->path()=='admin' ? 'active' : '' }}" href="{{ route('dashboard') }}" role="button"
                        aria-expanded="false" aria-controls="sidebarDashboards">
                        <i class="mdi mdi-speedometer"></i> <span>@lang('translation.dashboards')
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link" href="#sidebarMultilevel" data-bs-toggle="collapse"
                        role="button" aria-expanded="{{ (str_contains(request()->path(), 'filiere') or str_contains(request()->path(), 'classe') ) ? 'true' : 'false' }}" aria-controls="sidebarMultilevel">
                        <i class="ri-stack-line"></i> <span data-key="t-multi-level">Mon département</span>
                    </a>

                    <div class="collapse {{ (str_contains(request()->path(), 'filiere') or str_contains(request()->path(), 'classe') ) ? 'show' : '' }} menu-dropdown" id="sidebarMultilevel">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item ">
                                <a href="{{ route('filieres.index') }}" class="nav-link {{ str_contains(request()->path(), 'filiere') ? 'active' : '' }}" data-key="t-level-1.1">Filières</a>
                            </li>
                        </ul>
                    </div>

                    <div class="collapse {{ (str_contains(request()->path(), 'filiere') or str_contains(request()->path(), 'classe') ) ? 'show' : '' }}  menu-dropdown" id="sidebarMultilevel">
                        <ul class="nav nav-sm flex-column">
                            <li class="nav-item">
                                <a href="{{ route('classes.index') }}" class="nav-link {{ str_contains(request()->path(), 'classe') ? 'active' : '' }}" data-key="t-level-1.1">Classes</a>
                            </li>
                        </ul>
                    </div>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ (str_contains(request()->path(), 'cours') and  request()->path()!='admin/cours/transmettre') ? 'active' : ''  }}" href="{{ route('cours.index') }}" role="button" aria-expanded="false"
                        aria-controls="sidebarDashboards">
                        <i class="bx bx-task"></i> <span>
                            Tables de spécification
                        </span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->path()=='admin/cours/transmettre' ? 'active' : '' }}" href="{{ route('cours.transmettre') }}" role="button" aria-expanded="false"
                        aria-controls="sidebarDashboards">
                        <i class="mdi mdi-transfer-right"></i> <span>
                            Transférer les TS
                        </span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link menu-link {{ request()->is('admin/enseignants*') ? 'active' : '' }}" href="{{route('enseignants.index')}}" role="button" aria-expanded="false"
                        aria-controls="sidebarDashboards">
                        <i class="mdi mdi-account-tie"></i> <span>
                            Enseignants
                        </span>
                    </a>
                </li>
            </ul>
        </div>
        <!-- Sidebar -->
    </div>

    <div class="sidebar-background"></div>

</div>
<!-- Left Sidebar End -->
<!-- Vertical Overlay-->
<div class="vertical-overlay"></div>
