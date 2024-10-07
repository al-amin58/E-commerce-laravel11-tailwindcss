<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name') }} - @yield('title')</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
    <!-- End fonts -->

    <!-- core:css -->
    <link rel="stylesheet" href="{{ asset('admin-assets') }}/assets/vendors/core/core.css">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet"
        href="{{ asset('admin-assets') }}/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.css">
    <!-- End plugin css for this page -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{ asset('admin-assets') }}/assets/vendors/flatpickr/flatpickr.min.css">
    <!-- End plugin css for this pae -->

    <!-- inject:css -->
    <link rel="stylesheet" href="{{ asset('admin-assets') }}/assets/fonts/feather-font/css/iconfont.css">
    <link rel="stylesheet" href="{{ asset('admin-assets') }}/assets/vendors/flag-icon-css/css/flag-icon.min.css">
    <!-- endinject -->

    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('admin-assets') }}/assets/css/demo2/style.css">
    <!-- End layout styles -->

    <link rel="shortcut icon" href="{{ asset('admin-assets') }}/assets/images/favicon.png" />

    <link rel="stylesheet" href="{{ asset('admin-assets') }}/assets/vendors/dropify/dist/dropify.min.css">
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{ asset('admin-assets') }}/assets/css/demo2/style.css">
    <!-- End layout styles -->

    <!-- TinyMCE CDN -->
    <script src="https://cdn.tiny.cloud/1/no-api-key/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>



    @vite('resources/css/app.css')
    <style>
        .inputbgtextcolor {
            background: #0c1427;
            color: white;
        }

        .tox .tox-mbtn {
            background: #0c1427 !important;
            color: white !important;
        }

        .tox .tox-tbtn {
            background: #0c1427 !important;
            color: white !important;
        }
        .tox .tox-tbtn svg{
            fill: #ffffff !important;
        }
    </style>
    @yield('css')
</head>

<body>
    <div class="main-wrapper ">

        <!-- partial:partials/_sidebar.html -->
        @include('admin.layouts.saidbar')
        <!-- partial -->

        <div class="page-wrapper">

            <!-- partial:partials/_navbar.html -->
            @include('admin.layouts.navbar')
            <!-- partial -->
            <div class="page-content">
                @yield('content')
            </div>
            <!-- partial:partials/_footer.html -->
            @include('admin.layouts.footer')
            <!-- partial -->

        </div>
    </div>

    <!-- core:js -->
    <script src="{{ asset('admin-assets') }}/assets/vendors/core/core.js"></script>
    <!-- endinject -->
    @yield('script')

    <!-- Plugin js for this page -->
    <script src="{{ asset('admin-assets') }}/assets/vendors/flatpickr/flatpickr.min.js"></script>
    <script src="{{ asset('admin-assets') }}/assets/vendors/apexcharts/apexcharts.min.js"></script>
    <!-- End plugin js for this page -->

    <!-- inject:js -->
    <script src="{{ asset('admin-assets') }}/assets/vendors/feather-icons/feather.min.js"></script>
    <script src="{{ asset('admin-assets') }}/assets/js/template.js"></script>
    <!-- endinject -->

    <!-- Custom js for this page -->
    <script src="{{ asset('admin-assets') }}/assets/js/dashboard-dark.js"></script>
    <!-- End custom js for this page -->
    <!-- Custom js for this page -->
    <script src="{{ asset('admin-assets') }}/assets/js/data-table.js"></script>
    <!-- Plugin js for this page -->
    <script src="{{ asset('admin-assets') }}/assets/vendors/datatables.net/jquery.dataTables.js"></script>
    <script src="{{ asset('admin-assets') }}/assets/vendors/datatables.net-bs5/dataTables.bootstrap5.js"></script>
    <!-- End plugin js for this page -->


    <script src="{{ asset('admin-assets') }}/assets/vendors/dropify/dist/dropify.min.js"></script>
    <script src="{{ asset('admin-assets') }}/assets/js/dropify.js"></script>




</body>

</html>
