<!doctype html>
<html lang="en" dir="ltr">
<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- TITLE -->
    <title>{{ config('app.name') }} - @yield('title')</title>

    <!-- FAVICON -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin-assets') }}/assets/images/brand/favicon.ico" />

    <!-- BOOTSTRAP CSS -->
    <link id="style" href="{{ asset('admin-assets') }}/assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" />

    <!-- STYLE CSS -->
    <link href="{{ asset('admin-assets') }}/assets/css/style.css" rel="stylesheet" />
    <link href="{{ asset('admin-assets') }}/assets/css/skin-modes.css" rel="stylesheet" />

    <!--- FONT-ICONS CSS -->
    <link href="{{ asset('admin-assets') }}/assets/plugins/icons/icons.css" rel="stylesheet" />

    <!-- INTERNAL Switcher css -->
    <link href="{{ asset('admin-assets') }}/assets/switcher/css/switcher.css" rel="stylesheet">
    <link href="{{ asset('admin-assets') }}/assets/switcher/demo.css" rel="stylesheet">

    @yield('css')
</head>

<body class="ltr app sidebar-mini">

<!-- Switcher-->
<!-- Switcher -->
@include('admin.layouts.switcher')
<!-- End Switcher -->
<!-- Switcher-->

<!-- GLOBAL-LOADER -->
<div id="global-loader">
    <img src="{{ asset('admin-assets') }}/assets/images/loader.svg" class="loader-img" alt="Loader">
</div>
<!-- /GLOBAL-LOADER -->

<!-- PAGE -->
<div class="page">
    <div class="page-main">

        <!-- app-Header -->
    @include('admin.layouts.navbar')
    <!-- /app-Header -->

        <!--APP-SIDEBAR-->
    @include('admin.layouts.saidbar')
    <!--/APP-SIDEBAR-->

        <!--app-content open-->
        <div class="app-content main-content mt-0">
            <div class="side-app">

                <!-- CONTAINER -->
                <div class="main-container container-fluid">

                    @yield('content')

                </div>
            </div>
        </div>
        <!-- CONTAINER CLOSED -->
    </div>

    <!-- FOOTER -->
@include('admin.layouts.footer')
<!-- FOOTER CLOSED -->

</div>
<!-- page -->

<!-- BACK-TO-TOP -->
<a href="#top" id="back-to-top"><i class="fa fa-long-arrow-up"></i></a>
@yield('script')

<!-- JQUERY JS -->
<script src="{{ asset('admin-assets') }}/assets/plugins/jquery/jquery.min.js"></script>

<!-- BOOTSTRAP JS -->
<script src="{{ asset('admin-assets') }}/assets/plugins/bootstrap/js/popper.min.js"></script>
<script src="{{ asset('admin-assets') }}/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- SIDE-MENU JS -->
<script src="{{ asset('admin-assets') }}/assets/plugins/sidemenu/sidemenu.js"></script>

<!-- Perfect SCROLLBAR JS-->
<script src="{{ asset('admin-assets') }}/assets/plugins/p-scroll/perfect-scrollbar.js"></script>
<script src="{{ asset('admin-assets') }}/assets/plugins/p-scroll/pscroll.js"></script>

<!-- STICKY JS -->
<script src="{{ asset('admin-assets') }}/assets/js/sticky.js"></script>


<!-- APEXCHART JS -->
<script src="{{ asset('admin-assets') }}/assets/js/apexcharts.js"></script>

<!-- INTERNAL SELECT2 JS -->
<script src="{{ asset('admin-assets') }}/assets/plugins/select2/select2.full.min.js"></script>

<!-- CHART-CIRCLE JS-->
<script src="{{ asset('admin-assets') }}/assets/plugins/circle-progress/circle-progress.min.js"></script>

<!-- INTERNAL DATA-TABLES JS-->
<script src="{{ asset('admin-assets') }}/assets/plugins/datatable/js/jquery.dataTables.min.js"></script>
<script src="{{ asset('admin-assets') }}/assets/plugins/datatable/js/dataTables.bootstrap5.js"></script>
<script src="{{ asset('admin-assets') }}/assets/plugins/datatable/dataTables.responsive.min.js"></script>

<!-- INDEX JS -->
<script src="{{ asset('admin-assets') }}/assets/js/index1.js"></script>
<script src="{{ asset('admin-assets') }}/assets/js/index.js"></script>

<!-- Reply JS-->
<script src="{{ asset('admin-assets') }}/assets/js/reply.js"></script>


<!-- COLOR THEME JS -->
<script src="{{ asset('admin-assets') }}/assets/js/themeColors.js"></script>

<!-- CUSTOM JS -->
<script src="{{ asset('admin-assets') }}/assets/js/custom.js"></script>

<!-- SWITCHER JS -->
<script src="{{ asset('admin-assets') }}/assets/switcher/js/switcher.js"></script>

<!-- TASKS LIST JS-->
<script src="{{ asset('admin-assets') }}/assets/js/tasks-list.js"></script>


</body>

</html>
