@extends('admin.layouts.app')
@section('title')
    Admin Profile
@endsection
@section('content')

    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Profile</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Pages</a></li>
                <li class="breadcrumb-item active" aria-current="page">Profile</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->

    <!-- ROW-1 OPEN -->
    <div class="row" id="user-profile">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-lg-12 col-md-12 col-xl-6">
                            <div class="d-flex flex-wrap align-items-center">
                                <div class="profile-img-main rounded">
                                    <img src="{{ asset('admin-assets') }}/assets/images/faces/18.jpg" alt="img" class="m-0 p-1 rounded hrem-6">
                                </div>
                                <div class="ms-4">
                                    <h4>{{ $profile->name }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12 col-md-12 col-xl-6">
                            <div class="d-md-flex flex justify-content-lg-end">

                                <div class="media m-3">
                                    <div class="media-icon bg-info me-3 mt-1">
                                        <i class="fe fe-users  fs-20 text-white"></i>
                                    </div>
                                    <div class="media-body">
                                        <span class="text-muted">Email</span>
                                        <div class="fw-semibold fs-25">
                                            {{ $profile->email }}
                                        </div>
                                    </div>
                                </div>
                                <div class="media m-3">
                                    <div class="media-icon bg-warning me-3 mt-1">
                                        <a href="{{ config('app.url') }}"> <i class="fe fe-wifi fs-20 text-white"></i></a>
                                    </div>
                                    <div class="media-body">
                                        <span class="text-muted">Website</span>
                                        <div class="fw-semibold fs-25">
                                            <a href="{{ config('app.url') }}">{{ config('app.url') }}</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="border-top">
                    <div class="wideget-user-tab">
                        <div class="tab-menu-heading">
                            <div class="tabs-menu1">
                                <ul class="nav">
                                    <li><a href="#profile" class="active show" data-bs-toggle="tab">Profile</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-content">
                <div id="profile">
                    <div class="card col-md-6 col-lg-6 col-xl-6 mx-auto">
                        <div class="card-body border-0 ">
                            <form method="POST" action="{{ route('admin.profile.update', $profile->id) }}" class="form-horizontal">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                        <p class="mb-4 text-17">Admin Info</p>
                                    @include('errors.message')
                                    <div class="form-group">
                                        <label for="username" class="form-label">Admin Name</label>
                                        <input type="text" name="name" class="form-control" id="username" value="{{ old('name', $profile->name) }}">
                                    </div>
                                    <div class="form-group">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" name="email" class="form-control" id="email" value="{{ old('email', $profile->email) }}">
                                    </div>
                                    <div class="form-group">
                                        <p class="text-danger small">If your Need change password. The password must include at least one uppercase letter, one lowercase letter, and one number.</p>
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password" class="form-control" id="password" >
                                    </div>
                                    <button type="submit" class="btn btn-primary me-2">Update</button>

                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div><!-- COL-END -->
    </div>
    <!-- ROW-1 CLOSED -->

@endsection
