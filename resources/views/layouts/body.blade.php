<!DOCTYPE html>

<html lang="en" class="default-style layout-fixed layout-navbar-fixed">
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>

    <!-- CSRF Token -->
    <title>{{ config('app.name', 'Tutorias') }}</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">
    <meta name="description" content="MODULO DE TUTORIAS" />
    <meta name="keywords" content="">
    <meta name="author" content="Codedthemes" />
    <link rel="icon" type="image/x-icon" href="{{asset('dashboard_assets/img/favicon.ico')}}">


    <!-- Google fonts -->
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">

    <!-- Icon fonts -->
    <link rel="stylesheet" href="{{asset('dashboard_assets/fonts/fontawesome.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard_assets/fonts/ionicons.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard_assets/fonts/linearicons.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard_assets/fonts/open-iconic.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard_assets/fonts/pe-icon-7-stroke.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard_assets/fonts/feather.css')}}">

    <!-- Core stylesheets -->
    <link rel="stylesheet" href="{{asset('dashboard_assets/css/bootstrap-material.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard_assets/css/shreerang-material.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard_assets/css/uikit.css')}}">


    <!-- Libs -->
    <link rel="stylesheet" href="{{asset('dashboard_assets/libs/perfect-scrollbar/perfect-scrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('dashboard_assets/libs/flot/flot.css')}}">

    <link rel="stylesheet" href="{{asset('css/Galeria_dashboard/loader.css')}}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    @yield('css')


</head>

<body>
    <!-- [ Preloader ] Start -->
    <div class="page-loader">
        <div class="bg-primary"></div>
    </div>
    <div class="conte_loader_MyStyle" style="display: flex;">
        <div class="loader_MyStyle"></div>
    </div>
    <!-- [ Preloader ] End -->

    <!-- [ Layout wrapper ] Start -->
    <div class="layout-wrapper layout-2">
        <div class="layout-inner">
            <!-- [ Layout sidenav ] Start -->

                @include('layouts.sidebar')

            <!-- [ Layout sidenav ] End -->
            <!-- [ Layout container ] Start -->
            <div class="layout-container">
                <!-- [ Layout navbar ( Header ) ] Start -->
                  @include('layouts.navar')
                <!-- [ Layout navbar ( Header ) ] End -->

                <!-- [ Layout content ] Start -->
                <div class="layout-content">

                    <!-- [ content ] Start -->
                       @yield('contenido_page')
                </div>
                    <!-- [ content ] End -->

                    <!-- [ Layout footer ] Start -->
                      @include('layouts.footer')
                    <!-- [ Layout footer ] End -->

                </div>
                <!-- [ Layout content ] Start -->

            </div>
            <!-- [ Layout container ] End -->
        </div>
        <!-- Overlay -->
        <div class="layout-overlay layout-sidenav-toggle"></div>
    </div>
    <!-- [ Layout wrapper] End -->



    <!-- Core scripts -->
    <script src="{{asset('dashboard_assets/js/jquery-3.2.1.min.js')}}"></script>

    <script src="{{asset('dashboard_assets/js/pace.js')}}"></script>


     <script src="{{asset('dashboard_assets/libs/popper/popper.js')}}"></script>
    <script src="{{asset('dashboard_assets/js/bootstrap.js')}}"></script>
    <script src="{{asset('dashboard_assets/js/sidenav.js')}}"></script>
    <script src="{{asset('dashboard_assets/js/layout-helpers.js')}}"></script>
    <script src="{{asset('dashboard_assets/js/material-ripple.js')}}"></script>

    <!-- Libs -->
    <script src="{{asset('dashboard_assets/libs/perfect-scrollbar/perfect-scrollbar.js')}}"></script>

    <!-- Demo -->
    <script src="{{asset('dashboard_assets/js/demo.js')}}"></script>

    <script>

        let csrf_token=$('meta[name="csrf-token"]').attr('content');
        const headers_config={"Content-Type": "application/json","Accept": "application/json","X-Requested-With": "XMLHttpRequest","X-CSRF-Token":csrf_token};


    </script>
    @yield('script')

    <script>
        $(function(){
            $('.conte_loader_MyStyle').css({display:'none'});
        })
    </script>

</body>

</html>
