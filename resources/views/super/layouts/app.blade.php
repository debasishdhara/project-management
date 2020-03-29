<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

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
</head>
<body>
    <!-- start loader -->
    <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner"><div class="loader"></div></div></div></div>
    <!-- end loader -->
    {{--  <div id="app">  --}}
        {{--  <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>  --}}
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
            <div class="avatar"><img class="mr-3 side-user-img" src="https://via.placeholder.com/110x110" alt="user avatar"></div>
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
            <li class="sidebar-menu">
                <a href="javaScript:void(0);" class="waves-effect">
                <i class="zmdi zmdi-view-dashboard"></i> <span>Dashboard</span>
                </a>
                {{--  <ul class="sidebar-submenu">
                <li><a href="javaScript:void(0);"><i class="zmdi zmdi-dot-circle-alt"></i> eCommerce</a></li>
                <li><a href="javaScript:void(0);"><i class="zmdi zmdi-dot-circle-alt"></i> Human Resources</a></li>
                <li><a href="javaScript:void(0);"><i class="zmdi zmdi-dot-circle-alt"></i> Digital Marketing</a></li>
                <li><a href="javaScript:void(0);"><i class="zmdi zmdi-dot-circle-alt"></i> Property Listings</a></li>
                <li><a href="javaScript:void(0);"><i class="zmdi zmdi-dot-circle-alt"></i> Services & Support</a></li>
                <li><a href="javaScript:void(0);"><i class="zmdi zmdi-dot-circle-alt"></i> Logistics</a></li>
                </ul>  --}}
            </li>
            <li>
                <a href="javaScript:void(0);" class="waves-effect">
                <i class="fa fa-share"></i> <span>Multilevel</span>
                <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="sidebar-submenu">
                <li><a href="javaScript:void(0);"><i class="zmdi zmdi-dot-circle-alt"></i> Level One</a></li>
                <li>
                    <a href="javaScript:void(0);"><i class="zmdi zmdi-dot-circle-alt"></i> Level One <i class="fa fa-angle-left pull-right"></i></a>
                    <ul class="sidebar-submenu">
                    <li><a href="javaScript:void(0);"><i class="zmdi zmdi-dot-circle-alt"></i> Level Two</a></li>
                    <li>
                        <a href="javaScript:void(0);"><i class="zmdi zmdi-dot-circle-alt"></i> Level Two <i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="sidebar-submenu">
                        <li><a href="javaScript:void(0);"><i class="zmdi zmdi-dot-circle-alt"></i> Level Three</a></li>
                        <li><a href="javaScript:void(0);"><i class="zmdi zmdi-dot-circle-alt"></i> Level Three</a></li>
                        </ul>
                    </li>
                    </ul>
                </li>
                <li><a href="javaScript:void(0);" class="waves-effect"><i class="zmdi zmdi-dot-circle-alt"></i> Level One</a></li>
                </ul>
            </li>
            {{--  <li class="sidebar-header">LABELS</li>
            <li><a href="javaScript:void(0);" class="waves-effect"><i class="zmdi zmdi-coffee text-danger"></i> <span>Important</span></a></li>
            <li><a href="javaScript:void(0);" class="waves-effect"><i class="zmdi zmdi-chart-donut text-success"></i> <span>Warning</span></a></li>
            <li><a href="javaScript:void(0);" class="waves-effect"><i class="zmdi zmdi-share text-info"></i> <span>Information</span></a></li>  --}}
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
                    {{-- <span class="badge badge-primary badge-up">12</span> --}}
                </a>
                {{-- <div class="dropdown-menu dropdown-menu-right">
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                        You have 12 new messages
                        <span class="badge badge-primary">12</span>
                        </li>
                        <li class="list-group-item">
                        <a href="javaScript:void(0);">
                        <div class="media">
                            <div class="avatar"><img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="user avatar"></div>
                            <div class="media-body">
                            <h6 class="mt-0 msg-title">Jhon Deo</h6>
                            <p class="msg-info">Lorem ipsum dolor sit amet...</p>
                            <small>Today, 4:10 PM</small>
                            </div>
                        </div>
                        </a>
                        </li>
                        <li class="list-group-item">
                        <a href="javaScript:void(0);">
                        <div class="media">
                            <div class="avatar"><img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="user avatar"></div>
                            <div class="media-body">
                            <h6 class="mt-0 msg-title">Sara Jen</h6>
                            <p class="msg-info">Lorem ipsum dolor sit amet...</p>
                            <small>Yesterday, 8:30 AM</small>
                            </div>
                        </div>
                        </a>
                        </li>
                        <li class="list-group-item">
                        <a href="javaScript:void(0);">
                        <div class="media">
                            <div class="avatar"><img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="user avatar"></div>
                            <div class="media-body">
                            <h6 class="mt-0 msg-title">Dannish Josh</h6>
                            <p class="msg-info">Lorem ipsum dolor sit amet...</p>
                            <small>5/11/2018, 2:50 PM</small>
                            </div>
                        </div>
                        </a>
                        </li>
                        <li class="list-group-item">
                        <a href="javaScript:void(0);">
                        <div class="media">
                            <div class="avatar"><img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="user avatar"></div>
                            <div class="media-body">
                            <h6 class="mt-0 msg-title">Katrina Mccoy</h6>
                            <p class="msg-info">Lorem ipsum dolor sit amet.</p>
                            <small>1/11/2018, 2:50 PM</small>
                            </div>
                        </div>
                        </a>
                        </li>
                        <li class="list-group-item text-center"><a href="javaScript:void(0);">See All Messages</a></li>
                    </ul>
                </div> --}}
                </li>
                <li class="nav-item dropdown-lg">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void(0);">
                <i class="fa fa-bell-o"></i>
                {{-- <span class="badge badge-info badge-up">14</span> --}}
                </a>
                {{-- <div class="dropdown-menu dropdown-menu-right">
                    <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                    You have 14 Notifications
                    <span class="badge badge-info">14</span>
                    </li>
                    <li class="list-group-item">
                    <a href="javaScript:void(0);">
                    <div class="media">
                        <i class="zmdi zmdi-accounts fa-2x mr-3 text-info"></i>
                        <div class="media-body">
                        <h6 class="mt-0 msg-title">New Registered Users</h6>
                        <p class="msg-info">Lorem ipsum dolor sit amet...</p>
                        </div>
                    </div>
                    </a>
                    </li>
                    <li class="list-group-item">
                    <a href="javaScript:void(0);">
                    <div class="media">
                        <i class="zmdi zmdi-coffee fa-2x mr-3 text-warning"></i>
                        <div class="media-body">
                        <h6 class="mt-0 msg-title">New Received Orders</h6>
                        <p class="msg-info">Lorem ipsum dolor sit amet...</p>
                        </div>
                    </div>
                    </a>
                    </li>
                    <li class="list-group-item">
                    <a href="javaScript:void(0);">
                    <div class="media">
                        <i class="zmdi zmdi-notifications-active fa-2x mr-3 text-danger"></i>
                        <div class="media-body">
                        <h6 class="mt-0 msg-title">New Updates</h6>
                        <p class="msg-info">Lorem ipsum dolor sit amet...</p>
                        </div>
                    </div>
                    </a>
                    </li>
                    <li class="list-group-item text-center"><a href="javaScript:void(0);">See All Notifications</a></li>
                    </ul>
                </div> --}}
                </li>
                {{-- <li class="nav-item language">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret waves-effect" data-toggle="dropdown" href="javascript:void(0);"><i class="fa fa-flag"></i></a>
                <ul class="dropdown-menu dropdown-menu-right">
                    <li class="dropdown-item"> <i class="flag-icon flag-icon-gb mr-2"></i> English</li>
                    <li class="dropdown-item"> <i class="flag-icon flag-icon-fr mr-2"></i> French</li>
                    <li class="dropdown-item"> <i class="flag-icon flag-icon-cn mr-2"></i> Chinese</li>
                    <li class="dropdown-item"> <i class="flag-icon flag-icon-de mr-2"></i> German</li>
                    </ul>
                </li> --}}
                <li class="nav-item">
                <a class="nav-link dropdown-toggle dropdown-toggle-nocaret" data-toggle="dropdown" href="#">
                    <span class="user-profile"><img src="https://via.placeholder.com/110x110" class="img-circle" alt="user avatar"></span>
                </a>
                <ul class="dropdown-menu dropdown-menu-right">
                <li class="dropdown-item user-details">
                    <a href="javaScript:void(0);">
                    <div class="media">
                        <div class="avatar"><img class="align-self-start mr-3" src="https://via.placeholder.com/110x110" alt="user avatar"></div>
                        <div class="media-body">
                        <h6 class="mt-2 user-title">{{ Auth::user()->name }}</h6>
                        <p class="user-subtitle">{{ Auth::user()->email }}</p>
                        </div>
                    </div>
                    </a>
                    </li>
                    {{-- <li class="dropdown-divider"></li>
                    <li class="dropdown-item"><i class="icon-envelope mr-2"></i> Inbox</li> --}}
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
    <!-- Chart js -->
    
    <script src="{{ asset('theme/assets/plugins/Chart.js/Chart.min.js')}}"></script>
    <!-- Vector map JavaScript -->
    <script src="{{ asset('theme/assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js')}}"></script>
    <script src="{{ asset('theme/assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js')}}"></script>
    <!-- Easy Pie Chart JS -->
    <script src="{{ asset('theme/assets/plugins/jquery.easy-pie-chart/jquery.easypiechart.min.js')}}"></script>
    <!-- Sparkline JS -->
    <script src="{{ asset('theme/assets/plugins/sparkline-charts/jquery.sparkline.min.js')}}"></script>
    <script src="{{ asset('theme/assets/plugins/jquery-knob/excanvas.js')}}"></script>
    <script src="{{ asset('theme/assets/plugins/jquery-knob/jquery.knob.js')}}"></script>
        
        <script>
            $(function() {
                $(".knob").knob();
            });
        </script>
    <!-- Index js -->
    {{--  <script src="{{ asset('theme/assets/js/index.js')}}"></script>  --}}
</body>
</html>
