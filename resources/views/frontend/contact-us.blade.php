@extends('frontend.master')
@section('styles')
    <style>
        .fa-28{
            font-size: 28px;
        }
    </style>
@endsection
@section('title')
<title>Contact Us | DrFones Market Place</title>
@endsection
@section('content')
@php
use Carbon\Carbon;
@endphp
<section class="mt-50 mb-50">
    <div class="container">
        <div class="row">
<div class="col-lg-8 align-self-stretch">
    <div class="map map-full rounded-top rounded-lg-start">
        <iframe
            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d28866.031013876698!2d55.33944851562499!3d25.2620438!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3e5f5db2fd5097b9%3A0x122ce2df7a124cf7!2sDubai%20Airport%20Freezone%20(DAFZA)%20W3%20building!5e0!3m2!1sen!2s!4v1675709803510!5m2!1sen!2s"
            style="width:100%; height: 380px; border:0" allowfullscreen=""></iframe>
    </div>
    <!-- /.map -->
</div>

<div class="col-md-4">
        <div class="p-10 p-md-11 p-lg-14  ">
            <div class="d-flex flex-row">
                <div>
                    <div class="icon text-primary fa-28 fs-70 me-4 mt-n1"> <i class="fa-solid fa-building"></i> </div>
                </div>
                <div>
                    <h5 class="mb-3">Company Name</h5>
                    <p>Dr Fones FZCO</p>
                </div>
            </div>
            <div class="d-flex flex-row mt-3">
                <div>
                    <div class="icon text-primary fa-28 fa-1x me-4 mt-n1"> <i class="fas fa-map-marker-alt"></i></i> </div>
                </div>
    
                <div class="align-self-start justify-content-start">
                    <h5 class="mb-3">Address 1</h5>
                    <address>7WB 2074, Dubai Airport Free Zone,<br class="d-none d-md-block mt-2" />Dubai,
                        United Arab Emirates</address>
                </div>

            </div>
            <div class="d-flex flex-row mt-3">
                <div>
                    <div class="icon text-primary fa-28 fa-1x me-4 mt-n1"> <i class="fas fa-map-marker-alt"></i></i> </div>
                </div>
    
                <div class="align-self-start justify-content-start">
                    <h5 class="mb-3">Address 2</h5>
                    <address>Dr Fones Ltd Office No 760, JQ Modern,<br class="d-none d-md-block mt-2" />120 Vyse Street, Birmingham, B18 6NF
                             United kingdom
                        </address>
                </div>

            </div>
    
            <!--/div -->
            <div class="d-flex flex-row mb-3 ">
                <div class="main">
                    <div class="icon text-primary fa-28 me-4 mt-3"> <i class="fa-sharp fa-solid fa-envelope"></i> </div>
                </div>
                <div>
                    <h5 class="mb-2 mt-3">E-mail</h5>
                    <p class="mb-0"><a href="mailto:ali@drfonesltd.com" class="link-body "><span class="__cf_email__"><span
                                    class="__cf_email__"
                                    data-cfemail="c0a1aca980a4b2a6afaea5b3eea3afad">ali@drfonesltd.com</span></span></a>
                    </p>
                    <p class="mb-0"><a href="mailto:drfonesltd@gmail.com" class="link-body"><span class="__cf_email__"><span
                                    class="__cf_email__"
                                    data-cfemail="ee8f828b96ae8a9c8881808b9dc08d8183">drfonesltd@gmail.com</span></span></a>

                     </p>
                    
                </div>
    
            </div>
    
            <!--/div -->
            <div class="d-flex flex-row mb-3">
                <div>
                    <div class="icon text-primary fa-28 fs-40 me-4 mt-n1"> <i class="fa-solid fa-phone"></i> </div>
                </div>
                <div>
                    <h5 class="mb-1">Phone</h5>
                    <span>(+971) 529928889</span><br />
                    <span>(+44) 7435 291194</span>
                </div>
            </div>

            
                <!--/div -->
                <!--/div -->
            
            </div>
           </div>

        </div>
    </div>
</section>
@endsection
@section('script-bottom')
@endsection