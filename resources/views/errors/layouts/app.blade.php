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

    @yield('style')
</head>
<body>
    <!-- start loader -->
    <div id="pageloader-overlay" class="visible incoming"><div class="loader-wrapper-outer"><div class="loader-wrapper-inner"><div class="loader"></div></div></div></div>
    <!-- end loader -->
    <!-- Start wrapper-->
    <div id="wrapper">        
                @yield('content')
                <!--start overlay-->
                <div class="overlay toggle-menu"></div>
                <!--end overlay-->
        <!--Start Back To Top Button-->
        <a href="javaScript:void(0);" class="back-to-top"><i class="fa fa-angle-double-up"></i> </a>
        <!--End Back To Top Button-->
        {{--  <!--Start footer-->
        <footer class="footer">
        <div class="container">
            <div class="text-center">
            Copyright © 2019 Demo Admin
            </div>
        </div>
        </footer>
        <!--End footer-->  --}}
       
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
    @yield('script')
</body>
</html>
