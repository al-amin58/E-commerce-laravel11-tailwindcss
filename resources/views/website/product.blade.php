@extends('website.layouts.app')
@section('title')
    Product List
@endsection
@section('body')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">All Products</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ url('/') }}"><i class="lni lni-home"></i> Home</a></li>
                        <li><a href="{{ url('/shop') }}">Shop</a></li>
                        <li>All Products</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    @include('errors.message')

    <section class="product-grids section">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-12">

                    <div class="product-sidebar">
                        <div class="single-widget search">
                            <h3>Search Product</h3>
                            <form method="GET" action="{{ route('shop') }}">
                                <input type="text" id="search-input" name="search" placeholder="Search Here..." value="{{ request('search') }}">
                                <button type="submit"><i class="lni lni-search-alt"></i></button>
                            </form>
                            <div id="suggestions" style="display:none; border: 1px solid #ccc; background: #fff; position: absolute; z-index: 1000;"></div>
                        </div>

                        <div class="single-widget condition">
                            <h3>Filter by Price</h3>
                            <form method="GET" action="{{ route('shop') }}">
                                <!-- Price Range Filter -->
                                <select class="form-control w-full" name="price" onchange="this.form.submit()">
                                    <option value="">Select Price Range</option>
                                    <option value="0-1000" {{ $priceRange === '0-1000' ? 'selected' : '' }}>0 - 1000 </option>
                                    <option value="1000-10000" {{ $priceRange === '1000-10000' ? 'selected' : '' }}>1000 - 10000</option>
                                    <option value="10000-100000" {{ $priceRange === '10000-100000' ? 'selected' : '' }}>10000 - 100000 </option>
                                    <option value="100000-500000" {{ $priceRange === '100000-500000' ? 'selected' : '' }}>100000 - 500000  </option>
                                    <option value="500000-1000000" {{ $priceRange === '500000-1000000' ? 'selected' : '' }}>500000 - 1000000</option>
                                </select>
                            </form>
                        </div>
                        <div class="single-widget">
                            <h3>All Categories</h3>
                            <ul class="list">
                                @foreach($mainCategories as $mainCategory)
                                <li>
                                    <a href="{{ route('shop', ['catId'=>$mainCategory->id, 'page' => request('page')]) }}">
                                        <img src="{{ asset('storage/' . $mainCategory->icon) }}" class="me-2" alt="icon" style="max-width: 20px; height: 20px;">
                                        {{ $mainCategory->main_category_name }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                        <div class="single-widget">
                            <h3>Filter by Brand</h3>
                            <ul  class="list">
                                @foreach($brands as $brand)
                                <li>
                                    <a href="{{ route('shop', ['brand' => $brand->id, 'catId' => request('catId'), 'price' => request('price')]) }}">
                                        <img src="{{ asset('storage/' . $brand->image) }}" class="me-2" alt="icon" style="max-width: 20px; height: 20px;">
                                        {{ $brand->brand_name }}
                                    </a>
                                </li>
                                @endforeach
                            </ul>
                        </div>

                    </div>

                </div>
                <div class="col-lg-9 col-12">
                    <div class="product-grids-head">
                        <div class="product-grid-topbar">
                            <div class="row align-items-center">
                                <div class="col-lg-7 col-md-8 col-12">
                                    <form method="GET" action="{{ route('shop') }}">
                                        <div class="product-sorting">
                                            <label for="sorting">Sort by:</label>
                                            <select class="form-control" id="sorting" name="sort" onchange="this.form.submit()">
                                                <option value="products" {{ $sortOrder === 'products' ? 'selected' : '' }}>Popularity</option>
                                                <option value="low-high" {{ $sortOrder === 'low-high' ? 'selected' : '' }}>Low - High Price</option>
                                                <option value="high-low" {{ $sortOrder === 'high-low' ? 'selected' : '' }}>High - Low Price</option>
                                            </select>
                                            <h3 class="total-show-product">Showing: <span>1 - {{ $products->count() }} items</span></h3>
                                        </div>
                                    </form>
                                </div>

                                <div class="col-lg-5 col-md-4 col-12">
                                    <nav>
                                        <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                            <button class="nav-link active" id="nav-grid-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-grid" type="button" role="tab"
                                                aria-controls="nav-grid" aria-selected="true"><i
                                                    class="lni lni-grid-alt"></i></button>
                                            <button class="nav-link" id="nav-list-tab" data-bs-toggle="tab"
                                                data-bs-target="#nav-list" type="button" role="tab"
                                                aria-controls="nav-list" aria-selected="false"><i
                                                    class="lni lni-list"></i></button>
                                        </div>
                                    </nav>
                                </div>
                            </div>
                        </div>
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade show active" id="nav-grid" role="tabpanel"
                                aria-labelledby="nav-grid-tab">
                                <div class="row">
                                    @include('website.components.product-grid-card')
                                </div>
                                <div class="row">
                                    <div class="col-12">

                                        <div class="pagination left">
                                            {{ $products->links('vendor.pagination.custom')}}
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="nav-list" role="tabpanel" aria-labelledby="nav-list-tab">
                                <div class="row">
                                    @include('website.components.product-list-card')
                                </div>
                                <div class="row">
                                    <div class="col-12">

                                        <div class="pagination left">
                                            {{ $products->links('vendor.pagination.custom') }}
                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#search-input').on('keyup', function() {
                const searchTerm = $(this).val();

                if (searchTerm.length > 0) {
                    $.ajax({
                        url: '{{ route("search.suggestions") }}',
                        type: 'GET',
                        data: { term: searchTerm },
                        success: function(data) {
                            console.log(data); // Log the response data
                            $('#suggestions').empty().show();
                            if (data.length > 0) {
                                $.each(data, function(index, product) {
                                    $('#suggestions').append('<div class="suggestion-item" style="cursor: pointer; margin-bottom: 2px;" data-id="'+ product.id +'">' + product.product_title + '</div>'); // Ensure you are using product_title here
                                });
                            } else {
                                $('#suggestions').append('<div class="no-suggestions">No products found</div>');
                            }
                        }

                    });
                } else {
                    $('#suggestions').hide();
                }
            });

            // Event delegation to handle clicks on suggestion items
            $(document).on('click', '.suggestion-item', function() {
                const productId = $(this).data('id');
                // Optionally, redirect to the product page or fill the input
                $('#search-input').val($(this).text());
                $('#suggestions').hide(); // Hide suggestions after selection
                // Optionally, submit the form if needed
                // $(this).closest('form').submit();
            });

            $(document).on('click', function() {
                $('#suggestions').hide(); // Hide suggestions on click outside
            });
        });
    </script>

@endsection
