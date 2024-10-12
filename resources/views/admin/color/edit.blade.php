@extends('admin.layouts.app')
@section('title')
    Color edit
@endsection
@section('content')

    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Color Edit</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Color</a></li>
                <li class="breadcrumb-item active" aria-current="page">Edit</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->
    @include('errors.message')
    <div class="row">
        <div class="col-md-8 mx-auto  stretch-card">
            <div class="card">
                <div class="card-body">

                    <h6 class="card-title">Edit Form</h6>
                    <form method="POST" action="{{ route('color.update', $color->id) }}"
                          enctype="multipart/form-data" class="forms-sample">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Color Name:</label>
                            <input type="text" name="color" value="{{ $color->color }}"
                                   class="form-control inputbgtextcolor" id="exampleInputUsername1" autocomplete="off"
                                   placeholder="Color Name">
                        </div>
                        <div class="form-group mt-2">
                            <label class="form-label text-muted">Color Code:</label>
                            <div class="input-group">
                                <input type="text" name="color_code" value="{{ $color->color_code }}" class="form-control" placeholder="Enter Color Code (e.g., #FFFFFF)" required>
                            </div>
                        </div>
                        <div class="form-group mt-2">
                            <label for="categoryStatus">Status</label>
                            <select class="form-control" name="status" id="categoryStatus" >
                                <option value="active" {{ $color->status == 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="inactive" {{ $color->status == 'inactive' ? 'selected' : '' }}>
                                    Inactive</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mt-3">Update</button>
                    </form>

                </div>
            </div>
        </div>

    </div>
@endsection

