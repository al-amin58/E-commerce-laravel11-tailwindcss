@extends('admin.layouts.app')
@section('title')
    main Category
@endsection
@section('content')

    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Main Category List</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Category</a></li>
                <li class="breadcrumb-item active" aria-current="page">Main Category list</li>
            </ol>
        </div>
    </div>
    <!-- PAGE-HEADER END -->
    <!-- Row -->
    <div class="row">
        <div class="col-lg-12">
            <!--div-->
            <div class="card" id="modal-input">
                <div class="card-header border-bottom flex justify-content-between">
                    <div class="card-title">
                        Main Category
                    </div>
                    <div class="text-center py-4">
                        <a class="btn btn-primary" data-bs-target="#modalInput" data-bs-toggle="modal" href="javascript:void(0)">Add Main Category </a>
                    </div>
                </div>
                <div class="mx-5">
                    @include('errors.message')
                </div>
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body tasks-table-container">
                            <div class="table-responsive">
                                <table id="tasks-table" class="table text-nowrap mb-0 table-bordered border-top border-bottom">
                                    <thead class="table-head">
                                    <tr>
                                        <th class="bg-transparent border-bottom-0 w-5">S.no</th>
                                        <th class="bg-transparent border-bottom-0">Category</th>
                                        <th class="bg-transparent border-bottom-0">Icon</th>
                                        <th class="bg-transparent border-bottom-0">Image</th>
                                        <th class="bg-transparent border-bottom-0">Status</th>
                                        <th class="bg-transparent border-bottom-0 no-btn">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-body">
                                    @foreach ($mainCategroes as $mainCategroy)
                                        <tr>
                                            <td class="text-muted fs-15 fw-semibold text-center">{{ $loop->iteration }}</td>
                                            <td class="text-muted fs-15 fw-semibold">{{ $mainCategroy->main_category_name }}</td>
                                            <td class="text-muted fs-15 fw-semibold">
                                                <img src="{{ asset('storage/' . $mainCategroy->icon) }}" alt="" srcset="" style="max-width: 50px; height: auto;">
                                            </td>
                                            <td class="text-muted fs-15 fw-semibold">
                                                <img src="{{ asset('storage/' . $mainCategroy->image) }}" alt=""
                                                     srcset="" style="max-width: 50px; height: auto;">
                                            </td>
                                            <td class="{{ $mainCategroy->status === 'inactive' ? 'text-danger' : 'text-primary' }} fs-15 fw-semibold">{{ $mainCategroy->status }}</td>
                                            <td>
                                                <div class="d-flex align-items-stretch justify-content-center">
                                                    <a href="{{ route('admin.EditMaincategory', $mainCategroy->id) }}" class="btn btn-sm btn-outline-primary border me-2"  data-bs-original-title="Edit">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>
                                                    <button id="deleteButton" data-id="{{ $mainCategroy->id }}" data-toggle="modal" data-target="#deleteModal" class="btn btn-sm btn-outline-secondary border "  data-bs-original-title="Delete">
                                                        <svg xmlns="http://www.w3.org/2000/svg" height="20" viewBox="0 0 24 24" width="16"><path d="M0 0h24v24H0V0z" fill="none" /><path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zM8 9h8v10H8V9zm7.5-5l-1-1h-5l-1 1H5v2h14V4h-3.5z" /></svg>
                                                    </button>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--/div-->
        </div>
    </div>
    <!-- End Row -->

    <!-- Add Main Category Modal -->
    <div class="modal fade" id="modalInput">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{ route('maincategory.store') }}" method="POST" enctype="multipart/form-data"
                      id="addCategoryForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label text-muted">Main Category Name:</label>
                            <div class="input-group">
                                <input type="text" name="main_category_name" class="form-control" placeholder="Enter Main Category Name" required>
                            </div>
                        </div>
                        <div class="form-group mt-2 " style="margin-bottom: 50px">
                            <label for="categoryIcon">Icon:</label>
                            <div class="flex justify-start" style=" max-width: 100px; height: 50px;">
                                    <span id="uploadIcon" class="cursor-pointer font-mono text-xl" role="button"
                                          aria-label="Upload Icon">
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
                                <img id="iconPreview" src="" alt="Icon Preview"
                                     style="display: none; margin-top: 10px; max-width: 100px; height: 50px;" />
                            </div>
                            <input hidden type="file" name="icon" class="form-control inputbgtextcolor"
                                   id="categoryIcon" accept="image/png, image/jpeg, image/jpg, image/gif" required
                                   onchange="onFileChangeIcon(event)">

                        </div>

                        <div class="form-group mt-2" style="margin-bottom: 50px">
                            <label for="categoryImageInput">Image:</label>
                            <div class="flex justify-start" style="margin-top: 10px; max-width: 100px; height: 50px;">
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
                                <img id="imagePreview" src="" alt="Image Preview"
                                     style="display: none; margin-top: 10px; max-width: 100px; height: 50px;" />
                            </div>
                            <input hidden type="file" name="image" class="form-control inputbgtextcolor"
                                   id="categoryImageInput" accept="image/png, image/jpeg, image/jpg, image/gif" required
                                   onchange="onFileChange(event)">

                        </div>

                        <div class="form-group mt-2">
                            <label for="categoryStatus">Status</label>
                            <select class="form-control" name="status" id="categoryStatus" required>
                                <option value="active">Active</option>
                                <option value="inactive">Inactive</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" form="addCategoryForm" class="btn btn-primary">Send</button>
                    </div>
                </form>
            </div>
        </div>
    </div>


{{--    <!-- Delete Confirmation Modal -->--}}
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this item? This action cannot be undone.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Cancel</button>
                    <form id="deleteForm" action="" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"></script>

    // This is for Image
    <script>
        // Open file dialog when the SVG is clicked
        document.getElementById('uploadImage').addEventListener('click', function() {
            const fileInput = document.getElementById('categoryImageInput').click();
            fileInput.click();
            fileInput.focus();
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
    // This is for Icon
    <script>
        // Open file dialog when the SVG is clicked
        document.getElementById('uploadIcon').addEventListener('click', function() {
            const iconInput = document.getElementById('categoryIcon').click();
            iconInput.click();
            iconInput.focus();
        });

        // Open file dialog when the image preview is clicked
        document.getElementById('iconPreview').addEventListener('click', function() {
            document.getElementById('categoryIcon').click();
        });

        function onFileChangeIcon(event) {
            const input = event.target;
            const file = input.files[0];
            const preview = document.getElementById('iconPreview');
            const uploadButton = document.getElementById('uploadIcon');

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
    <!-- Delete Confirmation Modal -->
    <script>
        // Pass the item ID to the delete form
        $(document).on('click', '#deleteButton', function() {
            const categoryId = $(this).data('id');
            const formAction = `{{ route('mainCategory.delete', '') }}/${categoryId}`;
            $('#deleteForm').attr('action', formAction);
            console.log('Form action set to:', formAction); // Debugging line
        });
    </script>
@endsection


