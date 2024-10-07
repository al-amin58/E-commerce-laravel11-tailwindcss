<header class="header navbar-area">

    <div class="topbar">
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
                                <input type="text" placeholder="Search">
                            </div>
                            <div class="search-btn">
                                <button><i class="lni lni-search-alt"></i></button>
                            </div>
                        </div>

                    </div>

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
                                        <li>
                                            <a href="javascript:void(0)" class="remove"
                                                title="Remove this item"><i class="lni lni-close"></i></a>
                                            <div class="cart-img-head">
                                                <a class="cart-img" href="product-details.html"><img
                                                        src="{{ asset('website-assets') }}/assets/images/header/cart-items/item1.jpg"
                                                        alt="#"></a>
                                            </div>
                                            <div class="content">
                                                <h4><a href="product-details.html">
                                                        Apple Watch Series 6</a></h4>
                                                <p class="quantity">1x - <span class="amount">$99.00</span></p>
                                            </div>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)" class="remove"
                                                title="Remove this item"><i class="lni lni-close"></i></a>
                                            <div class="cart-img-head">
                                                <a class="cart-img" href="product-details.html"><img
                                                        src="{{ asset('website-assets') }}/assets/images/header/cart-items/item2.jpg"
                                                        alt="#"></a>
                                            </div>
                                            <div class="content">
                                                <h4><a href="product-details.html">Wi-Fi Smart Camera</a></h4>
                                                <p class="quantity">1x - <span class="amount">$35.00</span></p>
                                            </div>
                                        </li>
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


    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-8 col-md-6 col-12">
                <div class="nav-inner">

                    <div class="mega-category-menu">
                        <span class="cat-button"><i class="lni lni-menu"></i>All Categories</span>
                        <ul class="sub-category">
                            <li><a href="product-grids.html">Electronics <i class="lni lni-chevron-right"></i></a>
                                <ul class="inner-sub-category">
                                    <li><a href="product-grids.html">Digital Cameras</a></li>
                                    <li><a href="product-grids.html">Camcorders</a></li>
                                    <li><a href="product-grids.html">Camera Drones</a></li>
                                    <li><a href="product-grids.html">Smart Watches</a></li>
                                    <li><a href="product-grids.html">Headphones</a></li>
                                    <li><a href="product-grids.html">MP3 Players</a></li>
                                    <li><a href="product-grids.html">Microphones</a></li>
                                    <li><a href="product-grids.html">Chargers</a></li>
                                    <li><a href="product-grids.html">Batteries</a></li>
                                    <li><a href="product-grids.html">Cables & Adapters</a></li>
                                </ul>
                            </li>
                            <li><a href="product-grids.html">accessories</a></li>
                            <li><a href="product-grids.html">Televisions</a></li>
                            <li><a href="product-grids.html">best selling</a></li>
                            <li><a href="product-grids.html">top 100 offer</a></li>
                            <li><a href="product-grids.html">sunglass</a></li>
                            <li><a href="product-grids.html">watch</a></li>
                            <li><a href="product-grids.html">man’s product</a></li>
                            <li><a href="product-grids.html">Home Audio & Theater</a></li>
                            <li><a href="product-grids.html">Computers & Tablets </a></li>
                            <li><a href="product-grids.html">Video Games </a></li>
                            <li><a href="product-grids.html">Home Appliances </a></li>
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
@endsection

