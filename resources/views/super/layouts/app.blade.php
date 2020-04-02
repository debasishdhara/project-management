<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>
    <!-- Scripts -->
    {{--  <script src="{{ asset('js/app.js') }}" defer></script>  --}}

    <link rel="icon" href="{{ asset('theme/assets/images/favicon.ico')}}" type="image/x-icon"/>
    <!-- Vector CSS -->
    <link href="{{ asset('theme/assets/plugins/vectormap/jquery-jvectormap-2.0.2.css')}}" rel="stylesheet"/>
    <!-- simplebar CSS-->
    <link href="{{ asset('theme/assets/plugins/simplebar/css/simplebar.css')}}" rel="stylesheet"/>
    <!-- Bootstrap core CSS-->
    <link href="{{ asset('theme/assets/css/bootstrap.min.css')}}" rel="stylesheet"/>
    <!-- animate CSS-->
    <link href="{{ asset('theme/assets/css/animate.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Icons CSS-->
    <link href="{{ asset('theme/assets/css/icons.css')}}" rel="stylesheet" type="text/css"/>
    <!-- Sidebar CSS-->
    <link href="{{ asset('theme/assets/css/sidebar-menu.css')}}" rel="stylesheet"/>
    <!-- Custom Style-->
    <link href="{{ asset('theme/assets/css/app-style.css')}}" rel="stylesheet"/>
    <!-- skins CSS-->
    <link href="{{ asset('theme/assets/css/skins.css')}}" rel="stylesheet"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.css">

    @yield('style')
</head>
<body>
    <!-- start loader -->
    <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner"><div class="loader"></div></div></div></div>
    <!-- end loader -->
    <!-- Start wrapper-->
    <div id="wrapper">
        <!--Start sidebar-wrapper-->
        <div id="sidebar-wrapper" data-simplebar="" data-simplebar-auto-hide="true">
            <div class="brand-logo">
            <a href="javascript:void(0);">
            <img src="{{asset('theme/assets/images/logo-icon.png')}}" class="logo-icon" alt="logo icon">
            <h5 class="logo-text">Demo Admin</h5>
            </a>
            </div>
            <div class="user-details">
            <div class="media align-items-center user-pointer collapsed" data-toggle="collapse" data-target="#user-dropdown">
            <div class="avatar"><img class="mr-3 side-user-img" src="{{asset('theme/assets/images/110x110.png')}}" alt="user avatar"></div>
            <div class="media-body">
            <h6 class="side-user-name">{{ Auth::user()->name }}</h6>
            </div>
            </div>
            <div id="user-dropdown" class="collapse">
            <ul class="user-setting-menu">
                <li><a href="javaScript:void(0);"><i class="icon-user"></i>  My Profile</a></li>
                <li><a href="javaScript:void(0);"><i class="icon-settings"></i> Setting</a></li>
                <li>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                    document.getElementById('logout-form').submit();">
                    <i class="icon-power"></i>{{ __('Logout') }}
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
            </div>
            </div>
            <ul class="sidebar-menu">
            <li class="sidebar-header">MAIN NAVIGATION</li>
            <li class="sidebar-menu {{ (request()->is('home*')) ? 'active' : '' }}">
                <a href="{{ route('home') }}" class="waves-effect">
                <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li class="{{ (request()->is('company*')) ? 'active' : '' }}">
                <a href="{{ route('company') }}" class="waves-effect">
                <i class="fa fa-industry"></i> <span>Company</span>
                </a>
            </li>
            <li class="{{ (request()->is('users*')) ? 'active' : '' }}">
                <a href="{{ route('users') }}" class="waves-effect">
                <i class="fa fa-user-circle-o"></i> <span>User</span>
                </a>
            </li>
            <li class="{{ (request()->is('permission*')) ? 'active' : '' }}">
                <a href="javascript:void(0);" class="waves-effect">
                <i class="fa fa-chain"></i> <span>Privilege Settings</span>
                <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li class="{{ (request()->is('permission/fetch-role')) ? 'active' : '' }}"><a href="{{route('fetch-role')}}"><i class="zmdi zmdi-arrow-forward"></i> Role</a></li>
                    <li class="{{ (request()->is('permission/fetch-permission')) ? 'active' : '' }}"><a href="{{route('fetch-permission')}}"><i class="zmdi zmdi-arrow-forward"></i> Permission</a></li>
                    <li class="{{ (request()->is('permission/fetch-licence')) ? 'active' : '' }}"><a href="{{route('fetch-licence')}}"><i class="zmdi zmdi-arrow-forward"></i> Licence</a></li>
                </ul>
            </li>
            <li class="{{ (request()->is('common*')) ? 'active' : '' }}">
                <a href="javascript:void(0);" class="waves-effect">
                <i class="fa fa-location-arrow"></i> <span>Location Settings</span>
                <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="sidebar-submenu">
                    <li class="{{ (request()->is('common/fetch-countries')) ? 'active' : '' }}"><a href="{{route('fetch-countries')}}"><i class="zmdi zmdi-arrow-forward"></i> Country</a></li>
                    <li class="{{ (request()->is('common/fetch-states')) ? 'active' : '' }}"><a href="{{route('fetch-states')}}"><i class="zmdi zmdi-arrow-forward"></i> State</a></li>
                    <li class="{{ (request()->is('common/fetch-cities')) ? 'active' : '' }}"><a href="{{route('fetch-cities')}}"><i class="zmdi zmdi-arrow-forward"></i> City</a></li>
                    <li class="{{ (request()->is('common/fetch-sub-cities')) ? 'active' : '' }}"><a href="{{route('fetch-sub-cities')}}"><i class="zmdi zmdi-arrow-forward"></i> Sub City</a></li>
                </ul>
            </li>
        </ul>
        </div>
        <!--End sidebar-wrapper-->

        <!--Start topbar header-->
        <header class="topbar-nav">
            <nav id="header-setting" class="navbar navbar-expand fixed-top">
            <ul class="navbar-nav mr-auto align-items-center">
                <li class="nav-item">
                <a class="nav-link toggle-menu" href="javascript:void(0);">
                <i class="icon-menu menu-icon"></i>
                </a>
                </li>
                <li class="nav-item">
                <form class="search-bar">
                    <input type="text" class="form-control" placeholder="Enter keywords">
                    <a href="javascript:void(0);"><i class="icon-magnifier"></i></a>
                </form>
                </li>
            </ul>
                
            <ul class="navbar-nav align-items-center right-nav-link">
                <li class="nav-item dropdown-lg">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void(0);">
                    <i class="fa fa-envelope-open-o"></i>
                </a>
                </li>
                <li class="nav-item dropdown-lg">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void(0);">
                <i class="fa fa-bell-o"></i>
                </a>
                </li>
                <li class="nav-item">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
                    <span class="user-profile"><img src="{{asset('theme/assets/images/110x110.png')}}" class="img-circle" alt="user avatar"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                <li class="dropdown-item user-details">
                    <a href="javaScript:void(0);">
                    <div class="media">
                        <div class="avatar"><img class="align-self-start mr-3" src="{{asset('theme/assets/images/110x110.png')}}" alt="user avatar"></div>
                        <div class="media-body">
                        <h6 class="mt-2 user-title">{{ Auth::user()->name }}</h6>
                        <p class="user-subtitle">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    </a>
                    </li>
                    <li class="dropdown-divider"></li>
                    <li class="dropdown-item"><i class="icon-user mr-2"></i> My Profile</li>
                    <li class="dropdown-divider"></li>
                    <li class="dropdown-item"><i class="icon-settings mr-2"></i> Setting</li>
                    <li class="dropdown-divider"></li>
                    <li class="dropdown-item"><a  href="{{ route('logout') }}" onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                        <span class="text-white"><i class="icon-power mr-2"></i>{{ __('Logout') }}</span>
                        </a>
                    </li>
                </ul>
                </li>
            </ul>
            </nav>
        </header>
        <!--End topbar header-->
        <div class="clearfix"></div>
        <div class="content-wrapper">
            <div class="container-fluid">            
                @yield('content')
                <!--start overlay-->
                <div class="overlay toggle-menu"></div>
                <!--end overlay-->
            </div>
            <!-- End container-fluid-->
        </div><!--End content-wrapper-->
        <!--Start Back To Top Button-->
        <a href="javaScript:void(0);" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        <!--End Back To Top Button-->
        <!--Start footer-->
        <footer class="footer">
        <div class="container">
            <div class="text-center">
            Copyright © 2019 Demo Admin
            </div>
        </div>
        </footer>
        <!--End footer-->
        <!--start color switcher-->
        <div class="right-sidebar">
            <div class="switcher-icon">
            <i class="zmdi zmdi-settings zmdi-hc-spin"></i>
            </div>
            <div class="right-sidebar-content">
            
            
            <p class="mb-0">Header Colors</p>
            <hr>
            
            <div class="mb-3">
                <button type="button" id="default-header" class="btn btn-outline-primary">Default Header</button>
            </div>
            
            <ul class="switcher">
                <li id="header1"></li>
                <li id="header2"></li>
                <li id="header3"></li>
                <li id="header4"></li>
                <li id="header5"></li>
                <li id="header6"></li>
            </ul>

            <p class="mb-0">Sidebar Colors</p>
            <hr>
            
            <div class="mb-3">
                <button type="button" id="default-sidebar" class="btn btn-outline-primary">Default Sidebar</button>
            </div>
            
            <ul class="switcher">
                <li id="theme1"></li>
                <li id="theme2"></li>
                <li id="theme3"></li>
                <li id="theme4"></li>
                <li id="theme5"></li>
                <li id="theme6"></li>
            </ul>
            
            </div>
        </div>
        <!--end color switcher-->
    </div>
    <!-- Bootstrap core JavaScript-->
    <script src="{{asset('theme/assets/js/jquery.min.js')}}"></script>
    <script src="{{asset('theme/assets/js/popper.min.js')}}"></script>
    <script src="{{asset('theme/assets/js/bootstrap.min.js')}}"></script>
        
    <!-- simplebar js -->
    <script src="{{ asset('theme/assets/plugins/simplebar/js/simplebar.js')}}"></script>
    <!-- sidebar-menu js -->
    <script src="{{ asset('theme/assets/js/sidebar-menu.js')}}"></script>
    <!-- loader scripts -->
    <script src="{{ asset('theme/assets/js/jquery.loading-indicator.js')}}"></script>
    <!-- Custom scripts -->
    <script src="{{ asset('theme/assets/js/app-script.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/limonte-sweetalert2/8.11.8/sweetalert2.min.js"></script>
    @yield('script')
</body>
</html>
