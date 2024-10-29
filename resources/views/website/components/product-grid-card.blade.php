@foreach($products as $product)

<div class="col-lg-4 col-md-6 col-12">
    <form action="{{ route('cart.add') }}" method="POST">
        @csrf
    <div class="single-product">
        <div class="product-image">
            <img src="{{ asset('images/products/' . $product->thumbnail_image) }}" alt="Image" style="max-width: 300px; height: 250px;">

                <div class="button">
                    <button class="btn"><i class="lni lni-cart"></i> Add to Cart</button>
                </div>

        </div>
        <div class="product-info">
            <span class="category">{{ $product->subcategory->Sub_category_name ?? $product->mainCategory->main_category_name ?? 'N/A' }}</span>
            <h4 class="title">
                <a href="{{ route('product.details', ['id' => $product->id]) }}">{{ \Illuminate\Support\Str::words($product->product_title, 5,  '...') }}</a>
            </h4>
            <ul class="review">
                <li><i class="lni lni-star-filled"></i></li>
                <li><i class="lni lni-star-filled"></i></li>
                <li><i class="lni lni-star-filled"></i></li>
                <li><i class="lni lni-star-filled"></i></li>
                <li><i class="lni lni-star"></i></li>
                <li><span>4.0 Review(s)</span></li>
            </ul>
            <!-- Hidden inputs for required fields -->
            <input type="hidden" name="product_id" value="{{ $product->id }}">
            <input type="hidden" name="thumbnail_image" value="{{ $product->thumbnail_image }}">
            <input type="hidden" name="product_title" value="{{ $product->product_title }}">
            <input type="hidden" name="price" value="{{ $product->discount_price ?? $product->price }}">
            <input type="hidden" name="quantity" value="1"> <!-- Default quantity -->
            <input type="hidden" name="size" value="{{ $product->size ?? '' }}"> <!-- Optional size -->
            <input type="hidden" name="attribute" value="{{ $product->attribute ?? '' }}"> <!-- Optional attributes -->

            <div class="price">
                <span>${{ $product->discount_price ?? $product->price}}</span>
            </div>
        </div>
    </div>
    </form>
</div>

@endforeach
