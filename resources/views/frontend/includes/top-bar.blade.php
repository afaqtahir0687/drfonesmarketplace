@if(is_null(session()->get('user')))
@else
<div class="header-top header-top-ptb-1 d-none d-lg-block">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-xl-3 col-lg-4">
                <div class="header-info">
                    <!-- <ul>
                        <li><i class="fi-rs-marker"></i><a  href="#">Our location</a></li>
                    </ul> -->
                </div>
            </div>
            <div class="col-xl-6 col-lg-4">
                <div class="text-center">
                    <!-- <div id="news-flash" class="d-inline-block">
                        <ul>
                            <li>Get great devices up to 50% off <a href="shop-grid-right.html">View details</a></li>
                            <li>Supper Value Deals - Save more with coupons</li>
                            <li>Trendy 25silver jewelry, save up 35% off today <a href="shop-grid-right.html">Shop now</a></li>
                        </ul>
                    </div> -->
                </div>
            </div>
            <div class="col-xl-3 col-lg-4">
                <div class="header-info header-info-right">
                    <ul>
                        <!-- <li>
                            <a class="language-dropdown-active" href="#"> <i class="fi-rs-world"></i> English <i class="fi-rs-angle-small-down"></i></a>
                            <ul class="language-dropdown">
                                <li><a href="#"><img src="{{ asset('frontend/assets/imgs/theme/flag-fr.png') }}" alt="">Français</a></li>
                                <li><a href="#"><img src="{{ asset('frontend/assets/imgs/theme/flag-dt.png') }}" alt="">Deutsch</a></li>
                                <li><a href="#"><img src="{{ asset('frontend/assets/imgs/theme/flag-ru.png') }}" alt="">Pусский</a></li>
                            </ul>
                        </li> -->


                        {{-- <li><i class="fi-rs-user"></i><a href="{{ url('seller/login') }}">Seller Login</a></li> --}}
                        {{-- <li><i class="fi-rs-user"></i><a href="{{ url('buyer/login') }}">Buyer</a></li> --}}

                        <li><i class="fi-rs-user"></i><a href="{{ url('logout') }}">Logout</a></li>

                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endif
