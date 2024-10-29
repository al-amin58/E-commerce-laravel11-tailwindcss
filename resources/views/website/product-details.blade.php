@extends('website.layouts.app')
@section('title')
    Product Details
@endsection
@section('body')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">{{ \Illuminate\Support\Str::words($product->product_title, 5,  '...') }}</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ url('/') }}"><i class="lni lni-home"></i> Home</a></li>
                        <li><a href="{{ url('/shop') }}">Shop</a></li>
                        <li>{{ \Illuminate\Support\Str::words($product->product_title, 3,  '...') }}</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <section class="item-details section">
        <div class="container">
            <div class="top-area">
                <div class="row align-items-center">
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-images">
                            <main id="gallery">
                                <div class="main-img">
                                    <img src="{{ asset('images/products/' . $product->thumbnail_image) }}" id="current" alt="#" style=" height: 300px;">
                                </div>
                                <div class="images">
                                        @if ($product->images->isEmpty())
                                            <p>No images available for this product.</p>
                                            <img src="path/to/default/image.jpg" alt="Default Image">
                                        @else
                                            @foreach ($product->images as $image)
                                            <img src="{{ asset( $image->image_id) }}" class="img" alt="image" style="width: 300px; height: 65px" >
                                            @endforeach
                                        @endif
                                </div>
                            </main>
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-12 col-12">
                        <div class="product-info">
                            <h2 class="title">{{$product->product_title}}</h2>
                            <p class="category"><i class="lni lni-tag"></i> Brand:<a href="javascript:void(0)">{{ $product->brand?->brand_name ?? 'N/A' }}</a></p>
                            <p class="category"><i class="lni lni-tag"></i> Category:<a href="javascript:void(0)">{{ $product->subcategory->Sub_category_name ?? $product->mainCategory->main_category_name ?? 'N/A' }}</a></p>
                            <h3 class="price" id="price-display">
                                ${{ $product->discount_price ?? $product->price }}
                                @if($product->price !== $product->discount_price)
                                    <span class="original-price" name="price">${{ $product->price }}</span>
                                @endif
                            </h3>
                            <p class="info-text">{{$product->short_description}}</p>

                            <div class="row">
                                @if(!$product->sizes->isEmpty())
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="form-group color-option">
                                            <label class="title-label">Choose Size</label>
                                            @foreach ($product->sizes as $size)
                                                <div class="single-checkbox">
                                                    <input type="radio" name="size" id="checkbo-{{ $loop->index + 1 }}" value="{{ $size->id }}" {{ $size->pivot->product_id === $product->id ? '' : 'checked' }} style="display: none">
                                                    <label for="checkbo-{{ $loop->index + 1 }}" class="size-label" data-default="{{ $size->size }}" style="color: black !important;  background-color: {{ $size->pivot->product_id === $product->id ? 'transparent' : '#0c4128' }};">
                                                        {{ $size->size }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif

                                @if(!$product->colors->isEmpty())
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="form-group color-option">
                                            <label class="title-label">Choose color</label>
                                            @foreach ($product->colors as $color)
                                                <div class="single-checkbox checkbox-style">
                                                    <input type="checkbox" name="color" id="checkbox-{{ $loop->index + 1 }}" value="{{ $color->id }}" {{ $color->pivot->product_id === $product->id ? '' : 'checked' }}>
                                                    <label for="checkbox-{{ $loop->index + 1 }}"><span style="background-color: {{ $color->color_code }};"></span></label> <!-- Assuming `hex_code` is a property that holds the color value -->
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                @if($product->product_attributes && $product->product_attributes->isNotEmpty())
                                    <div class="col-lg-5 col-md-5 col-12">
                                        <div class="form-group">
                                            <label>Attribute</label>
                                            <select name="attribute" class="form-control" id="attribute">
                                                <option value="">Select Attribute</option>
                                                @foreach ($product->product_attributes as $attribute)
                                                    <option value="{{ $attribute->id }}" data-price="{{ $attribute->value }}">
                                                        {{ $attribute->key }} - {{ $attribute->value }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-lg-3 col-md-3 col-12">
                                    <div class="form-group quantity">
                                        <label>Quantity</label>
                                        <select name="quantity" class="form-control">
                                            <option value="1">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="5">5</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="bottom-content">
                                <div class="row align-items-end">
                                    <div class="col-lg-4 col-md-4 col-12">
                                        <div class="button cart-button">
                                            <button class="btn" style="width: 100%;" id="add-to-cart" data-product-id="{{ $product->id }}" onclick="addToCart(this)">Add to Cart</button>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="product-details-info">
                <div class="single-block">
                    <div class="row">
                        <div class="col-lg-6 col-12">
                            <div class="info-body custom-responsive-margin">
                                {{$product->full_description}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-12">
                        <div class="single-block give-review">
                            <h4>4.5 (Overall)</h4>
                            <ul>
                                <li>
                                    <span>5 stars - 38</span>
                                    <i class="lni lni-star-filled"></i>
                                    <i class="lni lni-star-filled"></i>
                                    <i class="lni lni-star-filled"></i>
                                    <i class="lni lni-star-filled"></i>
                                    <i class="lni lni-star-filled"></i>
                                </li>
                                <li>
                                    <span>4 stars - 10</span>
                                    <i class="lni lni-star-filled"></i>
                                    <i class="lni lni-star-filled"></i>
                                    <i class="lni lni-star-filled"></i>
                                    <i class="lni lni-star-filled"></i>
                                    <i class="lni lni-star"></i>
                                </li>
                                <li>
                                    <span>3 stars - 3</span>
                                    <i class="lni lni-star-filled"></i>
                                    <i class="lni lni-star-filled"></i>
                                    <i class="lni lni-star-filled"></i>
                                    <i class="lni lni-star"></i>
                                    <i class="lni lni-star"></i>
                                </li>
                                <li>
                                    <span>2 stars - 1</span>
                                    <i class="lni lni-star-filled"></i>
                                    <i class="lni lni-star-filled"></i>
                                    <i class="lni lni-star"></i>
                                    <i class="lni lni-star"></i>
                                    <i class="lni lni-star"></i>
                                </li>
                                <li>
                                    <span>1 star - 0</span>
                                    <i class="lni lni-star-filled"></i>
                                    <i class="lni lni-star"></i>
                                    <i class="lni lni-star"></i>
                                    <i class="lni lni-star"></i>
                                    <i class="lni lni-star"></i>
                                </li>
                            </ul>

                            <button type="button" class="btn review-btn" data-bs-toggle="modal"
                                data-bs-target="#exampleModal">
                                Leave a Review
                            </button>
                        </div>
                    </div>
                    <div class="col-lg-8 col-12">
                        <div class="single-block">
                            <div class="reviews">
                                <h4 class="title">Latest Reviews</h4>

                                <div class="single-review">
                                    <img src="{{ asset('website-assets') }}/assets/images/blog/comment1.jpg" alt="#">
                                    <div class="review-info">
                                        <h4>Awesome quality for the price
                                            <span>Jacob Hammond
                                            </span>
                                        </h4>
                                        <ul class="stars">
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                        </ul>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                            tempor...</p>
                                    </div>
                                </div>


                                <div class="single-review">
                                    <img src="{{ asset('website-assets') }}/assets/images/blog/comment2.jpg" alt="#">
                                    <div class="review-info">
                                        <h4>My husband love his new...
                                            <span>Alex Jaza
                                            </span>
                                        </h4>
                                        <ul class="stars">
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star"></i></li>
                                        </ul>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                            tempor...</p>
                                    </div>
                                </div>


                                <div class="single-review">
                                    <img src="{{ asset('website-assets') }}/assets/images/blog/comment3.jpg" alt="#">
                                    <div class="review-info">
                                        <h4>I love the built quality...
                                            <span>Jacob Hammond
                                            </span>
                                        </h4>
                                        <ul class="stars">
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                            <li><i class="lni lni-star-filled"></i></li>
                                        </ul>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod
                                            tempor...</p>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>


    <div class="modal fade review-modal" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Leave a Review</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="review-name">Your Name</label>
                                <input class="form-control" type="text" id="review-name" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="review-email">Your Email</label>
                                <input class="form-control" type="email" id="review-email" required>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="review-subject">Subject</label>
                                <input class="form-control" type="text" id="review-subject" required>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label for="review-rating">Rating</label>
                                <select class="form-control" id="review-rating">
                                    <option>5 Stars</option>
                                    <option>4 Stars</option>
                                    <option>3 Stars</option>
                                    <option>2 Stars</option>
                                    <option>1 Star</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="review-message">Review</label>
                        <textarea class="form-control" id="review-message" rows="8" required></textarea>
                    </div>
                </div>
                <div class="modal-footer button">
                    <button type="button" class="btn">Submit Review</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        document.getElementById('attribute').addEventListener('change', function() {
            var selectedOption = this.options[this.selectedIndex];
            var attributePrice = selectedOption.getAttribute('data-price');

            if (attributePrice) {
                document.getElementById('price-display').innerHTML = `${attributePrice}`;
            } else {
                // Reset to the default price if no attribute is selected
                document.getElementById('price-display').innerHTML = `\
                ${{ $product->discount_price ?? $product->price }} \
                @if($product->price !== $product->discount_price) \
                    <span class="original-price">${{ $product->price }}</span> \
                @endif`;
            }
        });
    </script>
    <script>
        // Wait for the DOM to fully load
        document.addEventListener("DOMContentLoaded", function() {
            // Select all thumbnail images
            const thumbnails = document.querySelectorAll('.images .img');
            // Select the main image element
            const mainImage = document.getElementById('current');

            // Add click event listener to each thumbnail
            thumbnails.forEach(thumbnail => {
                thumbnail.addEventListener('click', function() {
                    // Get the source of the clicked thumbnail
                    const newSrc = this.src;

                    // Update the main image source to the clicked thumbnail's source
                    mainImage.src = newSrc;
                });
            });
        });
    </script>

{{--    Add to cart--}}
    <script>
        $(document).ready(function() {
            $('#add-to-cart').click(function() {
                var productId = $(this).data('product-id');
                var quantity = $('select[name="quantity"]').val(); // Get the selected quantity
                var price = parseFloat('{{$product->discount_price ?? $product->price}}'); // Get the product price
                var totalPrice = price * quantity; // Calculate total price
                var selectedSize = $('input[name="size"]:checked').val(); // Get the selected size
                var selectedColors = $('input[name="color"]:checked').map(function () {
                    return $(this).val();
                }).get(); // Get the selected colors as an array
                var selectedAttribute = $('#attribute').val(); // Get the selected attribute

                $.ajax({
                    url: 'http://localhost/E-commerce-laravel11-tailwindcss/cart/add',
                    method: 'POST',
                    data: {
                        product_id: productId,
                        quantity: quantity,
                        total_price: totalPrice,
                        size: selectedSize,
                        colors: selectedColors,
                        attribute: selectedAttribute,
                        thumbnail_image: $('#current').attr('src'),
                        product_title: '{{$product->product_title}}',
                        price: price,
                        _token: '{{ csrf_token() }}'
                    },
                });
            });
        });


    </script>
{{--    after add to cart button is desable--}}
    <script>
        function addToCart(button) {
            // Logic to add the product to the cart
            const productId = button.getAttribute('data-product-id');

            // Simulate adding to cart (you can replace this with actual logic)
            console.log('Product added to cart:', productId);

            // Disable the button after adding the product
            button.innerText = 'Added to Cart';
            button.disabled = true;
            button.style.cursor = 'not-allowed'; // Optional: Change cursor style
        }
    </script>
{{--    size selectd and background color is change--}}
    <script>
        $(document).ready(function() {
            $('input[name="size"]').change(function() {
                // Reset all labels to default background
                $('.size-label').css({
                    'background-color': 'transparent',
                    'color': '#000000'
                });

                // Change the background color of the selected label
                const label = $(`label[for="${this.id}"]`);
                label.css({
                    'background-color': '#0c4128',
                    'color': '#FFFFFF',
                    'border-radius': '50%',
                    'width': '25px',
                    'height': '25px',
                    'padding': '0px 3px 0px 6px'
                });
            });
        });

    </script>
@endsection

