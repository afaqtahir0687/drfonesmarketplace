<div class="header-middle header-middle-ptb-1 d-none d-lg-block">
    <div class="container">
        <div class="header-wrap">
            <div class="logo logo-width-1">
                <a href="{{ url('/') }}"><img src="{{ asset('frontend/assets/imgs/logo/logo.png') }}" alt="logo"></a>
            </div>
            <div class="header-right">
                <div class="search-style-2">
                    <form action="{{ url('/') }}">
                        <input type="text" name="q" placeholder="Search for items..." value="{{ request()->q ?? '' }}">
                        <div class="col-md-6 ">
                            <button class="btn btn-outline-success search--btn" type="submit">
                                Search
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="header-right">
                <div class="header-bottom">
                    <div class="container">
                        <div class="header-wrap header-space-between position-relative">
                            <div class="search-style-2 ms-5">
                                <div class="main-menu main-menu-grow main-menu-padding-1 main-menu-lh-1 main-menu-mrg-1 hm3-menu-padding d-none d-lg-block hover-boder">
                                    <nav>
                                        <ul>
                                            @if(is_null(session()->get('user')))
                                            <li class="login">
                                                <a href="{{ url('buyer/login') }}" class="btn-sm btn btn-success pl-50 pr-50">Buyer Login</a>
                                            </li>
                                            @endif
                                            <li>
                                                <a href="{{ url('/free-demo') }}">Become a Seller</a>
                                            </li>
                                            {{-- <li>
                                                <a class="active" href="{{ url('/') }}">More <i class="fi-rs-angle-down"></i></a>
                                                <ul class="sub-menu">
                                                    <li><a href="{{ url('/') }}">Home 1</a></li>
                                                    <li><a href="index-2.html">Home 2</a></li>
                                                    <li><a href="index-3.html">Home 3</a></li>
                                                    <li><a href="index-4.html">Home 4</a></li>
                                                </ul>
                                            </li> --}}
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="header-action-2">
                    <!-- <div class="header-action-icon-2">
                        <a href="{{ url('wishlist') }}">
                            <img class="svgInject" alt="DrFone Market Place" src="{{ asset('frontend/assets/imgs/theme/icons/icon-heart.svg') }}">
                            <span class="pro-count blue">0</span>
                        </a>
                    </div> -->
                    <div class="header-action-icon-2">
                        <a class="mini-cart-icon" href="#">
                            <img alt="DrFone Market Place" src="{{ asset('frontend/assets/imgs/theme/icons/icon-cart.svg') }}">
                            <span class="pro-count blue">0</span>
                        </a>
                        <div class="cart-dropdown-wrap cart-dropdown-hm2">
                            <ul>
                                <!-- <li>
                                    <div class="shopping-cart-img">
                                        <a href="shop-product-right.html"><img alt="DrFone Market Place" src="{{ asset('frontend/assets/imgs/shop/thumbnail-3.jpg') }}"></a>
                                    </div>
                                    <div class="shopping-cart-title">
                                        <h4><a href="shop-product-right.html">Daisy Casual Bag</a></h4>
                                        <h4><span>1 × </span>$800.00</h4>
                                    </div>
                                    <div class="shopping-cart-delete">
                                        <a href="#"><i class="fi-rs-cross-small"></i></a>
                                    </div>
                                </li> -->
                                <li>No Item Found</li>
                            </ul>
                            <div class="shopping-cart-footer">
                                <div class="shopping-cart-total">
                                    <h4>Total <span>$00.00</span></h4>
                                </div>
                                <div class="shopping-cart-button">
                                    <a href="javascript:;" class="outline">View cart</a>
                                    <a href="javascript:;">Checkout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
