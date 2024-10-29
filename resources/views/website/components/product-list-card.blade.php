@foreach($products as $product)
<div class="col-lg-12 col-md-12 col-12">

    <div class="single-product">
        <div class="row align-items-center">
            <div class="col-lg-4 col-md-4 col-12">
                <div class="product-image">
                    <img src="{{ asset('images/products/' . $product->thumbnail_image) }}" alt="Image" style="max-width: 250px; height: 200px;" >
                    <form action="{{ route('cart.add') }}" method="POST">
                        @csrf
                        <div class="button">
                            <button class="btn"><i class="lni lni-cart"></i> Add to Cart</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-12">
                <div class="product-info">
                    <span class="category">{{ $product->subcategory->Sub_category_name ?? $product->mainCategory->main_category_name ?? 'N/A' }}</span>
                    <h4 class="title">
                        <a href="{{ route('product.details', ['id' => $product->id]) }}"> {{ \Illuminate\Support\Str::words($product->product_title, 15, '...') }}</a>
                    </h4>
                    <ul class="review">
                        <li><i class="lni lni-star-filled"></i></li>
                        <li><i class="lni lni-star-filled"></i></li>
                        <li><i class="lni lni-star-filled"></i></li>
                        <li><i class="lni lni-star-filled"></i></li>
                        <li><i class="lni lni-star"></i></li>
                        <li><span>4.0 Review(s)</span></li>
                    </ul>
                    <div class="price">
                        <span>${{ $product->discount_price ?? $product->price}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endforeach
