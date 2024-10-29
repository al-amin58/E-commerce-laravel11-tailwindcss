@extends('website.layouts.app')
@section('title')
    Cart
@endsection
@section('body')
    <div class="breadcrumbs">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 col-md-6 col-12">
                    <div class="breadcrumbs-content">
                        <h1 class="page-title">Cart</h1>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-12">
                    <ul class="breadcrumb-nav">
                        <li><a href="{{ url('/') }}"><i class="lni lni-home"></i> Home</a></li>
                        <li><a href="{{ url('/shop') }}">Shop</a></li>
                        <li>Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    @include('errors.message')

    <div class="shopping-cart section">
        <div class="container">
            <div class="cart-list-head">

                <div class="cart-list-title">
                    <div class="row">
                        <div class="col-lg-1 col-md-1 col-12">
                        </div>
                        <div class="col-lg-4 col-md-3 col-12">
                            <p>Product Name</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Quantity</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Price</p>
                        </div>
                        <div class="col-lg-2 col-md-2 col-12">
                            <p>Total Price</p>
                        </div>
                        <div class="col-lg-1 col-md-2 col-12">
                            <p>Remove</p>
                        </div>
                    </div>
                </div>

                @if(session('success'))
                    <div>{{ session('success') }}</div>
                @endif

                @if($items->isNotEmpty())

                        @foreach($items as $item)

                        <div class="cart-single-list">
                            <div class="row align-items-center">
                                <div class="col-lg-1 col-md-1 col-12">
                                    <img src="{{ asset('images/products/'. $item->product->thumbnail_image)  }}" alt="{{ $item->product->product_title }}" style="width: 50px;">
                                </div>
                                <div class="col-lg-4 col-md-3 col-12">
                                    <h5 class="product-name"><strong>{{ $item->product->product_title}}</strong></h5>
                                    <p class="product-des">
                                        <span><em></em> {{$item->prodcut->size ?? ''}}</span>
                                        <span><em></em> {{$item->prodcut->colors ?? ''}}</span>
                                    </p>
                                </div>
                                <div class="col-lg-2 col-md-2 col-12">
                                    <div class="count-input">
                                        <select class="form-control" id="quantity-select-{{ $item->id }}" onchange="updatePrice({{ $item->id }}, {{ $item->product->discount_price ?? $item->product->price }})">
                                            @for($i = 1; $i <= 5; $i++)
                                            <option value="{{$i}}" {{ $item->quantity == $i ? 'selected' : '' }}>{{$i}}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-2 col-md-2 col-12">
                                    <p>$ {{ number_format( $item->product->discount_price ?? $item->product->price, 2)}}</p>
                                </div>
                                <div class="col-lg-2 col-md-2 col-12" id="price-{{ $item->id }}">
                                    <p>{{ number_format($item->total_price, 2) }}</p>
                                </div>
                                <div class="col-lg-1 col-md-2 col-12">
                                    <form action="{{ route('cart.remove', $item->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" style="border-radius: 50%; height: 25px; width: 25px; border: none;" ><i class="lni lni-close" style="color:red; font-weight: bolder"></i></button>
                                    </form>
                                </div>
                            </div>
                        </div>

                        @endforeach
                @else
                    <p>Your cart is empty.</p>
                @endif

            </div>
            <div class="row">
                <div class="col-12">

                    <div class="total-amount">
                        <div class="row">
                            <div class="col-lg-8 col-md-6 col-12">
                                <div class="left">
{{--                                    for add or other if show--}}
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6 col-12">
                                <div class="right">
                                    <ul>
                                        <li>Cart Total Price<span id="cart-total-price">$ {{ number_format($totalPrice, 2) }}</span></li>
                                        <li class="last">Cart Item<span>{{ $totalItems }}</span></li>
                                    </ul>
                                    <div class="button">
                                        <a href="{{ url('/checkout') }}" class="btn">Checkout</a>
                                        <a href="{{ url('/shop') }}" class="btn btn-alt">Continue shopping</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
@endsection
<script>
    function updatePrice(itemId, unitPrice) {
        const quantity = document.getElementById(`quantity-select-${itemId}`).value;
        const totalPrice = (quantity * unitPrice).toFixed(2);
        document.getElementById(`price-${itemId}`).innerHTML = `<p>${totalPrice}</p>`;
    }
</script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function updatePrice(itemId, unitPrice) {
        const quantity = document.getElementById(`quantity-select-${itemId}`).value;
        const itemTotalPrice = (quantity * unitPrice).toFixed(2);
        document.getElementById(`price-${itemId}`).innerHTML = `<p>$ ${itemTotalPrice}</p>`;

        // Send AJAX request to update the quantity in the database
        $.ajax({
            url: `http://localhost/E-commerce-laravel11-tailwindcss/cart/items/${itemId}/update`,
            type: 'POST',
            data: {
                quantity: quantity,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log('Quantity updated successfully', response);
                updateCartTotal(); // Call to update the cart total
            },
            error: function(xhr) {
                console.error('Error updating quantity', xhr);
            }
        });
    }

    function updateCartTotal() {
        let total = 0;
        $('div[id^="price-"]').each(function() {
            const priceText = $(this).text().replace('$ ', '');
            total += parseFloat(priceText);
        });
        $('#cart-total-price').text('$ ' + total.toFixed(2));
    }
</script>



