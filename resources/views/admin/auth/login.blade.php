<!doctype html>
<html lang="en" >
<head>

    <!-- META DATA -->
    <meta charset="UTF-8">
    <meta name='viewport' content='width=device-width, initial-scale=1.0, user-scalable=0'>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- TITLE -->
    <title>{{ config('app.name') }} - Admin Login</title>

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


<body class="ltr login-img">




<!-- GLOBAL-LOADER -->
<div id="global-loader">
    <img src="{{ asset('admin-assets') }}/assets/images/loader.svg" class="loader-img" alt="Loader">
</div>



<!-- PAGE -->
<div class="page">
    <div>

        <div class="container-login100 ">

            <div class="wrap-login100 p-0 col-4 mx-auto">
                <div class="card-body ">
                    @include('errors.message')
                    <span class="login100-form-title"> Admin Login</span>
                    <form action="{{ route('admin.login') }}" method="POST" class="login100-form mx-auto validate-form" >
                        @csrf

                        <div class="wrap-input100 validate-input" data-bs-validate = "Valid email is required: ex@abc.xyz">
                            <input class="input100" type="text" name="email" required placeholder="Email">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
											<i class="zmdi zmdi-email" aria-hidden="true"></i>
										</span>
                        </div>
                        <div class="wrap-input100 validate-input" data-bs-validate = "Password is required">
                            <input class="input100" type="password" name="password" required placeholder="Password">
                            <span class="focus-input100"></span>
                            <span class="symbol-input100">
											<i class="zmdi zmdi-lock" aria-hidden="true"></i>
										</span>
                        </div>

                            <button type="submit" class="login100-form-btn mt-5 btn-primary">
                                Login Admin
                            </button>

                    </form>
                </div>
            </div>
        </div>
        <!-- CONTAINER CLOSED -->
    </div>
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


<!-- Mirrored from laravel8.spruko.com/noa/login by HTTrack Website Copier/3.x [XR&CO'2014], Sat, 06 May 2023 13:11:49 GMT -->
</html>
