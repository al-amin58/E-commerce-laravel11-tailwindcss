@extends('admin.layouts.app')
@section('title')
    Products
@endsection
@section('content')
    <nav class="page-breadcrumb flex justify-between">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page">Products List</li>
        </ol>
        <a href="{{ route('product.add') }}">  
         <button type="button" class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0" data-toggle="modal"
            data-target="#addMainCategoryModal"> Add Product </button>
         </a>

    </nav>

    @include('errors.message')

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h6 class="card-title">Brands Table</h6>

                    <div class="table-responsive">
                        <table id="dataTableExample" class="table">
                            <thead>
                                <tr>
                                    <th>id</th>
                                    <th>Name</th>
                                    <th>Thumnail Image</th>
                                    <th>Price</th>
                                    <th>Catagory</th>
                                    <th>Brand</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                    <tr>
                                        <td>Id</td>
                                        <td>Name</td>
                                        <!-- Ensure you are using the correct property -->
                                        {{-- {{ $loop->iteration }} --}}
                                        {{-- {{ asset('storage/' . $brand->image) }} --}}
                                        <td>
                                            <img src="" alt="" srcset=""
                                                style="max-width: 200px; height: auto;">
                                        </td>
                                        <td>Price</td>
                                        <td>Catagory</td>
                                        <td>Name</td>
                                        <td>Brand </td>
                                        <td>
                                            <div class="flex gap-2">
                                                <a href="" class="btn"><i class="me-1 icon-md" data-feather="edit"
                                                        style="color: green"></i></a>
                                                <button id="deleteButton" class="btn" data-toggle="modal"
                                                    data-target="#deleteModal" data-id="">
                                                    <i class="me-1 icon-md" data-feather="trash-2" style="color: red"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    

    <!-- Delete Confirmation Modal -->
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
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


    {{-- <!-- Delete Confirmation Modal -->
    <script>
        // Pass the item ID to the delete form
        $(document).on('click', '#deleteButton', function() {
            const brandId = $(this).data('id');
            const formAction = `{{ route('brand.delete', '') }}/${brandId}`;
            $('#deleteForm').attr('action', formAction);
            console.log('Form action set to:', formAction); // Debugging line
        });
    </script> --}}
@endsection
