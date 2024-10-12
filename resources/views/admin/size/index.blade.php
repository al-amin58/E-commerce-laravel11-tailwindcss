@extends('admin.layouts.app')
@section('title')
    Size
@endsection
@section('content')

    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Size List</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Size</a></li>
                <li class="breadcrumb-item active" aria-current="page">Size list</li>
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
                        Sizes
                    </div>
                    <div class="text-center py-4">
                        <a class="btn btn-primary" data-bs-target="#modalInput" data-bs-toggle="modal" href="javascript:void(0)">Add New Color </a>
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
                                        <th class="bg-transparent border-bottom-0">Size</th>
                                        <th class="bg-transparent border-bottom-0">Status</th>
                                        <th class="bg-transparent border-bottom-0 no-btn">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-body">
                                    @foreach ($sizes as $size)
                                        <tr>
                                            <td class="text-muted fs-15 fw-semibold text-center">{{ $loop->iteration }}</td>
                                            <td class="text-muted fs-15 fw-semibold">{{ $size->size }}</td>
                                            <td class="{{ $size->status === 'inactive' ? 'text-danger' : 'text-primary' }} fs-15 fw-semibold">{{ $size->status }}</td>
                                            <td>
                                                <div class="d-flex align-items-stretch justify-content-center">
                                                    <a href="{{ route('size.Edit', $size->id) }}" class="btn btn-sm btn-outline-primary border me-2"  data-bs-original-title="Edit">
                                                        <i class="fe fe-edit-2"></i>
                                                    </a>
                                                    <button id="deleteButton" data-id="{{ $size->id }}" data-toggle="modal" data-target="#deleteModal" class="btn btn-sm btn-outline-secondary border "  data-bs-original-title="Delete">
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
                <form action="{{ route('size.store') }}" method="POST" enctype="multipart/form-data"
                      id="addBrandForm">
                    @csrf
                    <div class="modal-body">
                        <div class="form-group">
                            <label class="form-label text-muted">Size:</label>
                            <div class="input-group">
                                <input type="text" name="size" class="form-control" placeholder="Enter Size " required>
                            </div>
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
                        <button type="submit" form="addBrandForm" class="btn btn-primary">Save Color</button>
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


    <!-- Delete Confirmation Modal -->
    <script>
        // Pass the item ID to the delete form
        $(document).on('click', '#deleteButton', function() {
            const categoryId = $(this).data('id');
            const formAction = `{{ route('size.delete', '') }}/${categoryId}`;
            $('#deleteForm').attr('action', formAction);
            console.log('Form action set to:', formAction); // Debugging line
        });
    </script>
@endsection


