<!doctype html>
<html lang="en" dir="ltr"> <!-- This "custom-app.blade.php" master page is used only for "custom" page content present in "views/livewire" Ex: login, 404 -->

<!-- Mirrored from laravel8.spruko.com/noa/error404 by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 06 May 2023 13:13:12 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Noa - Laravel Bootstrap 5 Admin & Dashboard Template">
    <meta name="author" content="Spruko Technologies Private Limited">
    <meta name="keywords" content="laravel admin template, bootstrap admin template, admin dashboard template, admin dashboard, admin template, admin, bootstrap 5, laravel admin, laravel admin dashboard template, laravel ui template, laravel admin panel, admin panel, laravel admin dashboard, laravel template, admin ui dashboard">

    <!-- TITLE -->
    <title>Noa - Laravel Bootstrap 5 Admin & Dashboard Template</title>

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

</head>


<body class="ltr error-bg">

<!-- GLOBAL-LOADER -->
<div id="global-loader">
    <img src="{{ asset('admin-assets') }}/assets/images/loader.svg" class="loader-img" alt="Loader">
</div>


<!-- PAGE -->
<div class="page">
    <!-- PAGE-CONTENT OPEN -->
    <div class="page-content error-page error2">
        <div class="container text-center">
            <div class="error-template">
                <h2 class="text-white mb-2">404<span class="fs-20">error</span></h2>
                <h4 class="mb-2">Page Not Found</h4>
                <h5 class="error-details text-white">
                    Oopps!! The page you were looking for doesn't exist.
                </h5>
                <div class="text-center">
                    <a class="btn btn-primary mt-5 mb-5" href="{{url('/')}}"> <i class="fa fa-long-arrow-left"></i> Back to Home </a>
                </div>
            </div>
        </div>
    </div>
    <!-- PAGE-CONTENT OPEN CLOSED -->
</div>
<!-- End PAGE -->


<!-- JQUERY JS -->
<script src="{{ asset('admin-assets') }}/assets/plugins/jquery/jquery.min.js"></script>

<!-- BOOTSTRAP JS -->
<script src="{{ asset('admin-assets') }}/assets/plugins/bootstrap/js/popper.min.js"></script>
<script src="{{ asset('admin-assets') }}/assets/plugins/bootstrap/js/bootstrap.min.js"></script>

<!-- Perfect SCROLLBAR JS-->
<script src="{{ asset('admin-assets') }}/assets/plugins/p-scroll/perfect-scrollbar.js"></script>

<!-- STICKY JS -->
<script src="{{ asset('admin-assets') }}/assets/js/sticky.js"></script>



<!-- COLOR THEME JS -->
<script src="{{ asset('admin-assets') }}/assets/js/themeColors.js"></script>

<!-- CUSTOM JS -->
<script src="{{ asset('admin-assets') }}/assets/js/custom.js"></script>

<!-- SWITCHER JS -->
<script src="{{ asset('admin-assets') }}/assets/switcher/js/switcher.js"></script>

</body>


<!-- Mirrored from laravel8.spruko.com/noa/error404 by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 06 May 2023 13:13:12 GMT -->
</html>
