@extends('admin.layouts.app')
@section('title')
    Admin Profile
@endsection
@section('content')


        <div class="row">
            <div class="col-12 grid-margin">
                <div class="card">
                    <div class="position-relative">
                        <figure class="overflow-hidden mb-0 d-flex justify-content-center">
                            <img src="{{ asset('admin-assets') }}/assets/images/Admin_Profile_banner.png"class="rounded-top"
                                alt="profile cover">
                        </figure>
                        <div
                            class="d-flex justify-content-between align-items-center position-absolute top-90 w-100 px-2 px-md-4 mt-n4">
                            <div>
                                <img class="wd-70 rounded-circle"
                                    src=" {{ asset('admin-assets') }}/assets/images/admin_profile_icon.png" alt="profile">
                                <span class="h4 ms-3 text-dark">{{ $profile->name }}</span>
                            </div>
                            <div class="d-none d-md-block ">
                                <button class="btn btn-primary btn-icon-text flex">
                                    <i data-feather="edit" class="btn-icon-prepend"></i> <p>Edit profile</p>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center p-3 rounded-bottom">
                        <ul class="d-flex align-items-center m-0 p-0">
                            <li class="d-flex align-items-center active">
                                <i class="me-1 icon-md text-primary" data-feather="columns"></i>
                                <a class="pt-1px d-none d-md-block text-primary" href="#">Profile</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row profile-body">
            <!-- left wrapper start -->
            <div class="d-none d-md-block col-md-4 col-xl-3 left-wrapper">
                <div class="card rounded">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <h6 class="card-title mb-0">About</h6>
                        </div>

                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Lives:</label>
                            <p class="text-muted">Dhaka, Bangladesh</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Email:</label>
                            <p class="text-muted">{{ $profile->email }}</p>
                        </div>
                        <div class="mt-3">
                            <label class="tx-11 fw-bolder mb-0 text-uppercase">Website:</label>
                            <a href="{{ config('app.url') }}" class="text-muted">{{ config('app.url') }}</a>
                        </div>

                    </div>
                </div>
            </div>
            <!-- left wrapper end -->



            <!-- right wrapper start -->
            <div class="col-md-8 col-xl-6 middle-wrapper">
                <div class="row">
                    <div class="card">
                        <div class="card-body">
                            @if (session('status'))
                                <div class="alert alert-success mt-2">{{ session('status') }}</div>
                            @endif
                            @if (session('error'))
                                <div class="alert alert-danger mt-2">{{ session('error') }}</div>
                            @endif

                            @if ($errors->any())
                                <div class="alert alert-danger mt-2">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif

                            <form method="POST" action="{{ route('admin.profile.update', $profile->id) }}"
                                class="forms-sample">
                                @csrf
                                @method('PUT')
                                <div class="mb-3">
                                    <label for="name1" class="form-label">Admin Name</label>
                                    <input type="text" value="{{ old('name', $profile->name) }}" name="name"
                                        class="form-control inputbgtextcolor" id="name1">
                                </div>
                                <div class="mb-3">
                                    <label for="Email1" class="form-label">Email address</label>
                                    <input type="email" value="{{ old('email', $profile->email) }}" name="email"
                                        class="form-control inputbgtextcolor"  id="Email1">
                                </div>
                                <div class="mb-3">
                                    <p class="text-red-600 text-xs">If your Need change password. The password must include at least one uppercase letter, one lowercase letter, and one number.</p>
                                    <label for="Password1" class="form-label">Password</label>
                                    <input type="password" name="password" class="form-control inputbgtextcolor" id="Password1">
                                </div>
                                <button type="submit" class="btn btn-primary me-2">Update</button>
                            </form>
                        </div>

                    </div>

                </div>
            </div>
            <!-- right wrapper end -->
        </div>


@endsection
