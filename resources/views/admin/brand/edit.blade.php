@extends('admin.layouts.app')
@section('title')
    Brand edit
@endsection
@section('content')

    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Brand Edit</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Brand</a></li>
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
                    <form method="POST" action="{{ route('brand.update', $brand->id) }}"
                          enctype="multipart/form-data" class="forms-sample">
                        @csrf
                        @method('PUT')
                        <div class="mb-3">
                            <label for="exampleInputUsername1" class="form-label">Brand Name:</label>
                            <input type="text" name="brand_name" value="{{ $brand->brand_name }}"
                                   class="form-control inputbgtextcolor" id="exampleInputUsername1" autocomplete="off"
                                   placeholder="Brand Name">
                        </div>
                        <div class="form-group mt-2" style="margin-bottom: 100px">
                            <label for="categoryImageInput">Image:</label>
                            <div class="d-flex" style=" max-width: 100px; height: 50px;">
                                <span id="uploadImage" class="cursor-pointer font-mono text-xl" role="button"
                                      aria-label="Upload Image">
                                    <svg viewBox="0 0 1024 1024" class="w-20" version="1.1"
                                         xmlns="http://www.w3.org/2000/svg" fill="#D74825">
                                        <path
                                            d="M736.68 435.86a173.773 173.773 0 0 1 172.042 172.038c0.578 44.907-18.093 87.822-48.461 119.698-32.761 34.387-76.991 51.744-123.581 52.343-68.202 0.876-68.284 106.718 0 105.841 152.654-1.964 275.918-125.229 277.883-277.883 1.964-152.664-128.188-275.956-277.883-277.879-68.284-0.878-68.202 104.965 0 105.842z"
                                            fill="#312782"></path>
                                        <path
                                            d="M285.262 779.307A173.773 173.773 0 0 1 113.22 607.266c-0.577-44.909 18.09-87.823 48.461-119.705 32.759-34.386 76.988-51.737 123.58-52.337 68.2-0.877 68.284-106.721 0-105.842C132.605 331.344 9.341 454.607 7.379 607.266 5.417 759.929 135.565 883.225 285.262 885.148c68.284 0.876 68.2-104.965 0-105.841z"
                                            fill="#D74825"></path>
                                        <path
                                            d="M339.68 384.204a173.762 173.762 0 0 1 172.037-172.038c44.908-0.577 87.822 18.092 119.698 48.462 34.388 32.759 51.743 76.985 52.343 123.576 0.877 68.199 106.72 68.284 105.843 0-1.964-152.653-125.231-275.917-277.884-277.879-152.664-1.962-275.954 128.182-277.878 277.879-0.88 68.284 104.964 68.199 105.841 0z"
                                            fill="#D74825"></path>
                                        <path
                                            d="M545.039 473.078c16.542 16.542 16.542 43.356 0 59.896l-122.89 122.895c-16.542 16.538-43.357 16.538-59.896 0-16.542-16.546-16.542-43.362 0-59.899l122.892-122.892c16.537-16.542 43.355-16.542 59.894 0z"
                                            fill="#312782"></path>
                                        <path
                                            d="M485.17 473.078c16.537-16.539 43.354-16.539 59.892 0l122.896 122.896c16.538 16.533 16.538 43.354 0 59.896-16.541 16.538-43.361 16.538-59.898 0L485.17 532.979c-16.547-16.543-16.547-43.359 0-59.901z"
                                            fill="#312782"></path>
                                        <path
                                            d="M514.045 634.097c23.972 0 43.402 19.433 43.402 43.399v178.086c0 23.968-19.432 43.398-43.402 43.398-23.964 0-43.396-19.432-43.396-43.398V677.496c0.001-23.968 19.433-43.399 43.396-43.399z"
                                            fill="#D74825"></path>
                                    </svg>
                                </span>
                                <img id="imagePreview" src="{{ asset('storage/' . $brand->image) }}"
                                     alt="Image Preview"
                                     style="display: {{ $brand->image ? 'block' : 'none' }}; margin-top: 10px; max-width: 350px; height: 100px;" />
                            </div>
                            <input hidden type="file"  name="image"
                                   class="form-control inputbgtextcolor" id="categoryImageInput"
                                   accept="image/png, image/jpeg, image/jpg, image/gif"
                                   onchange="onFileChange(event)">

                        </div>

                        <div class="form-group mt-2">
                            <label for="categoryStatus">Status</label>
                            <select class="form-control" name="status" id="categoryStatus" >
                                <option value="active" {{ $brand->status == 'active' ? 'selected' : '' }}>Active
                                </option>
                                <option value="inactive" {{ $brand->status == 'inactive' ? 'selected' : '' }}>
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
@section('script')
    // This is for Image
    <script>
        // Open file dialog when the SVG is clicked
        document.getElementById('uploadImage').addEventListener('click', function() {
            document.getElementById('categoryImageInput').click();
        });

        // Open file dialog when the image preview is clicked
        document.getElementById('imagePreview').addEventListener('click', function() {
            document.getElementById('categoryImageInput').click();
        });


        function onFileChange(event) {
            const input = event.target;
            const file = input.files[0];
            const preview = document.getElementById('imagePreview');
            const uploadButton = document.getElementById('uploadImage');

            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    preview.src = e.target.result;
                    preview.style.display = 'block';
                    uploadButton.style.display = 'none'; // Hide the upload button
                };
                reader.readAsDataURL(file);
            } else {
                preview.src = '';
                preview.style.display = 'none';
                uploadButton.style.display = 'inline'; // Show the upload button again if no file is selected
            }
        }
    </script>

@endsection
