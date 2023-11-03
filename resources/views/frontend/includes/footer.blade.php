<footer class="main">
    <section class="newsletter p-30 text-white wow fadeIn animated">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-7 mb-md-3 mb-lg-0">
                    <div class="row align-items-center">
                        <div class="col flex-horizontal-center">
                            <img class="icon-email" src="{{ asset('frontend/assets/imgs/theme/icons/icon-email.svg')}}" alt="">
                            <h4 class="font-size-20 mb-0 ml-3">Sign up to Newsletter</h4>
                        </div>
                        <div class="col my-4 my-md-0 des">
                            
                        </div>
                    </div>
                </div>
                <div class="col-lg-5">
                    <!-- Subscribe Form -->
                    <form onsubmit="return false" class="form-subcriber d-flex wow fadeIn animated" >
                        <input type="email" id="email" class="form-control bg-white font-small" placeholder="Enter your email">
                        <button class="btn bg-dark text-white " id="btn-save" type="submit">Subscribe</button>
                    </form>
                    <p id="sub-error" style="display:none">Please Provide Valid Email!</p>
                    <p id="sub-success" style="display:none;">Subscribe successfully</p>
                    <!-- End Subscribe Form -->
                </div>
            </div>
        </div>
    </section>
    <section class="section-padding footer-mid">
        <div class="container pt-15 pb-20">
            <div class="row">
                <div class="col-lg-6 col-md-6">
                    <div class="widget-about font-md mb-md-5 mb-lg-0">
                        <div class="logo logo-width-1 wow fadeIn animated">
                            <a href="{{ url('/') }}"><img src="{{ asset('frontend/assets/imgs/logo/logo.png')}}" alt="logo"></a>
                        </div>
                        <!-- <h5 class="mt-20 mb-10 fw-600 text-grey-4 wow fadeIn animated">Trusted Seller Certified Devices</h5> -->
                        <p class="wow fadeIn animated">
                            <!-- <strong>DrFones</strong> is the fastest software for diagnostics and Data wipe of iOS -->
                            The ultimate solution for the certification of used and refurbished devices. 
                        </p>
                        <p class="wow fadeIn animated">
                            The fastest software for diagnostics and data wiping of iOS and android devices with a complete certification process, storage and analysis of Cloud data.
                        </p>
                        <p class="wow fadeIn animated"></p>
                    </div>
                </div>
                <div class="col-lg-3 col-md-3">
                    <h5 class="widget-title wow fadeIn animated">QUICK LINKS</h5>
                    <ul class="footer-list wow fadeIn animated mb-sm-5 mb-md-0">
                        <li><a href="/">Home</a></li>
                        <li><a href="{{ url('/contact-us') }}">Contact us</a></li>
                        <li><a href="{{ url('/free-demo') }}">Free Demo</a></li>
                        <li><a href="{{ url('imei-search') }}">Search IMEI</a></li>
                        @if(!is_null(session()->get('user')))
                            <li><a href="#">Seller Login</a></li>
                        @endif
                    </ul>
                </div>
                <div class="col-lg-3  col-md-3">
                    <h5 class="widget-title wow fadeIn animated">COMPANY INFO</h5>
                    <ul class="footer-list wow fadeIn animated">
                        
                        <li><a href="#">+971529928889</a></li>
                        <li><a href="mailto:ali@drfonesltd.com">ali@drfonesltd.com</a></li>
                        <li><a href="mailto:drfonesltd@gmail.com">drfonesltd@gmail.com</a></li>
                    </ul>
                    {{-- <h5 class="mb-10 mt-30 fw-600 text-grey-4 wow fadeIn animated">Follow Us</h5>
                        <div class="mobile-social-icon wow fadeIn animated mb-sm-5 mb-md-0">
                            <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-facebook.svg')}}" alt=""></a>
                            <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-twitter.svg')}}" alt=""></a>
                            <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-instagram.svg')}}" alt=""></a>
                            <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-pinterest.svg')}}" alt=""></a>
                            <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-youtube.svg')}}" alt=""></a>
                        </div> --}}
                </div>
            </div>
        </div>
    </section>
    <div class="container pb-20 wow fadeIn animated">
        <div class="row">
            <div class="col-12 mb-20">
                <div class="footer-bottom"></div>
            </div>
            <div class="col-lg-12 text-center" >
                <p class="float-md-left font-sm text-muted mb-0">&copy; 2021, <strong class="text-brand">Copyrights</strong>
                    :DrFones </p>
            </div>
           
        </div>
    </div>
</footer>