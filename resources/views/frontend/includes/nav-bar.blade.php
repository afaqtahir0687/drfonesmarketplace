<div class="header-bottom header-bottom-bg-color sticky-bar">
    <div class="container">
        <div class="header-wrap header-space-between position-relative  main-nav">
            <div class="logo logo-width-1 d-block d-lg-none">
                <a href="{{ url('/') }}"><img src="{{ asset('frontend/assets/imgs/logo/logo.png') }}" alt="logo"></a>
            </div>
            <div class="header-nav d-none d-lg-flex">
                <div class="main-categori-wrap d-none d-lg-block">
                    <a class="categori-button-active" href="#">
                        <span class="fi-rs-search"></span> Browse Models
                    </a>
                    <div class="categori-dropdown-wrap categori-dropdown-active-large Browse-model ">
                        <ul class="scrol-bar">
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
                <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block">
                    <nav>
                        <ul>
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

                            @if(!is_null(session()->get('user')) && session()->get('buyer_login') != 1)
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
                            <li>
                                <a href="{{ url('/news') }}" class="{{ request()->is('news') ? 'active' : '' }}">News</a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
            <div class="header-action-right d-block d-lg-none">
                <div class="header-action-2">
                    <div class="header-action-icon-2 d-block d-lg-none">
                        <div class="burger-icon burger-icon-white">
                            <span class="burger-icon-top"></span>
                            <span class="burger-icon-mid"></span>
                            <span class="burger-icon-bottom"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>