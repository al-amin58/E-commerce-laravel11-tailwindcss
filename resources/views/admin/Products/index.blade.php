@extends('admin.layouts.app')
@section('title')
    Products
@endsection
@section('content')

    <!-- PAGE-HEADER -->
    <div class="page-header">
        <div>
            <h1 class="page-title">Products List</h1>
        </div>
        <div class="ms-auto pageheader-btn">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="javascript:void(0);">Products</a></li>
                <li class="breadcrumb-item active" aria-current="page">Products list</li>
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
                        Products
                    </div>
                    <a href="{{ route('product.add') }}" class="text-center py-4">
                        <p class="btn btn-primary"  >Add New Product </p>
                    </a>
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
                                        <th class="bg-transparent border-bottom-0">Product Title</th>
                                        <th class="bg-transparent border-bottom-0">Image</th>
                                        <th class="bg-transparent border-bottom-0">Price</th>
                                        <th class="bg-transparent border-bottom-0">Category</th>
                                        <th class="bg-transparent border-bottom-0">Brand</th>
                                        <th class="bg-transparent border-bottom-0">Status</th>
                                        <th class="bg-transparent border-bottom-0 no-btn">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody class="table-body">
                                        @foreach($products as $product)
                                            <tr>
                                                <td class="text-muted fs-15 fw-semibold text-center">{{ $loop->iteration }}</td>
                                                <td class="text-muted fs-15 fw-semibold text-truncate" style="max-width: 200px;">
                                                    {{ \Illuminate\Support\Str::words($product->product_title, 5, '...') }}
                                                </td>
                                                <td class="text-muted fs-15 fw-semibold">

                                                        <img src="{{ asset('images/products/' . $product->thumbnail_image) }}" alt="Image" style="max-width: 50px; height: auto;">

                                                </td>
                                                <td class="text-muted fs-15 fw-semibold">{{  $product->discount_price ?? $product->price}}</td>
                                                <td class="text-muted fs-15 fw-semibold">
                                                    {{ $product->subcategory->Sub_category_name ?? $product->mainCategory->main_category_name ?? 'N/A' }}
                                                </td>
                                                <td class="text-muted fs-15 fw-semibold"> {{ $product->brand?->brand_name ?? 'N/A' }}</td>
                                                <td class="{{ $product->status === 'inactive' ? 'text-danger' : 'text-primary' }} fs-15 fw-semibold">
                                                    {{ $product->status }}
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-stretch justify-content-center">
                                                        <a href="{{ route('product.Edit', $product->id) }}" class="btn btn-sm btn-outline-primary border me-2"  data-bs-original-title="Edit">
                                                            <i class="fe fe-edit-2"></i>
                                                        </a>
                                                        <button id="deleteButton" data-id="{{ $product->id }}" data-toggle="modal" data-target="#deleteModal" class="btn btn-sm btn-outline-secondary border "  data-bs-original-title="Delete">
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
            const formAction = `{{ route('product.delete', '') }}/${categoryId}`;
            $('#deleteForm').attr('action', formAction);
            console.log('Form action set to:', formAction); // Debugging line
        });
    </script>
@endsection


