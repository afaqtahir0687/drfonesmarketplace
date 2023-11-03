<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="{{ url('/') }}"><img src="{{ asset('frontend/assets/imgs/logo/logo.png') }}" alt="logo"></a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">
                <form action="{{ url('/') }}">
                    <input type="text" name="q" placeholder="Search for items..." value="{{ request()->q ?? '' }}">
                    <button type="submit"><i class="fi-rs-search"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">
                <div class="main-categori-wrap mobile-header-border">
                    <a class="categori-button-active-2" href="#">
                        <span class="fi-rs-apps"></span> Browse Models
                    </a>
                    <div class="categori-dropdown-wrap categori-dropdown-active-small">
                        <ul>
                            <li><a href="{{ url('/') }}?q=iPhone 5"><i class="evara-font-smartphone"></i>iPhone 5c</a></li>
                            <li><a href="{{ url('/') }}?q=iPhone 6"><i class="evara-font-smartphone"></i>iPhone 6</a></li>
                            <li><a href="{{ url('/') }}?q=iPhone 6s"><i class="evara-font-smartphone"></i>iPhone 6s</a></li>
                            <li><a href="{{ url('/') }}?q=iPhone 6s plus"><i class="evara-font-smartphone"></i>iPhone 6s plus</a></li>
                            <li><a href="{{ url('/') }}?q=iPhone 6 plus"><i class="evara-font-smartphone"></i>iPhone 6 plus</a></li>
                            <li><a href="{{ url('/') }}?q=iPhone 7"><i class="evara-font-smartphone"></i>iPhone 7</a></li>
                            <li><a href="{{ url('/') }}?q=iPhone 7 plus"><i class="evara-font-smartphone"></i>iPhone 7 plus</a></li>
                            <li><a href="{{ url('/') }}?q=iPhone 8 plus"><i class="evara-font-smartphone"></i>iPhone 8 plus</a></li>
                            <li><a href="{{ url('/') }}?q=iPhone X"><i class="evara-font-smartphone"></i>iPhone X</a></li>
                            <li><a href="{{ url('/') }}?q=iPhone Xs"><i class="evara-font-smartphone"></i>iPhone Xs</a></li>
                            <li><a href="{{ url('/') }}?q=iPhone XS Max"><i class="evara-font-smartphone"></i>iPhone XS Max</a></li>
                            <li><a href="{{ url('/') }}?q=iPhone XR"><i class="evara-font-smartphone"></i>iPhone XR</a></li>
                            <li><a href="{{ url('/') }}?q=iPhone SE"><i class="evara-font-smartphone"></i>iPhone SE</a></li>
                            <li><a href="{{ url('/') }}?q=iPhone 11"><i class="evara-font-smartphone"></i>iPhone 11</a></li>
                            <li><a href="{{ url('/') }}?q=iPhone 11 Pro"><i class="evara-font-smartphone"></i>iPhone 11 Pro</a></li>
                            <li><a href="{{ url('/') }}?q=iPhone 11 Pro Max"><i class="evara-font-smartphone"></i>iPhone 11 Pro Max</a></li>
                            <li><a href="{{ url('/') }}?q=iPhone 12"><i class="evara-font-smartphone"></i>iPhone 12</a></li>
                            <li><a href="{{ url('/') }}?q=iPhone 12 Pro"><i class="evara-font-smartphone"></i>iPhone 12 Pro</a></li>
                            <li><a href="{{ url('/') }}?q=iPhone 12 mini"><i class="evara-font-smartphone"></i>iPhone 12 mini</a></li>
                            <li><a href="{{ url('/') }}?q=iPhone 13"><i class="evara-font-smartphone"></i>iPhone 13</a></li>
                            <li><a href="{{ url('/') }}?q=iPhone 13 mini"><i class="evara-font-smartphone"></i>iPhone 13 mini</a></li>
                            <li><a href="{{ url('/') }}?q=iPhone 13 Pro"><i class="evara-font-smartphone"></i>iPhone 13 Pro</a></li>
                            <li><a href="{{ url('/') }}?q=iPhone 13 mini"><i class="evara-font-smartphone"></i>iPhone 13 mini</a></li>
                            <li><a href="{{ url('/') }}?q=iPhone 13 Pro Max"><i class="evara-font-smartphone"></i>iPhone 13 Pro Max</a></li>
                            
                            <li><a href="{{ url('/') }}?q=iPhone 14"><i class="evara-font-smartphone"></i>iPhone 14</a></li>
                            <li><a href="{{ url('/') }}?q=iPhone 14 mini"><i class="evara-font-smartphone"></i>iPhone 14 mini</a></li>
                            <li><a href="{{ url('/') }}?q=iPhone 14 Pro"><i class="evara-font-smartphone"></i>iPhone 14 Pro</a></li>
                            <li><a href="{{ url('/') }}?q=iPhone 14 mini"><i class="evara-font-smartphone"></i>iPhone 14 mini</a></li>
                            <li><a href="{{ url('/') }}?q=iPhone 14 Pro Max"><i class="evara-font-smartphone"></i>iPhone 14 Pro Max</a></li>
                            
                            <li><a href="{{ url('/') }}?q=Android"><i class="evara-font-smartphone"></i>Android</a></li>
                            <li><a href="{{ url('/') }}?q=Samsung"><i class="evara-font-smartphone"></i>Samsung</a></li>
                            <li><a href="{{ url('/') }}?q=Google Pixel"><i class="evara-font-smartphone"></i>Google Pixel</a></li>
                            <li><a href="{{ url('/') }}?q=Tablets"><i class="evara-font-smartphone"></i>Tablets</a></li>
                            <li><a href="{{ url('/') }}?q=Ipads"><i class="evara-font-smartphone"></i>Ipads</a></li>
                            <li><a href="{{ url('/') }}?q=One Plus"><i class="evara-font-smartphone"></i>One Plus</a></li> 
                        </ul>
                    </div>
                </div>
                <!-- mobile menu start -->
                <nav>
                    <ul class="mobile-menu">
                        <li>
                            <a href="{{ url('/') }}" class="{{ request()->is('/') ? 'active' : '' }}">Home</a>
                        </li>
                        <li>
                            <a href="{{ url('/testimonials') }}" class="{{ request()->is('testimonials') ? 'active' : '' }}">Testimonials</a>
                        </li>
                        <li>
                            <a href="{{ url('/contact-us') }}" class="{{ request()->is('contact-us') ? 'active' : '' }}">Contact</a>
                        </li>
                        <li>
                            <a href="{{ url('/free-demo') }}" class="{{ request()->is('free-demo') ? 'active' : '' }}">Free Demo</a>
                        </li>
                        @if(!is_null(session()->get('user')) && session()->get('buyer_login') != 1 )
                        <li>
                            <a href="{{ url('devices/posted') }}" class="{{ request()->is('devices/posted') ? 'active' : '' }}">Published Devices</a>
                        </li>
                        @endif
                        @if(!is_null(session()->get('user')) && session()->get('buyer_login') != 1 )
                        <li>
                            <a href="{{ url('devices/unposted') }}" class="{{ request()->is('devices/unposted') ? 'active' : '' }}">Unposted Devices</a>
                        </li>
                        @endif
                        
                        <li>
                            <a href="{{ url('imei-search') }}">IMEI Verification</a>
                        </li>
                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>
            <div class="mobile-header-info-wrap mobile-header-border">
                <div class="single-mobile-header-info">
                    <a href="page-contact.html"> Our location </a>
                </div>
                <div class="single-mobile-header-info">
                    @if(is_null(session()->get('user')))
                        <a href="{{ url('seller/login') }}">Seller Login</a>
                        <a href="{{ url('buyer/login') }}">Buyer Login</a>
                    @else
                        <a href="{{ url('logout') }}">Logout</a>
                    @endif
                </div>
                <div class="single-mobile-header-info">
                    <a href="tel:+971529928889">(+97)1529928889 </a>
                </div>
            </div>
            <div class="mobile-social-icon">
                <h5 class="mb-15 text-grey-4">Follow Us</h5>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-facebook.svg') }}" alt=""></a>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-twitter.svg') }}" alt=""></a>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-instagram.svg') }}" alt=""></a>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-pinterest.svg') }}" alt=""></a>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-youtube.svg') }}" alt=""></a>
            </div>
        </div>
    </div>
</div>