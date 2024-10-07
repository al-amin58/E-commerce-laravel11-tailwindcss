<!DOCTYPE html>

<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">

	<title>{{ config('app.name') }} - Admin Login</title>

  <!-- Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" rel="stylesheet">
  <!-- End fonts -->

	<!-- core:css -->
	<link rel="stylesheet" href="{{ asset('admin-assets') }}/assets/vendors/core/core.css">
	<!-- endinject -->

	<!-- Plugin css for this page -->
	<!-- End plugin css for this page -->

	<!-- inject:css -->
	<link rel="stylesheet" href="{{ asset('admin-assets') }}/assets/fonts/feather-font/css/iconfont.css">
	<link rel="stylesheet" href="{{ asset('admin-assets') }}/assets/vendors/flag-icon-css/css/flag-icon.min.css">
	<!-- endinject -->

  <!-- Layout styles -->
	<link rel="stylesheet" href="{{ asset('admin-assets') }}/assets/css/demo2/style.css">
  <!-- End layout styles -->

</head>
<body>
	<div class="main-wrapper">
		<div class="page-wrapper full-page">
			<div class="page-content d-flex align-items-center justify-content-center">

				<div class="row w-100 mx-0 auth-page">
					<div class="col-md-8 col-xl-6 mx-auto">
						<div class="card">
							<div class="row">
                                <div class="col-md-4 pe-md-0">
                                    <div class="auth-side-wrapper">
                                        <img src="{{ asset('admin-assets') }}/assets/images/admin_login.png" alt="">
                                    </div>
                                </div>
                                <div class="col-md-8 ps-md-0">
                                    <div class="auth-form-wrapper px-4 py-5">
                                        <p  class="noble-ui-logo logo-light d-block mb-2">Admin </span></a>
                                        <h5 class="text-muted fw-normal mb-4">Welcome Admin Login to your account.</h5>

                                        {{-- Error show section --}}
                                        @if ($errors->any())
                                            <div class="mb-4">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li class="text-red-500" style="color: red">{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif

                                        {{-- Lgoin section  --}}
                                        <form action="{{ route('admin.login') }}" method="POST" class="forms-sample">
                                            @csrf
                                            <div class="mb-3">
                                                <label for="email" class="form-label">Email address</label>
                                                <input type="email" name="email"  class="form-control" id="email" required placeholder="Email">
                                            </div>
                                            <div class="mb-3">
                                                <label for="password" class="form-label">Password</label>
                                                <input type="password" class="form-control" id="password" name="password" required placeholder="Password">
                                            </div>


                                            <button type="submit" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0"> Login Admin</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>

</body>
</html>
