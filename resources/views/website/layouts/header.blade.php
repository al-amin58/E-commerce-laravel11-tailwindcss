<header class="header navbar-area">

    <div class="topbar" style="height: 50px !important;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="top-left">
                        <ul class="menu-top-link">
                            <li>৳ BDT</li>
                            <li>English</li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="top-middle">
                        <ul class="useful-links">
                            <li><a href="{{ url('/') }}">Home</a></li>
                            <li><a href="{{ route('about') }}">About Us</a></li>
                            <li><a href="{{ route('contact') }}">Contact Us</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4 col-md-4 col-12">
                    <div class="top-end">
                        @if (Auth::check() )
                            <div class="user">
                                <a href="{{ url('/dashboard') }}" class="text-decoration-none text-white">
                                    <i class="lni lni-user"></i>
                                 {{ Auth::check() ? (Auth::user()->currentTeam->name ?? Auth::user()->name ?? 'User') : 'Guest' }}
                                </a>
                            </div>
                        @else
                            <ul class="user-login">
                                <li>
                                    <a href="{{ route('login') }}">Sign In</a>
                                </li>
                                <li>
                                    <a href="{{ route('register') }}">Register</a>
                                </li>
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="header-middle">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-3 col-md-3 col-7">

                    <a class="navbar-brand" href="{{ url('/') }}">
                        <img src="{{ asset('website-assets') }}/assets/images/logo/logo.svg" alt="Logo">
                    </a>

                </div>
                <div class="col-lg-5 col-md-7 d-xs-none">
                    <form method="GET" action="{{ route('shop') }}">
                    <div class="main-menu-search">

                        <div class="navbar-search search-style-5">

                            <div class="search-select">
                                <div class="select-position">
                                    <select id="select1">
                                        <option selected>All</option>
                                    </select>
                                </div>
                            </div>
                            <div class="search-input">
                                <input type="text" id="search-input" name="search" placeholder="Search Here..." value="{{ request('search') }}">
                            </div>
                            <div class="search-btn">
                                <button type="submit"><i class="lni lni-search-alt"></i></button>
                            </div>

                        </div>
                    </div>
                    </form>
                </div>
                <div class="col-lg-4 col-md-2 col-5">
                    <div class="middle-right-area">
                        <div class="nav-hotline">
                            <i class="lni lni-phone"></i>
                            <h3>Hotline:
                                <span>(+100) 123 456 7890</span>
                            </h3>
                        </div>
                        <div class="navbar-cart">
                            <div class="wishlist">
                                <a href="javascript:void(0)">
                                    <i class="lni lni-heart"></i>
                                    <span class="total-items">0</span>
                                </a>
                            </div>
                            <div class="cart-items">
                                <a href="javascript:void(0)" class="main-btn">
                                    <i class="lni lni-cart"></i>
                                    <span class="total-items">2</span>
                                </a>

                                <div class="shopping-item">
                                    <div class="dropdown-cart-header">
                                        <span>2 Items</span>
                                        <a href="{{ url('/cart') }}">View Cart</a>
                                    </div>
                                    <ul class="shopping-list">
                                        @if (empty($cart))
                                            <li>Your cart is empty.</li>
                                        @else
                                            @foreach ($cart as $item)
                                                <li>
                                                    <a href="javascript:void(0)" class="remove" title="Remove this item" data-product-id="{{ $item['product_id'] }}">
                                                        <i class="lni lni-close"></i>
                                                    </a>
                                                    <div class="cart-img-head">
                                                        <a class="cart-img" href="product-details.html">
                                                            <img src="{{ $item['thumbnail_image'] }}" alt="{{ $item['name'] }}" style="width: 50px; height: auto;">
                                                        </a>
                                                    </div>
                                                    <div class="content">
                                                        <h4><a href="product-details.html">{{ $item['name'] }}</a></h4>
                                                        <p class="quantity">{{ $item['quantity'] }}x - <span class="amount">${{ number_format($item['price'], 2) }}</span></p>
                                                    </div>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                    <div class="bottom">
                                        <div class="total">
                                            <span>Total</span>
                                            <span class="total-amount">$134.00</span>
                                        </div>
                                        <div class="button">
                                            <a href="{{ url('/checkout') }}" class="btn animate">Checkout</a>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="suggestions" style="display:none; width: 900px;  top: 135px; margin-left: 200px; padding: 5px 5px 5px 5px; border: 1px solid #ccc; background: #fff; position: absolute; z-index: 1000;"></div>

    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 col-md-6 col-12">
                <div class="nav-inner">

                    <div class="mega-category-menu">
                        <span class="cat-button"><i class="lni lni-menu"></i>All Categories</span>
                        <ul class="sub-category">
                            @foreach($mainCategories as $mainCategory)
                                <li>
                                    <a href="{{ route('shop', ['catId' => $mainCategory->id, 'page' => request('page')]) }}">
                                        <img src="{{ asset('storage/' . $mainCategory->icon) }}" class="me-2" alt="icon" style="max-width: 20px; height: 20px;">
                                        {{ $mainCategory->main_category_name }}
                                        @if ($mainCategory->subCategories->isNotEmpty())
                                            <i class="lni lni-chevron-right"></i>
                                        @endif
                                    </a>
                                    @if ($mainCategory->subCategories->isNotEmpty())
                                        <ul class="inner-sub-category">
                                            @foreach($mainCategory->subCategories as $subCategory)
                                                <li>
                                                    <a href="{{ route('shop', ['catSubId' => $subCategory->id, 'page' => request('page')]) }}">
                                                        {{ $subCategory->Sub_category_name }}
                                                    </a>
                                                </li>
                                            @endforeach
                                        </ul>
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                    </div>


                    <nav class="navbar navbar-expand-lg">
                        <button class="navbar-toggler mobile-menu-btn" type="button" data-bs-toggle="collapse"
                            data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                            aria-expanded="false" aria-label="Toggle navigation">
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                            <span class="toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse sub-menu-bar" id="navbarSupportedContent">
                            <ul id="nav" class="navbar-nav ms-auto">
                                <li class="nav-item">
                                    <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}" aria-label="Toggle navigation">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/about') }}" class="{{ request()->is('about') ? 'active' : '' }}" aria-label="Toggle navigation">About Us</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/shop') }}" class="{{ request()->is('shop') ? 'active' : '' }}" aria-label="Toggle navigation">Shop</a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ url('/contact') }}" class="{{ request()->is('contact') ? 'active' : '' }}" aria-label="Toggle navigation">Contact Us</a>
                                </li>
                            </ul>
                        </div>
                    </nav>

                </div>
            </div>
            <div class="col-lg-4 col-md-6 col-12">

                <div class="nav-social">
                    <h5 class="title">Follow Us:</h5>
                    <ul>
                        <li>
                            <a href="javascript:void(0)"><i class="lni lni-facebook-filled"></i></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><i class="lni lni-twitter-original"></i></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><i class="lni lni-instagram"></i></a>
                        </li>
                        <li>
                            <a href="javascript:void(0)"><i class="lni lni-skype"></i></a>
                        </li>
                    </ul>
                </div>

            </div>
        </div>
    </div>

</header>
@section('script')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const navLinks = document.querySelectorAll('.nav-item a');

        navLinks.forEach(link => {
            link.addEventListener('click', function() {
                // Remove 'active' class from all links
                navLinks.forEach(navLink => navLink.classList.remove('active'));
                // Add 'active' class to the clicked link
                this.classList.add('active');
            });
        });
    });
</script>

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
                                    $('#suggestions').append('<div class="suggestion-item" style="cursor: pointer; margin-bottom: 5px; color: #0a080e; font-size: medium; font-weight: normal; " data-id="'+ product.id +'">' + product.product_title + '</div>'); // Ensure you are using product_title here
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


